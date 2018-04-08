<?php

/**
 * Класс для работы с доходами и расходами
 * 
 * Класс включает в себя методы получения данных о платежах и добавлении платежей
 */
class Payment {

    /**
     * Функция для получения списка платежей
     * @param array $when - массив с датами 'start' и 'end' для ограничения списка
     * @param string $napravlenie - указание будет ли фильтрация по типу Доход или Расход (1 или 0)
     * @param int $how_much - количество строк на страницу
     * @param int $page - страница списка которую надо получить
     * @param string $type - тип вывода, 'data' для данных и 'count' для количества
     * @return array - в итоге получаем массив со строками списка почти готовый для передачи в представление
     */
    public static function getlist($when, $napravlenie, $how_much, $page, $type = "data") {
        $testargs = array($when, $napravlenie, $how_much, $page, $type);
        $where = NULL;
        if ($when['start'] && $when['end']) {
            $where = "`DATE` between '" . $when['start'] . "' AND '" . $when['end'] . "' ";
        }
        if ($when['start'] && !$when['end']) {
            $where = "`DATE` >= '" . $when['start'] . "' ";
        }
        if (!$when['start'] && $when['end']) {
            $where = "`DATE` <= '" . $when['end'] . "' ";
        }

        if ($napravlenie == "1" || $napravlenie == "0") {
            $where .= "`TYPE`='" . $value . "' ";
        }
        if (isset($where)) {
            $where = " WHERE " . $where;
        }
        $dbconnect = new Db();
        switch ($type) {
            case "data" :
                $where .= "ORDER BY `DATE` DESC LIMIT $how_much OFFSET " . ($page - 1) * $how_much;
                $mysql_string = "SELECT `money_operations`.`ID`AS'ID', `money_operations`.`DATE`AS'DATE', `money_operations`.`TYPE`AS`TYPE`, `category`.`NAME`AS'CATEGORY', `subcategory`.`NAME`as'SUBCATEGORY', `money_operations`.`MONEY`AS'MONEY' FROM `money_operations` INNER JOIN `category` ON `money_operations`.`CATEGORY`=`category`.`ID` LEFT JOIN`subcategory` ON `money_operations`.`SUBCATEGORY`=`subcategory`.`ID` $where";
                $result = $dbconnect->mysql_query_in_array($mysql_string);
                if (!$result) {
                    $result[0] = array(
                        'ID' => '',
                        'DATE' => '',
                        'TYPE' => '',
                        'CATEGORY' => 'нет записей',
                        'SUBCATEGORY' => '',
                        'MONEY' => ''
                    );
                }
                break;
            case "count" :
                $mysql_string = "SELECT COUNT(`money_operations`.`ID`) as COUNT FROM `money_operations` INNER JOIN `category` ON `money_operations`.`CATEGORY`=`category`.`ID` LEFT JOIN`subcategory` ON `money_operations`.`SUBCATEGORY`=`subcategory`.`ID` $where";
                $result = $dbconnect->mysql_query_in_var($mysql_string);
                $result = $result->COUNT;
                break;
        }
        unset($dbconnect);
        return $result;
    }

    /**
     * Функция добавления нового платежа
     * @param int $money - сумма денег, пока что без точки
     * @param string $date - дата в формате "2018-04-28"
     * @param int $type - Доход или Расход (1 или 0 соответственно) - несколько избыточно при наличии категорий и подкатегорий, но пока живем так
     * @param int $category - id категории, несколько избыточно при наличии подкатегорий, но пока живем так
     * @param int $subcategory - id подкатегории
     */
    public static function add($money, $date, $type, $category, $subcategory) {
        $mysql_string = "INSERT INTO `money_operations` (`MONEY`, `DATE`, `TYPE`, `CATEGORY`, `SUBCATEGORY` ) VALUES ('$money', '$date', '$type', '$category', '$subcategory' )";
        $dbconnect = new Db();
        $list = $dbconnect->mysql_query_in_none($mysql_string);
        unset($dbconnect);
        return $list;
    }

}
