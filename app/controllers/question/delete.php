<?php

if (!checkAccess('module', 'delete')) {
    redirect('/');
}

$id = $data['id'];

$module = R::load('module', $id);
if ($module) {
    R::trash($module);
}

redirect('/modules');