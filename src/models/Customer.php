<?php

require_once __DIR__ . '/../../db/DB.php';

class Customer {

    public static function all(): array {
        $stmt = DB::query("SELECT customer_id AS id, first_name, last_name, email, birth_date, points FROM customers");
        return $stmt->fetchAll();
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
        
        $stmt = DB::query($sql);
        $rows = $stmt->fetchAll();

        $customers = [];
        foreach ($rows as $row) {
            $cid = $row['id'];
            if (!isset($customers[$cid])) {
                $customers[$cid] = [
                    'id' => $row['id'],
                    'first_name' => $row['first_name'],
                    'last_name' => $row['last_name'],
                    'email' => $row['email'],
                    'birth_date' => $row['birth_date'],
                    'points' => $row['points'],
                    'orders' => []
                ];
            }
            if ($row['order_id']) {
                $customers[$cid]['orders'][] = [
                    'id' => $row['order_id'],
                    'date' => $row['order_date'],
                    'status' => $row['status'],
                    'comment' => $row['comment'],
                    'image' => $row['image'],
                    'shipping_date' => $row['shipping_date'],
                ];
            }
        }
        return array_values($customers);
    }

    public static function allWithoutOrders(): array {
        $sql = "SELECT c.customer_id AS id, c.first_name, c.last_name, c.email, c.birth_date, c.points
                FROM customers c
                LEFT JOIN orders o ON c.customer_id = o.customer_id
                WHERE o.order_id IS NULL";
        $stmt = DB::query($sql);
        return $stmt->fetchAll();
    }

    public static function count(): int {
        $stmt = DB::query("SELECT COUNT(*) FROM customers");
        return (int)$stmt->fetchColumn();
    }
}
