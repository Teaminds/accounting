<?php

/**
 * Класс для формирования постраничной навигации
 * 
 * Формирует массив с кнопками для постраничной навигации. Чтобы в итоге получить
 * что-то вроде: 1 ... 8 9 10 ... 19
 * 
 * @param int $allrows - сколько всего элементов
 * @param int $curpage - какая сейчас страница
 * @param int $elements_on_page - сколько элементов на одной странице
 * @param int $list_lengh - количество отображаемый страниц в постраничной навигации (опционально)
 *
 * @return array - возвращает массив для отрисовки постраничной навигации
 */
class Pagination {

    public $allrows = "";
    public $curpage = "";
    public $elements_on_page = "";
    public $pagetotal = "";
    public $list_lengh = "";
    public $buttons = array();

    public function __construct($allrows, $curpage, $elements_on_page, $list_lengh = "3") {
        $this->allrows = $allrows;
        $this->curpage = $curpage;
        $this->elements_on_page = $elements_on_page;
        $this->list_lengh = $list_lengh;
        $this->pagetotal = ceil($this->allrows / $this->elements_on_page);
        $this->make_buttons();
    }

    /**
     * Служебные функции
     */
    protected function get_first() {
        $button['text'] = "1";
        $button['type'] = "page_from_list";
        return $button;
    }

    protected function get_last() {
        $button['text'] = $this->pagetotal;
        $button['type'] = "page_from_list";
        return $button;
    }

    protected function get_current() {
        $button['text'] = $this->curpage;
        $button['type'] = "page_current";
        return $button;
    }

    protected function get_separator() {
        $button['text'] = "...";
        $button['type'] = "separator";
        return $button;
    }

    protected function get_button($number) {
        $button['text'] = $number;
        $button['type'] = "page_from_list";
        return $button;
    }

    /**
     * Самая главная функция, именно она и сохжает постраничную навигацию
     */
    public function make_buttons() {
        if ($this->curpage > 1) {                                                               //Если текущая страница не первая,
            $buttons[] = $this->get_first();                                                    //то добавляем в постраничку блок "Первая страница"
            if ($this->curpage - $this->list_lengh > 2) {                                       //Если между текущей и первой страницами расстояние слишкм большое
                $buttons[] = $this->get_separator();                                            //то добавляем "Разделитель"
            }
            $i = "0";
            while ($i < $this->list_lengh) {                                                    //Цикл для добавления кнопок из центрального блока слева от текущей страницы
                if (($this->curpage - $this->list_lengh + $i) > 1) {
                    $buttons[] = $this->get_button($this->curpage - $this->list_lengh + $i);
                }
                $i++;
            }
            unset($i);
        }
        $buttons[] = $this->get_current();                                                      //Добавляем текущую страницу
        if ($this->curpage < $this->pagetotal) {                                                //Если мы не на последней странице, то делаем кнопки в центральном блоке справа от текущей страницы
            $i = "0";
            $ii = "1";
            while (($i < $this->list_lengh) && (($this->curpage + $ii) < $this->pagetotal)) {
                $buttons[] = $this->get_button($this->curpage + $ii);
                $ii++;
                $i++;
            }
            unset($i, $ii);
            if ($this->pagetotal - $this->list_lengh - $this->curpage > 1) {                    //Если между текущей и последней страницами расстояние слишкм большое
                $buttons[] = $this->get_separator();                                            //то добавляем "Разделитель"
            }
            $buttons[] = $this->get_last();                                                     //Добавляем блок "Последняя страница"
        }
        $this->buttons = $buttons;
    }

}
