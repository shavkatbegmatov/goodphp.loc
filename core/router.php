<?php

$routes = [];

function get($route, $callback) {
    global $routes;

    $routes[] = [
        'pattern' => $route,
        'callback' => $callback,
    ];
}

function dispatch() {
    global $routes;

    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    if ($uri !== '/') {
        $uri = rtrim($uri, '/');
    }

    foreach ($routes as $route) {
        if ($route['pattern'] === '*') {
            $pattern = '.*'; 
        } else {
            $pattern = str_replace('/', '\/', $route['pattern']);
            $pattern = preg_replace('/:(\w+)/', '([^\/]+)', $pattern);
        }

        if (preg_match('/^' . $pattern . '$/', $uri, $matches)) {
            array_shift($matches);

            call_user_func_array($route['callback'], $matches);
            return;
        }
    }
}

function run($path, $data = [], $layout = 'default') {
    if (file_exists(APP_PATH . '/controllers/' . $path . '.php')) {
        include APP_PATH . '/controllers/' . $path . '.php';
    }

    ob_start();
    if (file_exists(APP_PATH . '/views/' . $path . '.php')) {
        include APP_PATH . '/views/' . $path . '.php';
    }
    $content = ob_get_clean();

    if ($layout === false) {
        echo $content;
        return;
    }

    include APP_PATH . '/views/layouts/' . $layout . '/index.php';
}

require_once CORE_PATH . '/routes.php';

dispatch();