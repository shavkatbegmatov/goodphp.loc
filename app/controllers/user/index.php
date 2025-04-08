<?php

if (!checkAccess('user', 'read')) {
    redirect('/');
}

$title = 'Список пользователей';

$users = R::findAll('user', 'ORDER BY id DESC');