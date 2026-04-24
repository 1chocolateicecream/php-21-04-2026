<?php

require_once __DIR__ . '/../models/Order.php';

class OrderController {

    public static function index() {
        try {
            $status = $_GET['status'] ?? null;
            $orders = Order::all($status);
        } catch (PDOException $e) {
            echo "<p style='color: red; text-align: center;'>Kļūda atlasot pasūtījumus: " . htmlspecialchars($e->getMessage()) . "</p>";
            return;
        }

        require __DIR__ . '/../views/orders.php';
    }
}
