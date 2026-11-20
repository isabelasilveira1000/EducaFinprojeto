<?php

declare(strict_types=1);

/** Front controller do EducaFin. */

$root = dirname(__DIR__);

// BASE_URL: pasta onde o site está publicado ('' quando public/ é a raiz do servidor)
$script = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
$base   = basename($script) === 'index.php' ? rtrim(dirname($script), '/') : '';
define('BASE_URL', $base === '.' ? '' : $base);

// Funções e(), url() e asset()
foreach ([$root . '/helpers.php', $root . '/app/helpers.php'] as $helpers) {
    if (is_file($helpers)) {
        require $helpers;
        break;
    }
}
if (!function_exists('url')) {
    exit('helpers.php não encontrado: coloque-o na raiz do projeto ou em app/');
}

// Autoload: App\Controllers\UserController => app/Controllers/UserController.php
spl_autoload_register(static function (string $class) use ($root): void {
    $prefix = 'App\\';
    if (strncmp($class, $prefix, strlen($prefix)) !== 0) {
        return;
    }
    $file = $root . '/app/' . str_replace('\\', '/', substr($class, strlen($prefix))) . '.php';
    if (is_file($file)) {
        require $file;
    }
});

// Rota: /controller/action/param1/param2  (padrão: home/index)
$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
if (BASE_URL !== '' && strpos($path, BASE_URL) === 0) {
    $path = substr($path, strlen(BASE_URL));
}
$parts = array_values(array_filter(explode('/', trim($path, '/')), 'strlen'));
if (($parts[0] ?? '') === 'index.php') {   // aceita também /public/index.php/home/index
    array_shift($parts);
}

$controller = $parts[0] ?? 'home';
$action     = $parts[1] ?? 'index';
$params     = array_slice($parts, 2);

$valid = '/^[A-Za-z][A-Za-z0-9_]*$/';
$class = 'App\\Controllers\\' . ucfirst($controller) . 'Controller';

if (
    !preg_match($valid, $controller) || !preg_match($valid, $action)
    || !class_exists($class)
    || !is_callable([$obj = new $class(), $action])   // métodos private (render etc.) dão 404
) {
    http_response_code(404);
    exit('Página não encontrada');
}

$obj->$action(...$params);
