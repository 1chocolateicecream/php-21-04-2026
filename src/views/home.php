<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sākums - Veikals</title>
    <link rel="icon" href="/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/style.css">
</head>
<body>
    <?php include 'nav.php'; ?>

    <h1>Veikala Statistika</h1>

    <div class="stats-container">
        <div class="stat-card customers">
            <h2>Klienti</h2>
            <p class="stat-number"><?php echo $customerCount; ?></p>
        </div>
        <div class="stat-card orders">
            <h2>Pasūtījumi</h2>
            <p class="stat-number"><?php echo $orderCount; ?></p>
        </div>
    </div>

    <div class="hero">
        <p>Laipni lūdzam veikala vadības sistēmā!</p>
        <img src="/images/title_miku.png" alt="Miku">
    </div>
</body>
</html>
