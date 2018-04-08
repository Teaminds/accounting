<?php

/**
 * Контроллер категорий
 * 
 * Формирует список категорий и позволяет их добавлять
 */
if ($args->args['addcategorymode'] == '1') {
    Category::add_category($args->args['addcategory']['type'], $args->args['addcategory']['name']);
}
if ($args->args['addsubcategorymode'] == '1') {
    Category::add_subcategory($args->args['addsubcategory']['parentid'], $args->args['addsubcategory']['name']);
}
$data['category_and_subcategory_array'] = Category::get_category_and_subcategory_array();
include 'app/views/viewHeader.php';
include 'app/views/viewCategory.php';
include 'app/views/viewFooter.php';
