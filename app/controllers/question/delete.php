<?php

if (!checkAccess('question', 'delete')) {
    redirect('/');
}

$id = $data['id'];

$question = R::load('question', $id);
if ($question) {
    R::trash($question);
}

redirect('/questions');