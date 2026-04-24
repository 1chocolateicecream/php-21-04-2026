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
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?php echo htmlspecialchars($order->id); ?></td>
                <td><?php echo htmlspecialchars($order->order_date); ?></td>
                <td><?php echo htmlspecialchars($order->first_name . ' ' . $order->last_name); ?></td>
                <td>
                    <form action="/orders/<?php echo $order->id; ?>/status" method="POST" class="status-form">
                        <select name="status" onchange="this.form.submit()" class="status-select status-<?php echo htmlspecialchars($order->status); ?>">
                            <option value="new"       <?php echo $order->status === 'new'       ? 'selected' : ''; ?>>Jauns</option>
                            <option value="paid"      <?php echo $order->status === 'paid'      ? 'selected' : ''; ?>>Apmaksāts</option>
                            <option value="delivered" <?php echo $order->status === 'delivered' ? 'selected' : ''; ?>>Piegādāts</option>
                        </select>
                    </form>
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
                <td>
                    <a href="/orders/<?php echo $order->id; ?>/edit" class="btn btn-edit">Labot</a>
                    <a href="/orders/<?php echo $order->id; ?>" class="btn btn-receipt">Čeks</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
