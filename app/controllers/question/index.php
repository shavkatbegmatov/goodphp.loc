<?php

if (!checkAccess('module', 'read')) {
    redirect('/');
}

$title = 'Список вопросов';

$questions = R::findAll('question', 'ORDER BY id DESC');