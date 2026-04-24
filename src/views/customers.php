<!DOCTYPE html>
<html lang="lv">
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

    <?php $currentFilter = $_GET['with-orders'] ?? 'all'; ?>

    <?php if ($currentFilter === 'full'): ?>
        <ul>
            <?php foreach ($customers as $customer): ?>
                <li>
                    <strong><?php echo htmlspecialchars($customer->first_name . ' ' . $customer->last_name); ?></strong>
                    (<?php echo htmlspecialchars($customer->email); ?>)
                    <?php if (!empty($customer->orders)): ?>
                        <ul>
                            <?php foreach ($customer->orders as $order): ?>
                                <li>
                                    Pasūtījums #<?php echo htmlspecialchars($order->id); ?>
                                    (<?php echo htmlspecialchars($order->order_date); ?>) —
                                    <span class="status-badge status-<?php echo htmlspecialchars($order->status); ?>">
                                        <?php echo htmlspecialchars($order->status); ?>
                                    </span>
                                    <?php if ($order->shipping_date): ?>
                                        | Piegāde: <?php echo htmlspecialchars($order->shipping_date); ?>
                                    <?php endif; ?>
                                    <?php if ($order->image): ?>
                                        <br><img src="/<?php echo htmlspecialchars($order->image); ?>" alt="order" width="40" class="miku-img">
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
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Vārds</th>
                    <th>Uzvārds</th>
                    <th>E-pasts</th>
                    <th>Dzimšanas datums</th>
                    <th>Punkti</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?php echo htmlspecialchars($customer->id); ?></td>
                    <td><?php echo htmlspecialchars($customer->first_name); ?></td>
                    <td><?php echo htmlspecialchars($customer->last_name); ?></td>
                    <td><?php echo htmlspecialchars($customer->email); ?></td>
                    <td><?php echo htmlspecialchars($customer->birth_date ?? '—'); ?></td>
                    <td><?php echo htmlspecialchars($customer->points); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <div class="filter-bar" style="margin-top: 20px;">
        <span>Filtrs:</span>
        <a href="/customers" class="<?php echo $currentFilter === 'all' ? 'active' : ''; ?>">Visi</a>
        <a href="/customers?with-orders=full" class="<?php echo $currentFilter === 'full' ? 'active' : ''; ?>">Ar pasūtījumiem</a>
        <a href="/customers?with-orders=none" class="<?php echo $currentFilter === 'none' ? 'active' : ''; ?>">Bez pasūtījumiem</a>
    </div>
</body>
</html>
