<?php

/**
 * Класс который обрабатывает информацию поступающую от пользователя
 *
 * В основном этот клас переваривает входящие GET и POST запросы, проверяет их
 * валидность и формирует в себе упорядоченный массив args, данные из которого
 * используются в других частях проекта, в качестве аргументов или условий.
 *
 * @param напрямую классу не нужны параметры, он слушает GET, POST и файл config.ini, но некоторые его методы могут принимать входящие параметры
 *
 * @return сам по себе класс ничего не возвращает, но основновным продуктом его деятельности является массив args
 */
class Argsmaker {

    /**
     * В массиве $args хранится вся структура того, что мы можем получить от пользователя или из конфига.
     */
    public $args = array(
        'mainlog' => array(
            'date' => array(
                'start' => "",
                'end' => ""
            ),
            'money' => "",
            'napravlenie' => "",
            '' => ""
        ),
        'pagenumber' => "",
        'elements_on_page' => "",
        'getpaymentmode' => "",
        'getpayment' => array(
            'id' => "",
            'format' => ""
        ),
        'deletepaymentmode' => "",
        'deletepayment' => array(
            'id' => ""
        ),
        'editpaymentmode' => "",
        'editpayment' => array(
            'id' => "",
            'date' => "",
            'money' => "",
            'napravlenie' => "",
            'category' => "",
            'subcategory' => ""
        ),
        'addpaymentmode' => "",
        'addmoney' => array(
            'date' => "",
            'money' => "",
            'napravlenie' => "",
            'category' => "",
            'subcategory' => ""
        ),
        'addcategorymode' => "",
        'addcategory' => array(
            'type' => "",
            'name' => ""
        ),
        'addsubcategorymode' => "",
        'addsubcategory' => array(
            'parentid' => "",
            'name' => ""
        ),
        'setupmode' => "",
        'setup' => array(
            'dbhost' => "",
            'dbname' => "",
            'dbuser' => "",
            'dbpaswrd' => "",
            'elements_on_page' => "",
            'login' => "",
            'passwrd' => "",
            'timezone' => ""
        )
    );
    protected $configini = array();
    protected $checktypes = array();

    /**
     * При создании argmaker собирает массив из имеющихся POST, GET и config.ini и не требует вмешательства
     */
    public function __construct() {
        $this->checktypes['date'] = "/^\d{4}-\d{2}-\d{2}$/";
        $this->checktypes['money'] = "/^\d{1,10}$/";
        $this->checktypes['int'] = "/^\d{1,10}$/";
        $this->checktypes['napravlenie'] = "/(^[0-1]$)|(^all$)/";
        if (file_exists('config.ini')) {
            $this->configini = parse_ini_file("config.ini");
            $this->setMainlogFromDate($this->datecheck(filter_input(INPUT_GET, 'datestart', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['date'])))));
            $this->setMainlogToDate($this->datecheck(filter_input(INPUT_GET, 'dateend', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['date'])))));
            $this->setMainlogMoney(filter_input(INPUT_GET, 'money', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['money']))));
            $this->setPageNumber(filter_input(INPUT_GET, 'page', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['int']))));
            $this->setMainlogElementsOnPage($this->configini['elements_on_page']);
            $this->setMainlogNapravlenie(filter_input(INPUT_GET, 'napravlenie', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['napravlenie']))));
            $this->setAddPaymentMode(filter_input(INPUT_GET, 'addpayment', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['int']))));
            if ($this->args['addpaymentmode'] == "1") {
                $this->setMoneyAddNapravlenie(filter_input(INPUT_GET, 'moneyaddnapravlenie', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['napravlenie']))));
                $this->setMoneyAddDate(filter_input(INPUT_GET, 'moneyadddate', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['date']))));
                $this->setMoneyAddCategory(filter_input(INPUT_GET, 'moneyaddcategory', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['int']))));
                $this->setMoneyAddSubcategory(filter_input(INPUT_GET, 'moneyaddsubcategory', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['int']))));
                $this->setMoneyAddMoney(filter_input(INPUT_GET, 'moneyaddmoney', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['int']))));
            }
            $this->setGetPaymentMode(filter_input(INPUT_GET, 'getpayment', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['int']))));
            if ($this->args['getpaymentmode'] == "1") {
                $this->setGetPaymentId(filter_input(INPUT_GET, 'getpaymentid', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['int']))));
                $this->setGetPaymentFormat(filter_input(INPUT_GET, 'getpaymentformat', FILTER_SANITIZE_STRING));
            }
            $this->setDeletePaymentMode(filter_input(INPUT_GET, 'deletepayment', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['int']))));
            if ($this->args['deletepaymentmode'] == "1") {
                $this->setMoneyDeleteId(filter_input(INPUT_GET, 'moneydeleteid', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['int']))));
            }
            $this->setEditPaymentMode(filter_input(INPUT_GET, 'editpayment', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['int']))));
            if ($this->args['editpaymentmode'] == "1") {
                $this->setMoneyEditId(filter_input(INPUT_GET, 'moneyeditid', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['int']))));
                $this->setMoneyEditNapravlenie(filter_input(INPUT_GET, 'moneyeditnapravlenie', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['napravlenie']))));
                $this->setMoneyEditDate(filter_input(INPUT_GET, 'moneyeditdate', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['date']))));
                $this->setMoneyEditCategory(filter_input(INPUT_GET, 'moneyeditcategory', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['int']))));
                $this->setMoneyEditSubcategory(filter_input(INPUT_GET, 'moneyeditsubcategory', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['int']))));
                $this->setMoneyEditMoney(filter_input(INPUT_GET, 'moneyeditmoney', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['int']))));
            }
            $this->setAddCategoryMode(filter_input(INPUT_GET, 'addcategory', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['int']))));
            if ($this->args['addcategorymode'] == "1") {
                $this->setAddCategoryType(filter_input(INPUT_GET, 'addcategorytype', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['napravlenie']))));
                $this->setAddCategoryName(filter_input(INPUT_GET, 'addcategoryname', FILTER_SANITIZE_STRING));
            }
            $this->setAddSubcategoryMode(filter_input(INPUT_GET, 'addsubcategory', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['int']))));
            if ($this->args['addsubcategorymode'] == "1") {
                $this->setAddSubcategoryParentId(filter_input(INPUT_GET, 'addsubcategoryparentid', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['int']))));
                $this->setAddSubcategoryName(filter_input(INPUT_GET, 'addsubcategoryname', FILTER_SANITIZE_STRING));
            }
        } else {
            if (filter_input(INPUT_POST, 'setupmode', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['int']))) == "1") {
                $this->autoSetup();
            }
        }
    }

    /**
     * Функция специально для проверки даты на валидность
     */
    protected function datecheck($data_forcheck) {
        $year = substr($data_forcheck, '0', '4');
        $mounth = substr($data_forcheck, '5', '2');
        $day = substr($data_forcheck, '8', '2');
        if (($year >= "0001" && $year <= "9999") && ($mounth >= "1" && $mounth <= "13") && ($day >= "1" && $day <= "31")) {
            $datedraft = DateTime::createFromFormat('Y-m-d', $data_forcheck);
            $date_aftercheck = $datedraft->format('Y-m-d');
        } else {
            $date_aftercheck = null;
        }
        return $date_aftercheck;
    }

    /**
     * Ниже идут однотипные методы для уставки того или иного элемента массива $args, их можно вызывать и извне класса
     */
    public function setMainlogFromDate($option) {
        $draft = $this->datecheck(filter_var($option, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['date']))));
        if ($draft) {
            $this->args['mainlog']['date']['start'] = $draft;
        }
    }

    public function setMainlogToDate($option) {
        $draft = $this->datecheck(filter_var($option, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['date']))));
        if ($draft) {
            $this->args['mainlog']['date']['end'] = $draft;
        }
    }

    public function setMainlogMoney($option) {
        $draft = filter_var($option, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['money'])));
        if ($draft) {
            $this->args['mainlog']['money'] = $draft;
        }
    }

    public function setPageNumber($option) {
        $draft = filter_var($option, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['int'])));
        if ($draft) {
            $this->args['pagenumber'] = $draft;
        } else {
            $this->args['pagenumber'] = '1';
        }
    }

    public function setMainlogElementsOnPage($option) {
        $draft = filter_var($option, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['int'])));
        if ($draft) {
            $this->args['elements_on_page'] = $draft;
        }
    }

    public function setMainlogNapravlenie($option) {
        $draft = filter_var($option, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['napravlenie'])));
        if ($draft) {
            $this->args['mainlog']['napravlenie'] = $draft;
        }
    }

    public function setMoneyAddNapravlenie($option) {
        $draft = filter_var($option, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['napravlenie'])));
        if ($draft) {
            $this->args['addmoney']['napravlenie'] = $draft;
        }
    }

    public function setMoneyAddMoney($option) {
        $draft = filter_var($option, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['money'])));
        if ($draft) {
            $this->args['addmoney']['money'] = $draft;
        }
    }

    public function setMoneyAddDate($option) {
        $draft = $this->datecheck(filter_var($option, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['date']))));
        if ($draft) {
            $this->args['addmoney']['date'] = $draft;
        }
    }

    public function setMoneyAddCategory($option) {
        $draft = filter_var($option, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['int'])));
        if ($draft) {
            $this->args['addmoney']['category'] = $draft;
        }
    }

    public function setMoneyAddSubcategory($option) {
        $draft = filter_var($option, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['int'])));
        if ($draft) {
            $this->args['addmoney']['subcategory'] = $draft;
        }
    }

    public function setAddPaymentMode($option) {
        $draft = filter_var($option, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['int'])));
        if ($draft == "1") {
            $this->args['addpaymentmode'] = $draft;
        }
    }

    public function setAddCategoryMode($option) {
        $draft = filter_var($option, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['int'])));
        if ($draft == "1") {
            $this->args['addcategorymode'] = $draft;
        }
    }

    public function setAddSubcategoryMode($option) {
        $draft = filter_var($option, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['int'])));
        if ($draft == "1") {
            $this->args['addsubcategorymode'] = $draft;
        }
    }

    public function setAddCategoryType($option) {
        $draft = filter_var($option, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['napravlenie'])));
        if ($draft) {
            $this->args['addcategory']['type'] = $draft;
        }
    }

    public function setAddCategoryName($option) {
        $draft = filter_var($option, FILTER_SANITIZE_STRING);
        if ($draft) {
            $this->args['addcategory']['name'] = $draft;
        }
    }

    public function setAddSubcategoryParentId($option) {
        $draft = filter_var($option, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['int'])));
        if ($draft) {
            $this->args['addsubcategory']['parentid'] = $draft;
        }
    }

    public function setAddSubcategoryName($option) {
        $draft = filter_var($option, FILTER_SANITIZE_STRING);
        if ($draft) {
            $this->args['addsubcategory']['name'] = $draft;
        }
    }

    public function setGetPaymentMode($option) {
        $draft = filter_var($option, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['int'])));
        if ($draft == "1") {
            $this->args['getpaymentmode'] = $draft;
        }
    }

    public function setGetPaymentId($option) {
        $draft = filter_var($option, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['int'])));
        if ($draft) {
            $this->args['getpayment']['id'] = $draft;
        }
    }

    public function setGetPaymentFormat($option) {
        $draft = filter_var($option, FILTER_SANITIZE_STRING);
        if ($draft) {
            $this->args['getpayment']['format'] = $draft;
        }
    }

    public function setDeletePaymentMode($option) {
        $draft = filter_var($option, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['int'])));
        if ($draft == "1") {
            $this->args['deletepaymentmode'] = $draft;
        }
    }

    public function setMoneyDeleteId($option) {
        $draft = filter_var($option, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['int'])));
        if ($draft) {
            $this->args['deletepayment']['id'] = $draft;
        }
    }

    public function setEditPaymentMode($option) {
        $draft = filter_var($option, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['int'])));
        if ($draft == "1") {
            $this->args['editpaymentmode'] = $draft;
        }
    }

    public function setMoneyEditId($option) {
        $draft = filter_var($option, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['int'])));
        if ($draft) {
            $this->args['editpayment']['id'] = $draft;
        }
    }

    public function setMoneyEditNapravlenie($option) {
        $draft = filter_var($option, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['napravlenie'])));
        if ($draft) {
            $this->args['editpayment']['napravlenie'] = $draft;
        }
    }

    public function setMoneyEditMoney($option) {
        $draft = filter_var($option, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['money'])));
        if ($draft) {
            $this->args['editpayment']['money'] = $draft;
        }
    }

    public function setMoneyEditDate($option) {
        $draft = $this->datecheck(filter_var($option, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['date']))));
        if ($draft) {
            $this->args['editpayment']['date'] = $draft;
        }
    }

    public function setMoneyEditCategory($option) {
        $draft = filter_var($option, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['int'])));
        if ($draft) {
            $this->args['editpayment']['category'] = $draft;
        }
    }

    public function setMoneyEditSubcategory($option) {
        $draft = filter_var($option, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $this->checktypes['int'])));
        if ($draft) {
            $this->args['editpayment']['subcategory'] = $draft;
        }
    }

    /**
     * Функция получения данных для проведения новой установки, она взаимодействует 
     * с POST напрямую, исходя из того, что на этапе установки пользователь знает,
     * что делает и посылает только то, что нужно.
     */
    public function autoSetup() {
        if ($_POST['setupmode'] == "1") {
            $this->args['setupmode'] = "1";
            $this->args['setup']['dbhost'] = $_POST['dbhost'];
            $this->args['setup']['dbname'] = $_POST['dbname'];
            $this->args['setup']['dbuser'] = $_POST['dbuser'];
            $this->args['setup']['dbpaswrd'] = $_POST['dbpaswrd'];
            $this->args['setup']['elements_on_page'] = $_POST['elements_on_page'];
            if ($this->args['setup']['elements_on_page'] == "") {
                $this->args['setup']['elements_on_page'] = "25";
            }
            $this->args['setup']['login'] = $_POST['login'];
            $this->args['setup']['passwrd'] = $_POST['passwrd'];
            $this->args['setup']['timezone'] = $_POST['timezone'];
        }
    }

}
