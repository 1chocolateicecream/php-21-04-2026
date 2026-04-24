<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasūtījums #<?php echo htmlspecialchars($order->id); ?> — Veikals</title>
    <link rel="icon" href="/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/style.css">
</head>
<body>
    <?php include 'nav.php'; ?>

    <div class="receipt-actions no-print">
        <a href="/orders" class="btn btn-add">← Pasūtījumi</a>
        <button onclick="window.print()" class="btn btn-print">Drukāt</button>
    </div>

    <div class="receipt">

        <div class="receipt-header">
            <div class="receipt-store-name">Veikals</div>
            <div class="receipt-subtitle">Pasūtījuma čeks</div>
            <div class="receipt-id">#<?php echo htmlspecialchars($order->id); ?></div>
        </div>

        <div class="receipt-divider"></div>

        <div class="receipt-row">
            <span class="receipt-label">Klients</span>
            <span class="receipt-value"><?php echo htmlspecialchars($order->first_name . ' ' . $order->last_name); ?></span>
        </div>

        <div class="receipt-row">
            <span class="receipt-label">Pasūtījuma datums</span>
            <span class="receipt-value"><?php echo htmlspecialchars($order->order_date); ?></span>
        </div>

        <div class="receipt-row">
            <span class="receipt-label">Statuss</span>
            <span class="receipt-value">
                <span class="status-badge status-<?php echo htmlspecialchars($order->status); ?>">
                    <?php echo htmlspecialchars($order->status); ?>
                </span>
            </span>
        </div>

        <?php if ($order->shipping_date): ?>
        <div class="receipt-row">
            <span class="receipt-label">Piegādes datums</span>
            <span class="receipt-value"><?php echo htmlspecialchars($order->shipping_date); ?></span>
        </div>
        <?php endif; ?>

        <?php if ($order->comment): ?>
        <div class="receipt-divider"></div>
        <div class="receipt-comment">
            <span class="receipt-label">Komentārs</span>
            <p><?php echo nl2br(htmlspecialchars($order->comment)); ?></p>
        </div>
        <?php endif; ?>

        <?php if ($order->image): ?>
        <div class="receipt-divider"></div>
        <div class="receipt-image-wrap">
            <img src="/<?php echo htmlspecialchars($order->image); ?>" alt="Pasūtījuma attēls" class="receipt-image miku-img">
        </div>
        <?php endif; ?>

        <div class="receipt-divider"></div>

        <div class="receipt-footer">Paldies par pasūtījumu! ♡</div>

        <?php if (file_exists(__DIR__ . '/../../public/images/miku-stamp.png')): ?>
        <img src="/images/miku-stamp.png" alt="Miku" class="miku-stamp">
        <?php endif; ?>

    </div>
</body>
</html>
