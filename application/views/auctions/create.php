<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Nowa aukcja</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
</head>
<body class="container">
    <main>
        <h1>Nowa aukcja</h1>
        <?php if (validation_errors()): ?>
            <article style="color:#b00;">
                <?php echo validation_errors(); ?>
            </article>
        <?php endif; ?>
        <form method="post" action="<?php echo site_url('auctions/store'); ?>">
            <label>
                Tytuł
                <input type="text" name="title" required />
            </label>
            <label>
                Opis
                <textarea name="description" rows="5"></textarea>
            </label>
            <label>
                Cena początkowa
                <input type="number" step="0.01" name="starting_price" required />
            </label>
            <button type="submit">Zapisz</button>
        </form>
        <p><a href="<?php echo site_url('auctions'); ?>">Powrót</a></p>
    </main>
</body>
</html>
