<?php

// Проверка прав: убедимся, что у пользователя есть право изменять варианты ответа
if (!checkAccess('question', 'create')) {
    redirect('/');
}

// GET-запрос: получение данных для представления
$question_id = $data['id'];
if (!$question_id) {
    redirect('/questions');
}

$question = R::findOne('question', 'id = ?', [$question_id]);
if (!$question) {
    redirect('/questions');
}

$answeroptions = R::findAll('answeroption', 'question_id = ? ORDER BY display_order DESC', [$question_id]);

// Обработка POST-запроса
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем ID вопроса из скрытого поля формы
    $question_id = $data['id'];
    if (!$question_id) {
        $_SESSION['message'] = ['type' => 'danger', 'text' => 'Неверный ID вопроса'];
        redirect('/questions');
        exit;
    }

    // Проверяем, что вопрос существует
    $question = R::findOne('question', 'id = ?', [$question_id]);
    if (!$question) {
        $_SESSION['message'] = ['type' => 'danger', 'text' => 'Вопрос не найден'];
        redirect('/questions');
        exit;
    }

    // Получаем массив вариантов, отправленный с фронтенда
    // Ожидается структура:
    // $_POST['answeroptions'] = [
    //    0 => ['id' => 12, 'option_text' => 'Новый текст', 'display_order' => 1],
    //    1 => ['option_text' => 'Еще вариант', 'display_order' => 2],
    //    ...
    // ];
    $newOptions = isset($_POST['answeroptions']) && is_array($_POST['answeroptions'])
        ? $_POST['answeroptions'] : [];

    // Получаем существующие варианты для этого вопроса
    $existingOptions = R::findAll('answeroption', 'question_id = ? ', [$question_id]);
    $existingById = [];
    foreach ($existingOptions as $opt) {
        $existingById[$opt['id']] = $opt;
    }

    // Массив полученных ID вариантов
    $receivedIds = [];

    // Обработка входящего массива: обновление существующих или добавление новых вариантов
    foreach ($newOptions as $optData) {
        if (!empty($optData['id']) && isset($existingById[$optData['id']])) {
            // Обновляем вариант
            $opt = $existingById[$optData['id']];
            $opt['option_text'] = trim($optData['option_text']);
            $opt['display_order'] = intval($optData['display_order']);
            $opt['active'] = 1; // Обязательно возвращаем вариант в активное состояние
            R::store($opt);
            $receivedIds[] = $optData['id'];
        } else {
            // Создаем новый вариант
            $opt = R::dispense('answeroption');
            $opt['question_id'] = $question_id;
            $opt['option_text'] = trim($optData['option_text']);
            $opt['display_order'] = intval($optData['display_order']);
            $opt['active'] = 1;
            $newId = R::store($opt);
            $receivedIds[] = $newId;
        }
    }

    // Обрабатываем варианты, которые есть в базе, но отсутствуют в отправленных данных
    foreach ($existingById as $id => $opt) {
        if (!in_array($id, $receivedIds)) {
            // Если вариант используется (например, в ответах пользователей), помечаем его неактивным
            $usageCount = R::count('responseanswer', ' answer_option_id = ? ', [$id]);
            if ($usageCount > 0) {
                $opt['active'] = 0;
                R::store($opt);
            } else {
                // Если не используется – удаляем
                R::trash($opt);
            }
        }
    }

    $_SESSION['message'] = ['type' => 'success', 'text' => 'Варианты ответа обновлены'];
    redirect("/question/answer_options/{$question_id}");
    exit;
}