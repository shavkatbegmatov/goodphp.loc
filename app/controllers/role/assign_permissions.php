<?php
if (!checkAccess('role', 'assign_permissions')) {
    redirect('/');
}

// Получаем ID роли из переданных данных
$roleId = $data['id'];

if (!$roleId) {
    redirect('/roles');
}

// Получаем объект роли и списки модулей и разрешений
$role = R::findOne('role', 'id = ?', [$roleId]);
$allModules = R::findAll('module', 'ORDER BY id ASC');
$allPermissions = R::findAll('permission', 'ORDER BY id ASC');

// Получаем текущие назначения разрешений для данной роли
$rolePermissionBeans = R::findAll('rolepermission', ' role_id = ? ', [$roleId]);
$rolePermissions = [];
foreach ($rolePermissionBeans as $rp) {
    $rolePermissions[] = [$rp['module_id'], $rp['permission_id']];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из формы: массив permissions, где ключ – module_id, значение – массив permission_id
    $permissionsData = isset($_POST['permissions']) && is_array($_POST['permissions'])
        ? $_POST['permissions']
        : [];

    // Удаляем все существующие записи для этой роли в role_permission
    $existing = R::findAll('rolepermission', ' role_id = ? ', [$roleId]);
    R::trashAll($existing);

    // Добавляем новые записи
    foreach ($permissionsData as $moduleId => $permissionIds) {
        if (!is_array($permissionIds)) {
            continue;
        }
        $moduleId = intval($moduleId);
        foreach ($permissionIds as $permissionId) {
            $permissionId = intval($permissionId);
            $rp = R::dispense('rolepermission');
            $rp['role_id'] = $roleId;
            $rp['module_id'] = $moduleId;
            $rp['permission_id'] = $permissionId;
            R::store($rp);
        }
    }

    $_SESSION['message'] = ['type' => 'success', 'text' => 'Разрешения успешно обновлены'];
    redirect("/roles");
}
