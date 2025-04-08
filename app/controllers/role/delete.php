<?php

if (!checkAccess('role', 'delete')) {
    redirect('/');
}

$id = $data['id'];

$role = R::load('role', $id);
if ($role) {
    R::trash($role);
}

redirect('/roles');