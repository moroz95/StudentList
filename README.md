# StudentList
Список студентов с возможностью регистрации и изменения регистрационных данных.
## Настройка 
* Загрузите дамп базы данных(**app/students.sql**) и импортируйте его в свою бд.
* Создайте файл Database.php в каталоге app, снабдив его следующей информацией:

`<?php`<br>
`$db_host = "localhost"; // или имя хоста, если БД не на локальном сервере`<br>
`$db_name = "StudentList"; // имя вашей БД`<br>
`$db_username = "root"; // ваш логин`<br>
`$db_password = "root"; // ваш пароль`<br>

* Настройте корневой папкой вашего сервера каталог public.
Если вы используете веб-сервер Апач, то корневая папка сайта указывается в конфиге внутри блока `VirtualHost` в директиве `DocumentRoot`:

```config
<VirtualHost *:80>
# Имя сервера которое обслуживает этот VirtualHost
ServerName example.com
# Корневая папка сервера
DocumentRoot /var/www/example.com/public
# ....
```
Под windows путь будет еще содержать букву диска, например `d:/www/example.com/public`. Не забудьте перезапустить Апач после правки конфига! Немного о настройке виртуальных хостов под линукс: https://www.digitalocean.com/community/tutorials/apache-ubuntu-14-04-lts-ru