<?php

// Проверка доступа на редактирование анкеты
if (!checkAccess('questionnaire', 'update')) {
    redirect('/');
}

// Получаем ID анкеты из URL или переданных данных
$questionnaireId = isset($data['id']) ? intval($data['id']) : 0;

// Для GET-запроса загружаем данные анкеты, связанные вопросы и все существующие вопросы для select
$questionnaire = R::load('questionnaire', $questionnaireId);
$questionnaireQuestions = R::findAll('questionnairequestion', ' questionnaire_id = ? ORDER BY display_order ASC ', [$questionnaireId]);
$allQuestions = R::findAll('question', ' ORDER BY id ASC ');

if (!$questionnaireId) {
    $_SESSION['message'] = ['type' => 'danger', 'text' => 'Неверный ID анкеты'];
    redirect('/questionnaires');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные формы
    $description = isset($_POST['description']) ? trim($_POST['description']) : '';
    $questionsData = isset($_POST['questions']) && is_array($_POST['questions']) ? $_POST['questions'] : [];

    // Валидация – проверим, что хотя бы один вопрос добавлен
    if (empty($questionsData)) {
        $_SESSION['message'] = ['type' => 'danger', 'text' => 'Добавьте хотя бы один вопрос в анкету.'];
        redirect("/questionnaire/edit/{$questionnaireId}");
        exit;
    }

    // Обновляем описание анкеты
    $questionnaire = R::load('questionnaire', $questionnaireId);
    $questionnaire['description'] = $description;
    R::store($questionnaire);

    // Удаляем все существующие связи (вопросы анкеты)
    $existingLinks = R::findAll('questionnairequestion', ' questionnaire_id = ? ', [$questionnaireId]);
    R::trashAll($existingLinks);

    // Создаем новые связи на основании отправленных данных
    foreach ($questionsData as $row) {
        if (!empty($row['question_id'])) {
            $link = R::dispense('questionnairequestion');
            $link['questionnaire_id'] = $questionnaireId;
            $link['question_id'] = intval($row['question_id']);
            $link['display_order'] = intval($row['display_order']);
            R::store($link);
        }
    }

    $_SESSION['message'] = ['type' => 'success', 'text' => 'Анкета успешно обновлена'];
    redirect("/questionnaires");
    exit;
}