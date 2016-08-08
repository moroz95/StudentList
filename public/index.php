<?php
/*
 * единая точка входа в приложение
 * сюда все переадресуем с помомщью htaccess
 */

ini_set("display_errors",1);
error_reporting(E_ALL);

require_once '../app/App.php';
require_once '../app/Controller.php';
require_once '../app/StudentDataGateway.php';
require_once '../app/StudentModel.php';
require_once '../app/Validation.php';

$app = new App();
