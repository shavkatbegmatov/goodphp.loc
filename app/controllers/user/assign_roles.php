<?php

if (!checkAccess('user', 'assign_roles')) {
    redirect('/');
}

// Получаем ID пользователя из переданных данных
$userId = $data['id'];

if (!$userId) {
    redirect('/users');
}

// Получаем объект пользователя и список всех ролей
$user = R::findOne('user', 'id = ?', [$userId]);
$allRoles = R::findAll('role', 'ORDER BY id ASC');

// Получаем текущие назначения ролей пользователя
$userRoleBeans = R::findAll('userrole', ' user_id = ? ', [$userId]);
$userRoles = [];
foreach ($userRoleBeans as $userRoleBean) {
    $userRoles[] = $userRoleBean['role_id'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем массив выбранных ролей (IDs)
    $roles = isset($_POST['roles']) && is_array($_POST['roles']) ? array_map('intval', $_POST['roles']) : [];

    // Удаляем все существующие назначения для этого пользователя
    $existing = R::findAll('userrole', 'user_id = ?', [$userId]);
    R::trashAll($existing);

    // Добавляем новые назначения
    foreach ($roles as $roleId) {
        $userRole = R::dispense('userrole');
        $userRole['user_id'] = $userId;
        $userRole['role_id'] = $roleId;
        R::store($userRole);
    }

    $_SESSION['message'] = ['type' => 'success', 'text' => 'Роли успешно обновлены'];
    redirect("/users");
}