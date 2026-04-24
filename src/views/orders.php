<!DOCTYPE html>
<html lang="en">
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

    <p style="margin-bottom: 20px;">
        Filtrs:
        <a href="/orders" style="<?php echo !isset($_GET['status']) ? 'font-weight: bold;' : ''; ?>">Visi</a> &#8942;
        <a href="/orders?status=new" style="<?php echo ($_GET['status'] ?? '') === 'new' ? 'font-weight: bold;' : ''; ?>">Jauni</a> &#8942;
        <a href="/orders?status=paid" style="<?php echo ($_GET['status'] ?? '') === 'paid' ? 'font-weight: bold;' : ''; ?>">Apmaksāti</a> &#8942;
        <a href="/orders?status=delivered" style="<?php echo ($_GET['status'] ?? '') === 'delivered' ? 'font-weight: bold;' : ''; ?>">Piegādāti</a>
    </p>

    <table>
        <tr>
            <th>ID</th>
            <th>Datums</th>
            <th>Klients</th>
            <th>Statuss</th>
            <th>Komentārs</th>
            <th>Piegādes datums</th>
            <th>Attēls</th>
        </tr>
        <?php foreach ($orders as $order): ?>
        <tr>
            <td><?php echo htmlspecialchars($order['id']); ?></td>
            <td><?php echo htmlspecialchars($order['order_date']); ?></td>
            <td><?php echo htmlspecialchars($order['first_name'] . ' ' . $order['last_name']); ?></td>
            <td><?php echo htmlspecialchars($order['status']); ?></td>
            <td><?php echo htmlspecialchars($order['comment']); ?></td>
            <td><?php echo htmlspecialchars($order['shipping_date'] ?: '-'); ?></td>
            <td>
                <?php if ($order['image']): ?>
                    <img src="/<?php echo htmlspecialchars($order['image']); ?>" alt="order" width="60" class="miku-img">
                <?php else: ?>
                    -
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>