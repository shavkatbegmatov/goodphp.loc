<?php

if (!checkAccess('questionnaire', 'create')) {
    redirect('/');
}

// Если метод не POST – подготовка данных для формы создания анкеты
// Получаем список всех вопросов, чтобы затем отобразить их в select
$allQuestions = R::findAll('question', ' ORDER BY id ASC ');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные формы
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $description = isset($_POST['description']) ? trim($_POST['description']) : '';
    // Массив выбранных вопросов (каждый элемент – id вопроса)
    $selectedQuestions = isset($_POST['questions']) && is_array($_POST['questions'])
        ? $_POST['questions']
        : [];

    $errors = [];
    if (empty($name)) {
        $errors[] = 'Пожалуйста, введите название анкеты.';
    }

    if (!empty($errors)) {
        $_SESSION['message'] = ['type' => 'danger', 'text' => implode(' ', $errors)];
        redirect('/questionnaire/create');
    }

    // Сохраняем анкету (questionnaire)
    $questionnaire = R::dispense('questionnaire');
    $questionnaire['name'] = $name;
    $questionnaire['description'] = $description;
    $questionnaire['created_by'] = currentUser()['id']; // предполагается, что id пользователя хранится в $_SESSION['user']['id']
    $questionnaireId = R::store($questionnaire);

    // Сохраняем связи анкета - вопрос (questionnairequestion)
    // Порядок отображения будем задавать по порядку в массиве (от 1 и далее)
    $order = 1;
    foreach ($selectedQuestions as $questionId) {
        $link = R::dispense('questionnairequestion');
        $link['questionnaire_id'] = $questionnaireId;
        $link['question_id'] = intval($questionId);
        $link['display_order'] = $order;
        R::store($link);
        $order++;
    }

    $_SESSION['message'] = ['type' => 'success', 'text' => 'Анкета успешно создана'];
    redirect('/questionnaires'); // перенаправляем на список анкет (или другую нужную страницу)
}