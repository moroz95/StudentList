<?php
/*
 * единая точка входа в приложение
 * сюда все переадресуем с помомщью htaccess
 */

ini_set("display_errors",1);
error_reporting(E_ALL);

function __autoload($class)
{
    require_once "../app/$class.php";
}

$app = new App();
