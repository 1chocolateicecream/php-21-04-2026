<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Labot pasūtījumu #<?php echo htmlspecialchars($order->id); ?> — Veikals</title>
    <link rel="icon" href="/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/style.css">
</head>
<body>
    <?php include 'nav.php'; ?>

    <h1>Labot pasūtījumu #<?php echo htmlspecialchars($order->id); ?></h1>

    <div class="form-container">
        <form action="/orders/<?php echo $order->id; ?>/update" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($order->image ?? ''); ?>">

            <div class="form-group">
                <label for="order_date">Pasūtījuma datums</label>
                <input type="date" id="order_date" name="order_date" required
                       value="<?php echo htmlspecialchars($order->order_date); ?>">
            </div>

            <div class="form-group">
                <label for="status">Statuss</label>
                <select id="status" name="status" required>
                    <option value="new"       <?php echo $order->status === 'new'       ? 'selected' : ''; ?>>Jauns</option>
                    <option value="paid"      <?php echo $order->status === 'paid'      ? 'selected' : ''; ?>>Apmaksāts</option>
                    <option value="delivered" <?php echo $order->status === 'delivered' ? 'selected' : ''; ?>>Piegādāts</option>
                </select>
            </div>

            <div class="form-group">
                <label for="customer_id">Klients</label>
                <select id="customer_id" name="customer_id" required>
                    <option value="">— Izvēlieties klientu —</option>
                    <?php foreach ($customers as $customer): ?>
                        <option value="<?php echo $customer->id; ?>"
                            <?php echo $customer->id === $order->customer_id ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($customer->first_name . ' ' . $customer->last_name); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="shipping_date">Piegādes datums</label>
                <input type="date" id="shipping_date" name="shipping_date"
                       value="<?php echo htmlspecialchars($order->shipping_date ?? ''); ?>">
            </div>

            <div class="form-group">
                <label for="image">Pasūtījuma attēls</label>
                <?php if ($order->image): ?>
                    <img src="/<?php echo htmlspecialchars($order->image); ?>" alt="Pašreizējais attēls" width="80" class="miku-img" style="display:block;margin-bottom:8px;">
                <?php endif; ?>
                <input type="file" id="image" name="image" accept="image/*">
            </div>

            <div class="form-group">
                <label for="comment">Komentārs</label>
                <textarea id="comment" name="comment" rows="3"><?php echo htmlspecialchars($order->comment ?? ''); ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Saglabāt izmaiņas</button>
        </form>

        <form action="/orders/<?php echo $order->id; ?>/delete" method="POST" style="margin-top:16px;">
            <button type="submit" class="btn btn-danger"
                    onclick="return confirm('Vai tiešām dzēst pasūtījumu #<?php echo $order->id; ?>?')">
                Dzēst pasūtījumu
            </button>
        </form>
    </div>

    <p class="back-link">
        <a href="/orders">← Atpakaļ uz sarakstu</a>
    </p>
</body>
</html>
