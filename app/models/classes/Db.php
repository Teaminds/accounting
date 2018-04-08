<?php

/**
 * Класс для работы с базой данных
 * 
 * Представляет из себя набор методов для упрощения проведения запросов к БД
 */
class Db {

    protected $dbhost;
    protected $dbuser;
    protected $dbpswd;
    protected $dbname;
    protected $mysqli;

    /**
     * При создании парсится config.ini, и формируется соединение с БД
     */
    public function __construct() {
        $configini = parse_ini_file("config.ini");
        $this->dbhost = $configini['dbhost'];
        $this->dbuser = $configini['dbuser'];
        $this->dbpswd = $configini['dbpswd'];
        $this->dbname = $configini['dbname'];
        $this->mysqli = new mysqli($this->dbhost, $this->dbuser, $this->dbpswd, $this->dbname);
        $this->mysqli->set_charset('utf8');
    }

    /**
     * По уничтожению экземпляра - соединение принудительно закрывается
     */
    public function __destruct() {
        $this->mysqli->close();
    }

    /**
     * Запрос в БД с получением результатов в виде массива
     * @param string $mysql_string - само тело запроса к БД
     * @return array - возвращает массив с результатом
     */
    public function mysql_query_in_array($mysql_string) {
        $list = NULL;
        $mysql_query = $this->mysqli->query($mysql_string);
        while ($mysql_array = mysqli_fetch_assoc($mysql_query)) {
            $list[] = $mysql_array;
        }
        return $list;
    }

    /**
     * Запрос в БД с получением результатов в виде строки
     * @param string $mysql_string - само тело запроса к БД
     * @return string - возвращает строку
     */
    public function mysql_query_in_var($mysql_string) {
        $mysql_result = $this->mysqli->query($mysql_string);
        $result = $mysql_result->fetch_object();
        return $result;
    }

    /**
     * Запрос в БД без получения результата
     * @param string $mysql_string - само тело запроса к БД
     */
    public function mysql_query_in_none($mysql_string) {
        $mysql_result = $this->mysqli->query($mysql_string);
    }

}
