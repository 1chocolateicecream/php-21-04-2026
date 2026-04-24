<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klienti - Veikals</title>
    <link rel="icon" href="/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/style.css">
</head>
<body>
    <?php include 'nav.php'; ?>
    <h1>Klienti</h1>

    <?php if (isset($_GET['with-orders']) && $_GET['with-orders'] === 'full'): ?>
        <ul>
            <?php foreach ($customers as $customer): ?>
                <li>
                    <strong><?php echo htmlspecialchars($customer['first_name'] . ' ' . $customer['last_name']); ?></strong>
                    (<?php echo htmlspecialchars($customer['email']); ?>)
                    <?php if (!empty($customer['orders'])): ?>
                        <ul>
                            <?php foreach ($customer['orders'] as $order): ?>
                                <li>
                                    Pasūtījums #<?php echo htmlspecialchars($order['id']); ?>
                                    (<?php echo htmlspecialchars($order['date']); ?>) -
                                    <?php echo htmlspecialchars($order['status']); ?>
                                    <?php if ($order['shipping_date']): ?>
                                        | Piegāde: <?php echo htmlspecialchars($order['shipping_date']); ?>
                                    <?php endif; ?>
                                    <?php if ($order['image']): ?>
                                        <br><img src="/<?php echo htmlspecialchars($order['image']); ?>" alt="order" width="40" class="miku-img" style="margin-top: 5px;">
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p>Nav pasūtījumu.</p>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <table>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Birth Date</th>
                <th>Points</th>
            </tr>
            <?php foreach ($customers as $customer): ?>
            <tr>
                <td><?php echo htmlspecialchars($customer['id']); ?></td>
                <td><?php echo htmlspecialchars($customer['first_name']); ?></td>
                <td><?php echo htmlspecialchars($customer['last_name']); ?></td>
                <td><?php echo htmlspecialchars($customer['email']); ?></td>
                <td><?php echo htmlspecialchars($customer['birth_date']); ?></td>
                <td><?php echo htmlspecialchars($customer['points']); ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <p style="margin-top: 20px;">
        <?php
            $currentFilter = $_GET['with-orders'] ?? 'all';
        ?>
        <?php if ($currentFilter === 'full'): ?>
            <strong>ar pasūtījumiem</strong>
        <?php else: ?>
            <a href="/customers?with-orders=full">ar pasūtījumiem</a>
        <?php endif; ?>

        &#8942;

        <?php if ($currentFilter === 'none'): ?>
            <strong>bez pasūtījumiem</strong>
        <?php else: ?>
            <a href="/customers?with-orders=none">bez pasūtījumiem</a>
        <?php endif; ?>

        &#8942;

        <?php if ($currentFilter === 'all'): ?>
            <strong>visi</strong>
        <?php else: ?>
            <a href="/customers">visi</a>
        <?php endif; ?>
    </p>
</body>
</html>