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
} elseif ($requestUri === '/orders/create') {
    OrderController::create();
} elseif ($requestUri === '/orders/store') {
    OrderController::store();
} elseif (preg_match('#^/orders/(\d+)/edit$#', $requestUri, $m)) {
    OrderController::edit((int)$m[1]);
} elseif (preg_match('#^/orders/(\d+)/update$#', $requestUri, $m)) {
    OrderController::update((int)$m[1]);
} elseif (preg_match('#^/orders/(\d+)/status$#', $requestUri, $m)) {
    OrderController::updateStatus((int)$m[1]);
} elseif (preg_match('#^/orders/(\d+)/delete$#', $requestUri, $m)) {
    OrderController::destroy((int)$m[1]);
} elseif (preg_match('#^/orders/(\d+)$#', $requestUri, $m)) {
    OrderController::show((int)$m[1]);
}