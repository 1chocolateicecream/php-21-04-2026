<?php

require_once __DIR__ . '/../../db/DB.php';
require_once __DIR__ . '/Order.php';

class Customer {
    public int $id;
    public string $first_name;
    public string $last_name;
    public string $email;
    public ?string $birth_date;
    public int $points;
    public array $orders = [];

    public static function all(): array {
        $pdo = DB::connect();
        $stmt = $pdo->query("SELECT customer_id AS id, first_name, last_name, email, birth_date, points FROM customers");
        return $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function allWithOrders(bool $onlyWithOrders = false): array {
        $sql = "SELECT c.customer_id AS id, c.first_name, c.last_name, c.email, c.birth_date, c.points, 
                       o.order_id, o.order_date, o.status, o.comment, o.image, o.shipping_date
                FROM customers c";
        
        if ($onlyWithOrders) {
            $sql .= " JOIN orders o ON c.customer_id = o.customer_id";
        } else {
            $sql .= " LEFT JOIN orders o ON c.customer_id = o.customer_id";
        }
        
        $pdo = DB::connect();
        $stmt = $pdo->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $customers = [];
        foreach ($rows as $row) {
            $cid = $row['id'];
            if (!isset($customers[$cid])) {
                $customer = new self();
                $customer->id = (int)$row['id'];
                $customer->first_name = $row['first_name'];
                $customer->last_name = $row['last_name'];
                $customer->email = $row['email'];
                $customer->birth_date = $row['birth_date'];
                $customer->points = (int)$row['points'];
                $customers[$cid] = $customer;
            }
            if ($row['order_id']) {
                $order = new Order();
                $order->id = (int)$row['order_id'];
                $order->order_date = $row['order_date'];
                $order->status = $row['status'];
                $order->comment = $row['comment'];
                $order->image = $row['image'];
                $order->shipping_date = $row['shipping_date'];
                $customers[$cid]->orders[] = $order;
            }
        }
        return array_values($customers);
    }

    public static function allWithoutOrders(): array {
        $sql = "SELECT c.customer_id AS id, c.first_name, c.last_name, c.email, c.birth_date, c.points
                FROM customers c
                LEFT JOIN orders o ON c.customer_id = o.customer_id
                WHERE o.order_id IS NULL";
        $pdo = DB::connect();
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function count(): int {
        $stmt = DB::query("SELECT COUNT(*) FROM customers");
        return (int)$stmt->fetchColumn();
    }
}
