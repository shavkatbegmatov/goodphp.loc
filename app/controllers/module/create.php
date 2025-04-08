<?php

if (!checkAccess('module', 'create')) {
    redirect('/');
}

$title = 'Создать модуль';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['name'] != '') {
        $name = $_POST['name'];

        if (!R::findOne('module', 'name = ?', [$name])) {
            $module = R::dispense('module');
            $module['name'] = $name;
            $id = R::store($module);

            redirect('/modules');
        } else {
            $_SESSION['message'] = [
                'type' => 'danger',
                'text' => 'Эта имя для модуля уже занята.'
            ];
        }

    }
}