# разворачиваем taskmanager

### 1) указать данные для подключения к базе
  
В файле ```app/core/host.php```

```php
define("DB_HOST", "host");
define("DB_DATABASE", "database");
define("DB_USER", "username");
define("DB_PASSWORD", "password");
```

где:
* ***host*** - сервер для внешних подключений
* ***database*** - имя созданной БД
* ***username*** - юзер для подключения к БД
* ***password*** - пароль для подключения к базе


### 2) Выполнить следующие SQL запросы на создание необходимых таблиц.

единственный параметр, который нужно задать вручную - ***database***
Остальные параметры не трогаем.

* CREATE TABLE `database`.`taskblocks` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `username` VARCHAR(200) NOT NULL , `blockname` VARCHAR(200) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

* CREATE TABLE `database`.`tasks` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `username` VARCHAR(200) NOT NULL , `block_id` VARCHAR(200) NOT NULL , `taskname` VARCHAR(200) NOT NULL , `status` INT(2) NOT NULL , `taskhash` VARCHAR(200) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

* CREATE TABLE `database`. ( `users` INT(11) NOT NULL AUTO_INCREMENT , `username` VARCHAR(30) NOT NULL , `email` VARCHAR(30) NOT NULL , `password` VARCHAR(200) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;


В случае, если проект разворачивается на localhost, а база размещена на внешнем сервере, то необходимо в permissions дать доступ к базе с внешних IP-адресов.

### 3) Открываем приложение, пользуемся.

***

todo

* восстановление пароля
* удержание сессии (keep me signed in)
* валидация поля с паролем

