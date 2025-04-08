<?php

if (currentUser()) {
    redirect('/');
}

$title = 'Авторизация';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $password = $_POST['password'];

    $user = R::findOne('user', 'name = ?', [$name]);

    if ($user) {
        if ($user['password'] == md5($password)) {
            $_SESSION['user']['id'] = $user['id'];
            $_SESSION['user']['last_activity'] = time();
    
            redirect('/account');
        }
    }

    $_SESSION['message'] = [
        'type' => 'danger',
        'text' => 'Имя пользователя и/или пароль введены неверно.'
    ];
}