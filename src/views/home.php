<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sākums - Veikals</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
    <?php include 'nav.php'; ?>
    
    <h1>Veikala Statistika</h1>
    
    <div style="display: flex; gap: 20px; margin-top: 20px;">
        <div style="background: white; padding: 30px; border: 2px solid #86d2cc; border-radius: 12px; text-align: center; min-width: 200px;">
            <h2 style="color: #2a8f87; margin: 0;">Klienti</h2>
            <p style="font-size: 3rem; font-weight: bold; margin: 10px 0;"><?php echo $customerCount; ?></p>
        </div>
        
        <div style="background: white; padding: 30px; border: 2px solid #f89bc9; border-radius: 12px; text-align: center; min-width: 200px;">
            <h2 style="color: #f89bc9; margin: 0;">Pasūtījumi</h2>
            <p style="font-size: 3rem; font-weight: bold; margin: 10px 0;"><?php echo $orderCount; ?></p>
        </div>
    </div>

    <div style="margin-top: 40px; text-align: center;">
        <p>Laipni lūdzam veikala vadības sistēmā!</p>
        <img src="/images/title_miku.png" alt="Miku" style="width: 80%; max-width: 800px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); border: 3px solid #86d2cc;">
    </div>
</body>
</html>
