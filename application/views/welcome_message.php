<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f7f7;
            color: #333;
            margin: 0;
            padding: 40px;
        }
        .container {
            max-width: 640px;
            margin: 0 auto;
            background: #fff;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.05);
        }
        h1 {
            margin-top: 0;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        code {
            background: #f0f0f0;
            padding: 2px 4px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></h1>
        <p><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></p>
        <p>Witryna korzysta z odchudzonego frameworka wzorowanego na CodeIgniter 3. Sprawdź inne adresy, np. <code><a href="<?= htmlspecialchars(config_item('base_url') . 'hello/Anna', ENT_QUOTES, 'UTF-8'); ?>">/hello/Anna</a></code>.</p>
    </div>
</body>
</html>
