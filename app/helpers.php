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