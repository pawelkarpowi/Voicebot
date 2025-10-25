<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Aukcja #<?php echo (int)$auction['id']; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
</head>
<body class="container">
    <main>
        <h1><?php echo html_escape($auction['title']); ?></h1>
        <p><strong>Cena początkowa:</strong> <?php echo number_format((float)$auction['starting_price'], 2); ?></p>
        <p><strong>Status:</strong> <?php echo html_escape($auction['status']); ?></p>
        <article>
            <?php echo nl2br(html_escape($auction['description'])); ?>
        </article>
        <p><a href="<?php echo site_url('auctions'); ?>">Powrót</a></p>
    </main>
</body>
</html>
