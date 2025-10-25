<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Aukcje</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
</head>
<body class="container">
    <main>
        <h1>Aukcje</h1>
        <p><a href="<?php echo site_url('auctions/create'); ?>">Utwórz aukcję</a></p>
        <table role="grid">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tytuł</th>
                    <th>Cena początkowa</th>
                    <th>Status</th>
                    <th>Utworzono</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($auctions as $a): ?>
                    <tr>
                        <td><a href="<?php echo site_url('auctions/'.$a['id']); ?>"><?php echo (int)$a['id']; ?></a></td>
                        <td><?php echo html_escape($a['title']); ?></td>
                        <td><?php echo number_format((float)$a['starting_price'], 2); ?></td>
                        <td><?php echo html_escape($a['status']); ?></td>
                        <td><?php echo html_escape($a['created_at']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
