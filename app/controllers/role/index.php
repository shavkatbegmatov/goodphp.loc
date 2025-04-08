<?php

if (!checkAccess('role', 'read')) {
    redirect('/');
}

$title = 'Список ролей';

$roles = R::findAll('role', 'ORDER BY id DESC');