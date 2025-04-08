<?php

if (!checkAccess('permission', 'create')) {
    redirect('/');
}

$title = 'Создать разрешение';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['name'] != '') {
        $name = $_POST['name'];

        if (!R::findOne('permission', 'name = ?', [$name])) {
            $permission = R::dispense('permission');
            $permission['name'] = $name;
            $id = R::store($permission);

            redirect('/permissions');
        } else {
            $_SESSION['message'] = [
                'type' => 'danger',
                'text' => 'Эта имя для разрешения уже занята.'
            ];
        }

    }
}