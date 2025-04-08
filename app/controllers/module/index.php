<?php

if (!checkAccess('module', 'read')) {
    redirect('/');
}

$title = 'Список модулей';

$modules = R::findAll('module', 'ORDER BY id DESC');