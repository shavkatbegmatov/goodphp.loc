<form method="POST" action="/role/assign_permissions/<?php e($role['id']); ?>">
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h3 class="card-title mb-0">Настройка разрешений для роли "<?php e($role['name']); ?>"</h3>
            <div class="ms-auto d-flex gap-2">
                <input type="text" id="module-search" class="form-control" placeholder="Поиск по модулям...">
                <input type="text" id="permission-search" class="form-control" placeholder="Поиск по разрешениям...">
            </div>
        </div>
        <div class="card-body">
            <!-- Обёртка для горизонтальной прокрутки -->
            <div class="table-responsive">
                <table class="table table-bordered" id="permissions-matrix">
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
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Сохранить разрешения</button>
        </div>
    </div>
</form>

<script>
    // Фильтрация строк (модулей)
    document.getElementById('module-search').addEventListener('input', function() {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#permissions-matrix tbody tr');
        rows.forEach(function(row) {
            // Название модуля находится в первой ячейке строки
            const moduleName = row.cells[0].textContent.toLowerCase();
            row.style.display = moduleName.includes(filter) ? "" : "none";
        });
    });

    // Фильтрация столбцов (разрешений)
    document.getElementById('permission-search').addEventListener('input', function() {
        const filter = this.value.toLowerCase();
        const table = document.getElementById('permissions-matrix');
        const headerCells = table.tHead.rows[0].cells;
        // Обходим столбцы, начиная с индекса 1 (индекс 0 – модуль)
        for (let i = 1; i < headerCells.length; i++) {
            const cellText = headerCells[i].textContent.toLowerCase();
            // Если текст столбца соответствует фильтру – показываем, иначе скрываем
            const displayStyle = cellText.includes(filter) ? "" : "none";
            headerCells[i].style.display = displayStyle;
            // Применяем то же правило к каждой ячейке этого столбца в tbody
            const rows = table.tBodies[0].rows;
            for (let j = 0; j < rows.length; j++) {
                rows[j].cells[i].style.display = displayStyle;
            }
        }
    });
</script>
