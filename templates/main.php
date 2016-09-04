<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $url_template ?></title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
<ul class="nav nav-tabs">
    <li role="presentation" <?php (($url_template == 'index') OR ($url_template == 'search')) and print "class='active'" ?>><a href="/index">Студенты</a></li>
    <?php if (isset($_COOKIE['password'])): ?>
        <li role="presentation" <?php $url_template == 'edit' and print "class='active'" ?>><a href="/edit">Изменение информации</a></li>
    <?php else: ?>
        <li role="presentation" <?php $url_template == 'register' and print "class='active'" ?>><a href="/register">Регистрация</a></li>
    <?php endif; ?>
</ul>
<?= $content ?>
</body>
</html>