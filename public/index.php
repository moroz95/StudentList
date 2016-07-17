<?php
/*
 * единая точка входа в приложение
 * сюда все переадресуем с помомщью htaccess
 */

require_once '../app/App.php';

new App();