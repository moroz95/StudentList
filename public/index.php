<?php
/*
 * единая точка входа в приложение
 * сюда все переадресуем с помомщью htaccess
 */


function __autoload($class)
{
    require_once "../app/$class.php";
}

function h($str)
{
    return htmlentities($str, ENT_QUOTES, 'UTF-8');
}

$app = new FrontController($development = true);
$app->start();