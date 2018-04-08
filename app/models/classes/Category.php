<?php

/**
 * Класс для работы с категориями.
 *
 * Состоит из статичных методов, для получения списка категорий/субукатегорий и
 * их создания
 */
class Category {

    /**
     * Метод получения древовидного списка всех категорий и их подкатегорий
     * @return array    Возвращает массив из категорий и их подкатегорий
     */
    public static function get_category_and_subcategory_array() {
        $mysql_string = "SELECT `category`.`TYPE`as'TYPE', `category`.`ID`AS'CATEGORY_ID', `category`.`NAME`AS'CATEGORY_NAME', `subcategory`.`ID`AS'SUBCATEGORY_ID',`subcategory`.`NAME`as'SUBCATEGORY_NAME' FROM `category` LEFT JOIN `subcategory` ON `category`.`ID`=`subcategory`.`CATEGORY`;";
        $dbconnect = new Db();
        $rawarray = $dbconnect->mysql_query_in_array($mysql_string);
        unset($dbconnect);
        foreach ($rawarray as $value) {
            $result['category_list'][$value['TYPE']][$value['CATEGORY_ID']] = $value['CATEGORY_NAME'];
            $result['subcategory_list'][$value['CATEGORY_ID']][$value['SUBCATEGORY_ID']] = $value['SUBCATEGORY_NAME'];
        }
        return $result;
    }

    /**
     * Метод создания новой категории
     * @param string $type - Тип создаваемой категории, 1 или 0, обозначает "Доход" и "Расход" соответственно.
     * @param string $categoryname - Имя создаваемой категории
     */
    public static function add_category($type, $categoryname) {
        $mysql_string = "INSERT INTO `category` (`TYPE`, `NAME`) VALUES ('$type', '$categoryname')";
        $dbconnect = new Db();
        $category = $dbconnect->mysql_query_in_none($mysql_string);
        unset($dbconnect);
        return $category;
    }

    /**
     * Метод создания новой подкатегории
     * @param int $categoryid - id категории к которой относится создаваемая подкатегория
     * @param string $subcategoryname - Имя создаваемой подкатегории
     */
    public static function add_subcategory($categoryid, $subcategoryname) {
        $mysql_string = "INSERT INTO `subcategory` (`CATEGORY`, `NAME`) VALUES ('$categoryid', '$subcategoryname')";
        $dbconnect = new Db();
        $subcategory = $dbconnect->mysql_query_in_none($mysql_string);
        unset($dbconnect);
        return $subcategory;
    }

}
