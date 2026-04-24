<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasūtījumi - Veikals</title>
    <link rel="icon" href="/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/style.css">
</head>
<body>
    <?php include 'nav.php'; ?>

    <h1>Visi pasūtījumi</h1>

    <div>
        <a href="/orders/create" class="btn btn-add">+ Jauns pasūtījums</a>
    </div>

    <?php
        $current = $_GET['status'] ?? '';
        $filters = ['' => 'Visi', 'new' => 'Jauni', 'paid' => 'Apmaksāti', 'delivered' => 'Piegādāti'];
    ?>
    <div class="filter-bar">
        <span>Filtrs:</span>
        <?php foreach ($filters as $val => $label): ?>
            <a href="/orders<?php echo $val ? '?status='.$val : ''; ?>"
               class="<?php echo $current === $val ? 'active' : ''; ?>">
                <?php echo $label; ?>
            </a>
        <?php endforeach; ?>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Datums</th>
                <th>Klients</th>
                <th>Statuss</th>
                <th>Komentārs</th>
                <th>Piegādes datums</th>
                <th>Attēls</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?php echo htmlspecialchars($order->id); ?></td>
                <td><?php echo htmlspecialchars($order->order_date); ?></td>
                <td><?php echo htmlspecialchars($order->first_name . ' ' . $order->last_name); ?></td>
                <td>
                    <span class="status-badge status-<?php echo htmlspecialchars($order->status); ?>">
                        <?php echo htmlspecialchars($order->status); ?>
                    </span>
                </td>
                <td><?php echo htmlspecialchars($order->comment ?? ''); ?></td>
                <td><?php echo htmlspecialchars($order->shipping_date ?: '—'); ?></td>
                <td>
                    <?php if ($order->image): ?>
                        <img src="/<?php echo htmlspecialchars($order->image); ?>" alt="order" width="60" class="miku-img">
                    <?php else: ?>
                        —
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
