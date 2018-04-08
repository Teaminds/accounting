<?php

/**
 * Контроллер для установки
 * 
 * Содержит функцию для формирования списка тайм-зон для выбора пояса в форме
 * установки. А так же отвечает за запуск самого процесса установки. По окончанию
 * которой перенаправляет на главную страницу
 */
function timezonelist() {
    $time = time();
    $timezonelist = array();
    $timezoneidlist = timezone_identifiers_list();
    foreach ($timezoneidlist as $timezoneidlistkey => $timezoneidlistvalue) {
        date_default_timezone_set($timezoneidlistvalue);
        $timezonelist[$timezoneidlistkey]['gGMT'] = 'UTC/GMT ' . date('P', $time);
        $timezonelist[$timezoneidlistkey]['zone'] = $timezoneidlistvalue;
    }
    asort($timezonelist);
    foreach ($timezonelist as $timezonelistvalue) {
        $zone = $timezonelistvalue['zone'];
        $gGMT = $timezonelistvalue['gGMT'];
        echo
        <<<END
          <option value="$zone">$gGMT - $zone</option> 
END;
    }
}

if ($args->args['setupmode'] == "1") {
    Setup::newInstall($args->args['setup']);
    $host = $_SERVER['HTTP_HOST'];
    $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    header("Location: http://$host$uri");
    exit;
}
include 'app/views/viewHeader.php';
include 'app/views/viewSetup.php';
include 'app/views/viewFooter.php';
