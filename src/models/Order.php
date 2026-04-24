<?php

require_once __DIR__ . '/../../db/DB.php';

class Order {

    public static function all(?string $status = null): array {
        $sql = "SELECT o.order_id AS id, o.order_date, o.status, o.comment, o.image, o.shipping_date, 
                       c.first_name, c.last_name
                FROM orders o
                JOIN customers c ON o.customer_id = c.customer_id";
        
        $pdo = DB::connect();
        
        if ($status) {
            $stmt = $pdo->prepare($sql . " WHERE o.status = ?");
            $stmt->execute([$status]);
        } else {
            $stmt = $pdo->query($sql);
        }
        
        return $stmt->fetchAll();
    }

    public static function count(): int {
        $stmt = DB::query("SELECT COUNT(*) FROM orders");
        return (int)$stmt->fetchColumn();
    }
}
