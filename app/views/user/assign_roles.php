<form method="POST" action="/user/assign_roles/<?php e($user['id']); ?>">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Настройка ролей пользователя "<?php e($user['name']); ?>"</h3>
        </div>
        <div class="card-body">
            <?php foreach ($allRoles as $role): ?>
                <?php
                $isChecked = in_array($role['id'], $userRoles) ? 'checked' : '';
                ?>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="roles[]" value="<?php e($role['id']); ?>" id="role-<?php e($role['id']); ?>" <?php e($isChecked); ?>>
                    <label class="form-check-label" for="role-<?php e($role['id']); ?>">
                        <?php e($role['name']); ?>
                    </label>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </div>
</form>
