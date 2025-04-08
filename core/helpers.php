<?php

function e($value) {
    echo htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function redirect($url) {
    header('Location: ' . $url);
    exit();
}

function config($key) {
    $envPath = BASE_PATH . '/.env';
    if (!file_exists($envPath)) {
        return null;
    }

    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (str_starts_with(trim($line), '#')) {
            continue;
        }

        $parts = explode('=', $line, 2);
        if (count($parts) != 2) {
            continue;
        }

        $envKey = trim($parts[0]);
        $envValue = trim($parts[1]);

        $envValue = trim($envValue, "\"'");

        if ($envKey === $key) {
            return $envValue;
        }
    }

    return null;
}

function currentUser() {
    static $cachedUser = null;

    if ($cachedUser !== null) {
        return $cachedUser;
    }

    if (!isset($_SESSION['user'])) {
        return false;
    }

    $timestamp = $_SESSION['user']['last_activity'];
    $currentTimestamp = time();
    $secondsDifference = abs($currentTimestamp - $timestamp);

    if ($secondsDifference < 1800) {
        $_SESSION['user']['last_activity'] = $currentTimestamp;
        $cachedUser = R::findOne('user', 'id = ?', [$_SESSION['user']['id']]);
        return $cachedUser;
    } else {
        unset($_SESSION['user']);
        return false;
    }
}

function checkAccess($moduleName, $permissionName) {
    $user = currentUser();
    if (!$user) {
        return false;
    }

    $module = R::findOne('module', 'name = ?', [$moduleName]);
    if (!$module) {
        return false;
    }

    $permission = R::findOne('permission', 'name = ?', [$permissionName]);
    if (!$permission) {
        return false;
    }

    $userRoles = R::findAll('userrole', 'user_id = ?', [$user->id]);
    if (!$userRoles) {
        return false;
    }

    $roleIds = [];
    foreach ($userRoles as $ur) {
        $roleIds[] = $ur->role_id;
    }
    if (empty($roleIds)) {
        return false;
    }

    $placeholders = implode(',', array_fill(0, count($roleIds), '?'));
    $params = array_merge($roleIds, [$module->id, $permission->id]);

    $sql = "role_id IN ($placeholders) AND module_id = ? AND permission_id = ?";
    $rolePerm = R::findOne('rolepermission', $sql, $params);

    return $rolePerm ? true : false;
}

function getUserRoles($userId) {
    $roles = [];
    // Находим все записи в таблице user_role для данного пользователя
    $userRoles = R::findAll('userrole', ' user_id = ? ', [$userId]);
    foreach ($userRoles as $userRole) {
        // Получаем роль по role_id, используя синтаксис массива
        $role = R::findOne('role', ' id = ? ', [$userRole['role_id']]);
        if ($role) {
            $roles[] = $role['name'];
        }
    }
    return $roles;
}
