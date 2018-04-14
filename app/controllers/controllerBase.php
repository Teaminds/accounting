<?php

/**
 * Главный контроллер. 
 * 
 * Содержит автоподгрузку классов, запускает формироване массива аргуметов 
 * олученных от пользователя, осуществляет маршрутизацию
 */
spl_autoload_register(function ($class) {
    include './app/models/classes/' . $class . '.php';
});
$args = new Argsmaker();
$data['links']['start'] = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$cleanuri = substr($_SERVER['REQUEST_URI'], strlen($data['links']['start']) + 1);
if (file_exists('config.ini')) { //если есть конфиг-файл, всё в порядке, если нет, то запускаем установку
    $uri = explode('/', $cleanuri);
    $uri = explode('?', $uri['0']);
    switch ($uri['0']) {
        case '':
            include 'app/controllers/controllerIndex.php';
            break;
        case 'mainlog':
            include 'app/controllers/controllerMainlog.php';
            break;
        case 'category':
            include 'app/controllers/controllerCategory.php';
            break;
        case 'paymenttools':
            include 'app/controllers/controllerPaymenttools.php';
            break;
        case 'index':
            include 'app/controllers/controllerIndex.php';
            break;
    }
} else {
    include 'app/controllers/controllerSetup.php';
}