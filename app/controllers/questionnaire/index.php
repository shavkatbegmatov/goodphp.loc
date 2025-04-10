<?php

if (!checkAccess('module', 'read')) {
    redirect('/');
}

$title = 'Список анкет';

$questionnaires = R::findAll('questionnaire', 'ORDER BY id DESC');