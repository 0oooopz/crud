Добрый день.
Тестовое задание выполнено на базе Linux + Laravel 8 + Docker.
Задание состоит из:
1) Создать базу данных с колонками:
    -id,
    -first_name,
    -last_name,
    -email,
    -created_date,
    -updated_date.
2) Создать таблицу с информацией на главной странице (index),
   где нужно реализовать фильтр и поиск по колонкам:
    -ID,
    -First Name,
    -Last Name,
    -Email,
    -Create Date,
    -Update Date.
   Реализовать поле в таблице с названием "Edit" при нажатии на
   которое на экране будет форма для редактирования.
   Логику для добавления новой записи реализовать по кнопке "Add User".

Необходимые навыки для завершения задания:
    - Использовать принцып ООП.
    - Js / Jquery or Knockout
    - Bootstrap 4
Дополнительно:
    - Создать таблицу используя php cli скрипт.
    - Использовать Ajax - фильтр и сортировку,
      должны работать без перезагрузки страницы.


Я предпочитаю работать с docker, если нужно могу скинуть свою сборку,
чтобы быстро поднять проект)).
Далее расскажу как я подымаю проект.
И так у нас есть работающий docker.
Добавим в файл /etc/hosts следующую строку 127.0.0.1 crud-laravel-8.loc
это url по которому будет откликаться наше приложение.

Заходим в docker/nginx/vhost.conf добавляем в него,
server {
    listen 80;
    index index.php index.html;
    root /var/www/crud-laravel-8/public; // crud-laravel-8/public название папки в которой лежит проект и указываем путь к index.php
    client_max_body_size 32m;
    server_name crud-laravel-8.loc;   // здесь указываем url который указали в /etc/hosts/


    set $cors_origin $http_origin;
    set $cors_cred   true;
    set $cors_header $http_access_control_request_headers;
    set $cors_method $http_access_control_request_method;
    set $cors_expose_header 'Authorization';
    set $cors_request_header 'Authorization';

    #add_header 'Access-Control-Allow-Origin' $cors_origin always;
    #add_header 'Access-Control-Allow-Credentials' $cors_cred always;
    #add_header 'Access-Control-Allow-Methods' $cors_method;
    #add_header 'Access-Control-Allow-Headers' $cors_header always;
    #add_header 'Access-Control-Expose-Headers' $cors_expose_header;
    #add_header 'Access-Control-Request-Headers' $cors_request_header;

    location / {
        add_header 'Access-Control-Allow-Origin' $cors_origin always;
        add_header 'Access-Control-Allow-Credentials' $cors_cred always;
        add_header 'Access-Control-Allow-Methods' $cors_method;
        add_header 'Access-Control-Allow-Headers' $cors_header always;
        add_header 'Access-Control-Expose-Headers' $cors_expose_header;
        add_header 'Access-Control-Request-Headers' $cors_request_header;

        if ($request_method = 'OPTIONS') {
            add_header 'Access-Control-Allow-Origin' $cors_origin always;
            add_header 'Access-Control-Allow-Credentials' $cors_cred always;
            add_header 'Access-Control-Allow-Methods' $cors_method;
            add_header 'Access-Control-Allow-Headers' $cors_header always;
            add_header 'Access-Control-Expose-Headers' $cors_expose_header;
            add_header 'Access-Control-Request-Headers' $cors_request_header;

            add_header 'Access-Control-Max-Age' 1728000;
            add_header 'Content-Type' 'text/plain charset=UTF-8';
            add_header 'Content-Length' 0;
            return 204;
        }

        try_files $uri /index.php?$args;
    }

    location ~ \.php$ {
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass app:9000;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param PATH_INFO $fastcgi_path_info;
    }
}

Далее в терминале ззаходим в папку www/ в которой лежит наш докер.
Сюда мы будем клонить проект с github.
git@github.com:0oooopz/crud-laravel-8.git

Отлично проект лежит в директории www/ рядом с директорией docker
Самое время поднять docker, заходим в терминал дектория docker, пишем команду

sudo docker-composse up -d --build   // соберет контейнеры и подымет docker с обновленными файлами

Проверим что все контейнеры поднялись

sudo docker-compose ps   // в графе state напротив всех контейнеров up

Заходим в контейнер php нужно установить зависимости

sudo docker-compose exec app bash

Далее переходим в директорию с нашим проектом crud-laravel-8 и устанавливоем зависимисти

composer install

После успешной становки у нас на локальной машине появится папка vendor

Теперь сконфигурируем файл .env. Копируем файл .env.example в ту же директорию и открываем .env

Назовем наш проект

APP_NAME=Laravel  => меняем на APP_NAME=Crud-laravel-8

Сгенерируем APP_KEY=

Открываем терминал контейнера php с нашим проектом и пишем команду

php artisan key:generate

В поле APP_KEY= должен сгенерироваться уникальный ключ

Переходим к настройке соединения с базой данных
(Эти параметры могут отличаться в зависимости от настроек)

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=crud-laravel-8   // Так же нужно создать базу данных с таким именем
DB_USERNAME=root     // Указываем логин и пароль для соединения
DB_PASSWORD=123456

Сохраняем, закрываем файл .env

На следующем пункте я особо не заморачиваюсь, а рекурсивно устанавливаю права доступа в проекте
Переходим в терминал, нам нужна наша локальная машина, находим наш проект
И при помощи команды

sudo chmod 777 -R crud-laravel-8

Даем нужные права доступа нашемему проекту
Проверяем url http://crud-laravel-8.loc/ если все сделано верно то видим <h1>Welcome<h1>

Теперь нужно создать базу данных с именем которе мы указывали в DB_DATABASE=
И создать миграции

Создаем базу данных в моем случае crud-laravel-8
И переходим в docker контейнер php в наш проект, пишет команду

php artisan migrate

Видим в терминале как создаются наши таблицы в базе данных и
Migration table created successfully.

Отлично, мы подняли проект.
Теперь можете самостоятельно добавить пользователей либо воспользоватся командой

php artisan db:seed      // все в том же docker контейнере php

Заполнили базу данных рандомными пользователями.

Благодарю за внимание, хорошего дня!
