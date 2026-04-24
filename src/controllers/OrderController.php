<?php

require_once __DIR__ . '/../models/Order.php';
require_once __DIR__ . '/../models/Customer.php';

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

    public static function create() {
        $customers = Customer::all();
        require __DIR__ . '/../views/order_create.php';
    }

    public static function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $imagePath = null;

            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/../../public/images/';
                $fileName = time() . '_' . basename($_FILES['image']['name']);
                $targetFile = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                    $imagePath = 'images/' . $fileName;
                }
            }

            $data = [
                'order_date'  => $_POST['order_date'],
                'status'      => $_POST['status'],
                'comment'     => $_POST['comment'] ?? null,
                'customer_id' => $_POST['customer_id'],
                'image'       => $imagePath
            ];

            if (Order::create($data)) {
                header('Location: /orders');
                exit;
            } else {
                echo "Kļūda saglabājot pasūtījumu.";
            }
        }
    }
}
