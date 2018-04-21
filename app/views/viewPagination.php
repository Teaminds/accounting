<?php
/**
 * Представление для постраничной навигации
 */
?>
<nav activepage="<?= $data['curpage'] ?>" id="pagination" aria-label="Page navigation">
    <ul class="pagination">
        <?php
        $newpage = "";
        $paginationdopclass = "";
        foreach ($pagination->buttons as $value) {
            switch ($value['type']) {
                case "separator":
                    $paginationdopclass = "disabled";
                    break;
                case "page_current":
                    $paginationdopclass = "active";
                    break;
                case "page_from_list":
                    $newpage = $value['text'];
                    break;
            }
            $button = '<li class="page-item ' . $paginationdopclass . ' ' . $value['type'] . '" onclick="updatemainlog(' . $newpage . ')"><div class="page-link">' . $value['text'] . '</div></li>';
            echo $button;
            $paginationdopclass = "";
            $newpage = "";
        }
        ?>
    </ul>
</nav>