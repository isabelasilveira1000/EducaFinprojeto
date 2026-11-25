<?php

// BASE_URL: pasta onde o site está publicado.
// Se o projeto já define essa constante em outro lugar, o valor existente é mantido.
// Caso contrário, é detectada sozinha ('' quando public/ é a raiz do servidor).
if (!defined('BASE_URL')) {
    $script = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
    $base   = basename($script) === 'index.php' ? rtrim(dirname($script), '/') : '';
    define('BASE_URL', $base === '.' ? '' : $base);
}

// e(): escapa texto para HTML (previne XSS)
function e(string|int|float|null $value): string
{
    return htmlspecialchars((string) $value,
        ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

// url(): monta um link interno respeitando o BASE_URL
function url(string $path = ''): string
{
    return BASE_URL . '/' . ltrim($path, '/');
}

// asset(): monta o link de um arquivo estático e acrescenta a versão
function asset(string $path): string
{
    $path = ltrim($path, '/');

    // procura o arquivo em public/, esteja o helpers.php na raiz ou dentro de app/
    $version = false;
    foreach ([__DIR__ . '/public/', __DIR__ . '/../public/'] as $dir) {
        if (is_file($dir . $path)) {
            $version = filemtime($dir . $path);
            break;
        }
    }

    return url($path) . ($version === false ? '' : '?v=' . $version);
}

// csrf_token(): token da sessão, usado nos formulários
function csrf_token(): string
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    return $_SESSION['csrf'] ??= bin2hex(random_bytes(32));
}

// csrf_check(): confere o token enviado por um formulário POST
function csrf_check(): bool
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $enviado = $_POST['csrf'] ?? '';

    return is_string($enviado) && hash_equals((string) ($_SESSION['csrf'] ?? ''), $enviado);
}

// user_id(): id de quem está logado (0 quando ninguém está)
function user_id(): int
{
    return (int) ($_SESSION['user_id'] ?? 0);
}

// flash_set() / flash_get(): aviso que aparece uma vez só na próxima página
function flash_set(string $msg, string $tipo = 'ok'): void
{
    $_SESSION['flash'] = ['msg' => $msg, 'tipo' => $tipo];
}

function flash_get(): ?array
{
    $flash = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);

    return is_array($flash) ? $flash : null;
}