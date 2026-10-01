<?php
session_start();

// Autoload controllers
spl_autoload_register(function($class){
    $file = __DIR__ . '/controllers/' . $class . '.php';
    if(file_exists($file)) require $file;
});

// Get URL (using ?url= or rewrite)
$url = $_GET['url'] ?? '';
$url = rtrim($url, '/');

// Redirect empty requests or index.php to panel
if ($url === '' || $url === 'index.php') {
    header("Location: /computerproject/admin/panel");
    exit;
}

$segments = explode('/', $url);

// Determine method and params
$method = !empty($segments[0]) ? $segments[0] : 'panel';
$params = array_slice($segments, 1);

// Initialize controller
$controller = new AdminController();

if (method_exists($controller, $method)) {
    call_user_func_array([$controller, $method], $params);
} else {
    echo "<h1>404 - Page Not Found</h1>";
}