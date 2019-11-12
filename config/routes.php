<?php

return array(
    //Пользователь
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',
    //Админпанель
    'admin' => 'comment/admin',
    //Коментарий
    'comment/([0-9]+)' => 'comment/update/$1',
    'comment/([a-z]+)' => 'comment/index/$1',
    'comment/index' => 'comment/index',
    'comment' => 'comment/create',
    //Главная
    '' => 'site/index', // actionIndex в SiteController
);
