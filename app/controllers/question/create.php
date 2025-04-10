<?php

if (!checkAccess('question', 'create')) {
    redirect('/');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем и обрабатываем входные данные
    $text = isset($_POST['text']) ? trim($_POST['text']) : '';
    $question_type = isset($_POST['question_type']) ? $_POST['question_type'] : '';

    $errors = [];

    // Валидация текста вопроса
    if (empty($text)) {
        $errors[] = 'Пожалуйста, введите текст вопроса.';
    }

    // Валидация типа вопроса (допустимые значения: multiple_choice, text)
    if (!in_array($question_type, ['multiple_choice', 'text'])) {
        $errors[] = 'Неверный тип вопроса.';
    }

    // Если есть ошибки, сохраняем их в сессии и редиректим обратно на форму
    if (!empty($errors)) {
        $_SESSION['message'] = ['type' => 'danger', 'text' => implode(' ', $errors)];
        redirect('/question/create');
    }

    // Создаём bean для вопроса и сохраняем в БД
    $question = R::dispense('question');
    $question['text'] = $text;
    $question['question_type'] = $question_type;
    R::store($question);

    if ($question_type === 'multiple_choice') {
        redirect('/question/answer_options/' . $question['id']);
    }

    redirect('/questions');
}