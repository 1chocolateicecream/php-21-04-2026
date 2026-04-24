<?php

require_once __DIR__ . '/../../db/DB.php';

class Order {
    public int $id;
    public string $order_date;
    public string $status;
    public ?string $comment;
    public ?string $image;
    public ?string $shipping_date;
    public int $customer_id;

    // Joined fields
    public ?string $first_name = null;
    public ?string $last_name = null;

    public static function all(?string $status = null): array {
        $sql = "SELECT o.order_id AS id, o.order_date, o.status, o.comment, o.image, o.shipping_date, 
                       c.first_name, c.last_name, o.customer_id
                FROM orders o
                JOIN customers c ON o.customer_id = c.customer_id";
        
        $pdo = DB::connect();
        
        if ($status) {
            $stmt = $pdo->prepare($sql . " WHERE o.status = ?");
            $stmt->execute([$status]);
        } else {
            $stmt = $pdo->query($sql);
        }
        
        return $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function count(): int {
        $stmt = DB::query("SELECT COUNT(*) FROM orders");
        return (int)$stmt->fetchColumn();
    }

    public static function find(int $id): ?self {
        $pdo = DB::connect();
        $stmt = $pdo->prepare(
            "SELECT o.order_id AS id, o.order_date, o.status, o.comment, o.image, o.shipping_date,
                    c.first_name, c.last_name, o.customer_id
             FROM orders o
             JOIN customers c ON o.customer_id = c.customer_id
             WHERE o.order_id = ?"
        );
        $stmt->execute([$id]);
        $result = $stmt->fetchObject(self::class);
        return $result ?: null;
    }

    public static function update(int $id, array $data): bool {
        $pdo = DB::connect();
        $stmt = $pdo->prepare(
            "UPDATE orders SET order_date=?, status=?, comment=?, customer_id=?, image=?, shipping_date=? WHERE order_id=?"
        );
        return $stmt->execute([
            $data['order_date'],
            $data['status'],
            $data['comment'],
            $data['customer_id'],
            $data['image'],
            $data['shipping_date'] ?: null,
            $id
        ]);
    }

    public static function updateStatus(int $id, string $status): bool {
        $pdo = DB::connect();
        $stmt = $pdo->prepare("UPDATE orders SET status=? WHERE order_id=?");
        return $stmt->execute([$status, $id]);
    }

    public static function delete(int $id): bool {
        $pdo = DB::connect();
        $stmt = $pdo->prepare("DELETE FROM orders WHERE order_id=?");
        return $stmt->execute([$id]);
    }

    public static function create(array $data): bool {
        $pdo = DB::connect();
        $sql = "INSERT INTO orders (order_date, status, comment, customer_id, image) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            $data['order_date'],
            $data['status'],
            $data['comment'],
            $data['customer_id'],
            $data['image'] ?? null
        ]);
    }
}
