<?php
// Start session (MUST be before any output)
session_start();

// Autoload controllers
spl_autoload_register(function($class){
    $file = __DIR__ . '/controllers/' . $class . '.php';
    if(file_exists($file)) require $file;
});

// Function to load 404 page
function show404() {
    http_response_code(404);
    $file = __DIR__ . '/views/404.php';
    if(file_exists($file)) {
        require $file;
    } else {
        echo "<h1>404 - Page Not Found</h1>";
    }
    exit;
}

// Get URL
$url = $_GET['url'] ?? 'home';
$url = rtrim($url, '/');
$segments = explode('/', $url);

// Determine controller and method
$controllerName = ucfirst($segments[0]) . 'Controller'; 
$method = $segments[1] ?? 'index';

try {

    if(!class_exists($controllerName)) {
        show404();
    }

    $controller = new $controllerName();

    if(!method_exists($controller, $method)) {
        show404();
    }

    $params = array_slice($segments, 2);
    call_user_func_array([$controller, $method], $params);

} catch (Exception $e) {
    show404();
}
//HUI