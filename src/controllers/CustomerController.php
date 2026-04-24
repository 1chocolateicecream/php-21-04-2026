<?php

require_once __DIR__ . '/../models/Customer.php';

class CustomerController {

    public static function index() {
        try {
            $withOrders = $_GET['with-orders'] ?? null;

            if ($withOrders === 'full') {
                $customers = Customer::allWithOrders(true);
            } elseif ($withOrders === 'none') {
                $customers = Customer::allWithoutOrders();
            } else {
                $customers = Customer::all();
            }
        } catch (PDOException $e) {
            echo "<p style='color: red; text-align: center;'>Kļūda atlasot datus: " . htmlspecialchars($e->getMessage()) . "</p>";
            return;
        }

        require __DIR__ . '/../views/customers.php';
    }
}