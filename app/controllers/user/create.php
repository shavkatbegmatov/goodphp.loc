<?php

if (!checkAccess('user', 'create')) {
    redirect('/');
}

$title = 'Создать пользователя';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['name'] != '' && $_POST['password'] != '') {
        $name = $_POST['name'];
        $password = md5($_POST['password']);

        if (!R::findOne('user', 'name = ?', [$name])) {
            $user = R::dispense('user');
            $user['name'] = $name;
            $user['password'] = $password;
            $id = R::store($user);

            redirect('/user/assign_roles/' . $id);
        } else {
            $_SESSION['message'] = [
                'type' => 'danger',
                'text' => 'Эта имя пользователя уже занята.'
            ];
        }
    }
}