<?php

/**
 * Контроллер для главной страницы
 * 
 * Получает список категорий для формы добавления платежей
 */
$data['category_and_subcategory_array'] = Category::get_category_and_subcategory_array();
include 'app/views/viewHeader.php';
include 'app/views/viewIndex.php';
include 'app/views/viewPaymenteditmodal.php';
include 'app/views/viewFooter.php';
