<?php

if (!checkAccess('role', 'create')) {
    redirect('/');
}

$title = 'Создать роль';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['name'] != '') {
        $name = $_POST['name'];

        if (!R::findOne('role', 'name = ?', [$name])) {
            $role = R::dispense('role');
            $role['name'] = $name;
            $id = R::store($role);

            redirect('/roles');
        } else {
            $_SESSION['message'] = [
                'type' => 'danger',
                'text' => 'Эта имя для роли уже занята.'
            ];
        }

    }
}