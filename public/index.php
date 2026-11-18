<?php
declare(strict_types=1);

// 1) Caminho base
$base = dirname(dirname($_SERVER['SCRIPT_NAME']));
define('BASE_URL', rtrim(str_replace('\\', '/', $base), '/'));

// 2) Carregar helpers
require_once __DIR__ . '/../app/helpers.php';

// 3) Autoload
spl_autoload_register(function (string $class): void {
    $file = __DIR__ . '/../app/'
        . str_replace(['App\\', '\\'], ['', '/'], $class) . '.php';

    if (is_file($file)) {
        require_once $file;
    }
});

// 4) Interpretação da URL
$url = explode('/', trim($_GET['url'] ?? 'user/index', '/'));

$controller = 'App\\Controllers\\' . ucfirst($url[0]) . 'Controller';
$method = $url[1] ?? 'index';
$params = array_slice($url, 2);

// 5) Validação
if (!class_exists($controller)) {
    http_response_code(404);
    exit('Controller não encontrado');
}

if (!method_exists($controller, $method)) {
    http_response_code(404);
    exit('Método não encontrado');
}

// 6) Execução
$instance = new $controller();
call_user_func_array([$instance, $method], $params);