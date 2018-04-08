<?php
/**
 * Представление для установки
 */
?>
<div class="row">
    <div class="col-12">
        <h2>Последний этап установки</h2>
    </div>
</div>
<form enctype="multipart/form-data" action="" method="POST">
    <input type="hidden" value="1" name="setupmode" id="edit">
    <div class="row">
        <div class="col-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">База данных</h3>
                </div>
                <div class="panel-body">
                    <p>
                        Укажите данные для подключения к вашей существующей базе данных. В ней сервис будет хранить все свои данные.
                    </p>
                    <div class="form-group">
                        <label for="dbhost">Адрес</label>
                        <input required type="text" class="form-control" name="dbhost" id="dbhost" placeholder="Например localhost">
                    </div>
                    <div class="form-group">
                        <label for="dbname">Имя</label>
                        <input required type="text" class="form-control" name="dbname" id="dbname" placeholder="Например orion_hmstat">
                    </div>
                    <div class="form-group">
                        <label for="dbuser">Пользователь</label>
                        <input required type="text" class="form-control" name="dbuser" id="dbuser" placeholder="Например orion_user">
                    </div>
                    <div class="form-group">
                        <label for="dbpaswrd">Пароль</label>
                        <input required type="text" class="form-control" name="dbpaswrd" id="dbpaswrd" placeholder="Например hfsjk$*$342j">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Настройки входа</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="login">Желаемый логин</label>
                        <input type="text" class="form-control" name="login" id="login" placeholder="Например orion">
                    </div>
                    <div class="form-group">
                        <label for="passwrd">Желаемый пароль</label>
                        <input type="password" class="form-control" name="passwrd" id="passwrd" placeholder="Например Prosto-Ochen-Dlinniy-Parol-2017">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Дополнительные функции</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="timezone">Выберете часовой пояс</label>
                        <select required class="form-control" name="timezone" id="timezone">
                            <option value="Europe/Moscow">UTC/GMT +03:00 - Europe/Moscow</option>
                            <?php timezonelist() ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="elements_on_page">Количество строк для главной таблицы</label>
                        <input type="text" class="form-control" name="elements_on_page" id="elements_on_page" placeholder="Например 25">
                        <span id="helpBlock2elements_on_page" class="help-block">Сколько строк будет отображаться на главном экране с приходами и расходами (рекомендуется 25)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <p class="center">
                <button type="submit" class="btn btn-default btn-lg btn-block">Завершить установку</button>
            </p>
        </div>
    </div>
</form>