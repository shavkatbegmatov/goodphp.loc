<?php

if (!checkAccess('questionnaire', 'delete')) {
    redirect('/');
}

$id = $data['id'];

$questionnaire = R::load('questionnaire', $id);
if ($questionnaire) {
    R::trash($questionnaire);
}

redirect('/questionnaires');