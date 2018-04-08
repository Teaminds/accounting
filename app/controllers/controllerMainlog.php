<?php

/**
 * Контроллер для списка платежей
 * 
 * Отвечает за запуск добавления платежа и вывод списка
 */
if ($args->args['addpaymentmode'] == "1") {
    Payment::add($args->args['addmoney']['money'], $args->args['addmoney']['date'], $args->args['addmoney']['napravlenie'], $args->args['addmoney']['category'], $args->args['addmoney']['subcategory']);
}
$data['array_for_payment_list'] = Payment::getlist($args->args['mainlog']['date'], $args->args['mainlog']['napravlenie'], $args->args['elements_on_page'], $args->args['pagenumber'], 'data');
$data['total_rows'] = Payment::getlist($args->args['mainlog']['date'], $args->args['mainlog']['napravlenie'], $args->args['elements_on_page'], $args->args['pagenumber'], 'count');
$data['curpage'] = $args->args['pagenumber'];
$data['elements_on_page'] = $args->args['elements_on_page'];
$pagination = new Pagination($data['total_rows'], $data['curpage'], $data['elements_on_page']);
include 'app/views/viewMainlog.php';
