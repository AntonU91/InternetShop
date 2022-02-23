<?php

//1. Общие настройки
ini_set("display_errors",1);
error_reporting(E_ALL);

// 2. Подключение файлов системы
const ROOT = __DIR__;
require_once (ROOT."/components/Router.php");
//require_once (ROOT. "/views/site/index.php");





// 3. Установка подключения к БД


//4. Вызов роутера
$router =  new Router();
$router->run();