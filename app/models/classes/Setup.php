<?php

/**
 * Класс для автоматической установки
 * 
 * При получении массива с данными для становки создает таблицы, генерирует 
 * config.ini, .htaccess и, при необходимости, .htpasswd
 */
class Setup {

    public static function newInstall($options) {
        $setupdata[] = "[misc]" . PHP_EOL;
        $setupdata[] = 'timezone = "' . $options['timezone'] . '"' . PHP_EOL;
        if ($options['elements_on_page'] != "") {
            $setupdata[] = 'elements_on_page = "' . $options['elements_on_page'] . '"' . PHP_EOL;
        }
        $setupdata[] = ' ' . PHP_EOL;
        $setupdata[] = '[database]' . PHP_EOL;
        $setupdata[] = 'dbhost = "' . $options['dbhost'] . '"' . PHP_EOL;
        $setupdata[] = 'dbname = "' . $options['dbname'] . '"' . PHP_EOL;
        $setupdata[] = 'dbuser = "' . $options['dbuser'] . '"' . PHP_EOL;
        $setupdata[] = 'dbpswd = "' . $options['dbpaswrd'] . '"' . PHP_EOL;
        $dbh = new mysqli($options['dbhost'], $options['dbuser'], $options['dbpaswrd'], $options['dbname']);
        $dbh->set_charset('utf8');

        $crtable[] = "CREATE TABLE `category` (`ID` int(11) NOT NULL, `TYPE` tinyint(1) NOT NULL,`NAME` tinytext COLLATE utf8_unicode_ci NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
        $crtable[] = "CREATE TABLE `money_operations` (`ID` int(11) NOT NULL,`DATE` date NOT NULL,`TYPE` tinyint(1) NOT NULL,`CATEGORY` int(11) NOT NULL,`SUBCATEGORY` int(11) DEFAULT NULL,`MONEY` float NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
        $crtable[] = "CREATE TABLE `subcategory` (`ID` int(11) NOT NULL,`CATEGORY` int(11) NOT NULL,`NAME` text COLLATE utf8_unicode_ci NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";

        $altable[] = "ALTER TABLE `category` ADD PRIMARY KEY (`ID`), ADD KEY `category_id_name` (`ID`,`NAME`(20));";
        $altable[] = "ALTER TABLE `money_operations` ADD PRIMARY KEY (`ID`), ADD KEY `type` (`TYPE`);";
        $altable[] = "ALTER TABLE `subcategory` ADD PRIMARY KEY (`ID`);";
        $altable[] = "ALTER TABLE `category` MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;";
        $altable[] = "ALTER TABLE `money_operations` MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;";
        $altable[] = "ALTER TABLE `subcategory` MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;";

        foreach ($crtable as $crtablevalue) {
            $create = $dbh->query("$crtablevalue");
        }
        foreach ($altable as $altablevalue) {
            $alter = $dbh->query("$altablevalue");
        }
        $htaccessdata = 'AddDefaultCharset UTF-8' . PHP_EOL . '<IfModule mod_rewrite.c>' . PHP_EOL . '  RewriteEngine On' . PHP_EOL . '  RewriteCond %{REQUEST_FILENAME} !^favicon\.ico' . PHP_EOL . '  RewriteCond %{REQUEST_FILENAME} !-d' . PHP_EOL . '  RewriteCond %{REQUEST_FILENAME} !-f' . PHP_EOL . '  RewriteRule ^(.*)$ index.php [L,QSA]' . PHP_EOL . '</IfModule>' . PHP_EOL . '<FilesMatch "(.htpasswd|.gitignore|config.ini)$">' . PHP_EOL . '  Order allow,deny' . PHP_EOL . '  Deny from all' . PHP_EOL . '</FilesMatch>' . PHP_EOL;
        if ($options['login'] != "" && $options['passwrd'] != "") {
            $encpass = crypt($options['passwrd'], base64_encode($options['passwrd']));
            $loginpass = $options['login'] . ':' . $encpass;
            file_put_contents('.htpasswd', $loginpass);
            $htaccessdata .= PHP_EOL . 'AuthName "Введите логин-пароль"' . PHP_EOL . 'AuthType Basic' . PHP_EOL . 'AuthUserFile ' . $_SERVER['DOCUMENT_ROOT'] . '/.htpasswd' . PHP_EOL . 'require valid-user' . PHP_EOL;
        }
        file_put_contents('.htaccess', $htaccessdata);
        file_put_contents('config.ini', $setupdata);
        $dbh->close();
    }

}
