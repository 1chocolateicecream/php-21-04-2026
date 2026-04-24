<?php
require_once __DIR__ . '/../src/Env.php';
Env::load(__DIR__ . '/../.env');

require_once __DIR__ . '/../src/controllers/CustomerController.php';
require_once __DIR__ . '/../src/controllers/OrderController.php';
require_once __DIR__ . '/../src/controllers/HomeController.php';

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($requestUri === '/' || $requestUri === '/index.php') {
    HomeController::index();
} elseif ($requestUri === '/customers') {
    CustomerController::index();
} elseif ($requestUri === '/orders') {
    OrderController::index();
}