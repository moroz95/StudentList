<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Тайтл</title>
	<link href="/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="/css/main.css">
</head>
<body>
<ul class="nav nav-tabs">
	<li role="presentation" <?php $page == 'index' and print "class='active'"?>><a href="/index">Студенты</a></li>
	<li role="presentation" <?php $page == 'edit' and print "class='active'"?>><a href="/edit">Изменение информации</a></li>
	<li role="presentation" <?php $page == 'register' and print "class='active'"?>><a href="/register">Регистрация</a></li>
</ul>
	<?= $content ?>
</body>
</html>