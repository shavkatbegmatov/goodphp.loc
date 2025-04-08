<form method="POST" action="/role/assign_permissions/<?php e($role['id']); ?>">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Настройка разрешений для роли "<?php e($role['name']); ?>"</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Модуль</th>
                    <?php foreach ($allPermissions as $permission): ?>
                        <th class="text-center"><?php e($permission['name']); ?></th>
                    <?php endforeach; ?>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($allModules as $module): ?>
                    <tr>
                        <td><?php e($module['name']); ?></td>
                        <?php foreach ($allPermissions as $permission):
                            $isChecked = in_array([$module['id'], $permission['id']], $rolePermissions) ? 'checked' : '';
                            ?>
                            <td class="text-center">
                                <input type="checkbox"
                                       class="form-check-input permission-checkbox"
                                       name="permissions[<?php e($module['id']); ?>][]"
                                       value="<?php e($permission['id']); ?>"
                                    <?php e($isChecked); ?>>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </div>
</form>
