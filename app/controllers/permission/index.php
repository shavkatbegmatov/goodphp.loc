<?php

if (!checkAccess('permission', 'read')) {
    redirect('/');
}

$title = 'Список разрешений';

$permissions = R::findAll('permission', 'ORDER BY id DESC');