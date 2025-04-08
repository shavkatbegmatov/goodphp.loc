<?php

if (!checkAccess('user', 'delete')) {
    redirect('/');
}

$id = $data['id'];

$user = R::load('user', $id);
if ($user) {
    if ($user['role'] !== 'admin') {
        R::trash($user);
    }
}

redirect('/user');