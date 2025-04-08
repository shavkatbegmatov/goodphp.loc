<?php

if (!checkAccess('permission', 'delete')) {
    redirect('/');
}

$id = $data['id'];

$permission = R::load('permission', $id);
if ($permission) {
    R::trash($permission);
}

redirect('/permissions');