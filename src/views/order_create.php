<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jauns pasūtījums - Veikals</title>
    <link rel="icon" href="/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/style.css">
</head>
<body>
    <?php include 'nav.php'; ?>

    <h1>Izveidot jaunu pasūtījumu</h1>

    <div class="form-container">
        <form action="/orders/store" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="order_date">Pasūtījuma datums</label>
                <input type="date" id="order_date" name="order_date" required value="<?php echo date('Y-m-d'); ?>">
            </div>

            <div class="form-group">
                <label for="status">Statuss</label>
                <select id="status" name="status" required>
                    <option value="new">Jauns</option>
                    <option value="paid">Apmaksāts</option>
                    <option value="delivered">Piegādāts</option>
                </select>
            </div>

            <div class="form-group">
                <label for="customer_id">Klients</label>
                <select id="customer_id" name="customer_id" required>
                    <option value="">— Izvēlieties klientu —</option>
                    <?php foreach ($customers as $customer): ?>
                        <option value="<?php echo $customer->id; ?>">
                            <?php echo htmlspecialchars($customer->first_name . ' ' . $customer->last_name); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="image">Pasūtījuma attēls</label>
                <input type="file" id="image" name="image" accept="image/*">
            </div>

            <div class="form-group">
                <label for="comment">Komentārs</label>
                <textarea id="comment" name="comment" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Saglabāt pasūtījumu</button>
        </form>
    </div>

    <p class="back-link">
        <a href="/orders">← Atpakaļ uz sarakstu</a>
    </p>
</body>
</html>
