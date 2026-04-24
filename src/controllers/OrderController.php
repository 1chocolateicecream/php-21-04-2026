<?php

require_once __DIR__ . '/../models/Order.php';
require_once __DIR__ . '/../models/Customer.php';

class OrderController {

    public static function show(int $id) {
        try {
            $order = Order::find($id);
        } catch (PDOException $e) {
            echo "<p style='color:red;text-align:center;'>Kļūda: " . htmlspecialchars($e->getMessage()) . "</p>";
            return;
        }

        if (!$order) {
            http_response_code(404);
            echo "<p style='text-align:center;margin-top:60px;'>Pasūtījums #" . $id . " nav atrasts.</p>";
            return;
        }

        require __DIR__ . '/../views/order_receipt.php';
    }

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

    public static function edit(int $id) {
        $order = Order::find($id);
        if (!$order) {
            http_response_code(404);
            echo "<p style='text-align:center;margin-top:60px;'>Pasūtījums #" . $id . " nav atrasts.</p>";
            return;
        }
        $customers = Customer::all();
        require __DIR__ . '/../views/order_edit.php';
    }

    public static function update(int $id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;

        $imagePath = $_POST['existing_image'] ?: null;

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../public/images/';
            $fileName = time() . '_' . basename($_FILES['image']['name']);
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $fileName)) {
                $imagePath = 'images/' . $fileName;
            }
        }

        $data = [
            'order_date'    => $_POST['order_date'],
            'status'        => $_POST['status'],
            'comment'       => $_POST['comment'] ?? null,
            'customer_id'   => $_POST['customer_id'],
            'image'         => $imagePath,
            'shipping_date' => $_POST['shipping_date'] ?? null,
        ];

        Order::update($id, $data);
        header('Location: /orders');
        exit;
    }

    public static function updateStatus(int $id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;
        $allowed = ['new', 'paid', 'delivered'];
        $status = $_POST['status'] ?? '';
        if (in_array($status, $allowed, true)) {
            Order::updateStatus($id, $status);
        }
        header('Location: /orders');
        exit;
    }

    public static function destroy(int $id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;
        Order::delete($id);
        header('Location: /orders');
        exit;
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
