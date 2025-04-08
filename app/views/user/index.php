<div class="card">
    <div class="card-header">
        <h3 class="card-title">Таблица пользователей</h3>
    </div>
    <div class="card-body border-bottom py-3">
        <div class="d-flex">
            <div class="text-secondary">
                Поиск:
                <div class="ms-2 d-inline-block">
                    <input type="text" id="search-input" class="form-control" aria-label="Search branches" placeholder="Введите для поиска...">
                </div>
            </div>
            <div class="btn-list ms-auto">
                <?php if (checkAccess('user', 'create')): ?>
                    <a href="/user/create" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                        Создать пользователя
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table card-table table-vcenter text-nowrap datatable">
            <thead>
                <tr>
                    <th class="w-1">ID</th>
                    <th>Имя пользователя</th>
                    <th>Роль</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody id="user-table">
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td class="text-muted filterable""><?php e($user['id']); ?></td>
                        <td style="max-width: 300px; text-wrap: wrap;">
                            <div class="d-flex py-1 align-items-center">
                                <span class="avatar avatar-sm me-3" style="background: url('https://api.dicebear.com/9.x/<?php e(config('PROFILE_PICTURE_STYLE')); ?>/svg?seed=<?php e($user['name']); ?>>')"></span>
                                <div class="flex-fill">
                                    <div class="font-weight-medium"><?php e($user['name']); ?></div>
                                </div>
                            </div>
                        </td>
                        <td class="filterable" style="max-width: 300px; text-wrap: wrap;"><?php e(implode(', ', getUserRoles($user['id']))); ?></td>
                        
                        <td class="text-end">
                            <div class="btn-list d-flex flex-nowrap">
                                <?php if (!in_array('admin', getUserRoles($user['id']))): ?>
                                    <?php if (checkAccess('user', 'assign_roles')): ?>
                                    <a class="btn btn-icon btn-outline-orange" href="/user/assign_roles/<?php e($user['id']); ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16.555 3.843l3.602 3.602a2.877 2.877 0 0 1 0 4.069l-2.643 2.643a2.877 2.877 0 0 1 -4.069 0l-.301 -.301l-6.558 6.558a2 2 0 0 1 -1.239 .578l-.175 .008h-1.172a1 1 0 0 1 -.993 -.883l-.007 -.117v-1.172a2 2 0 0 1 .467 -1.284l.119 -.13l.414 -.414h2v-2h2v-2l2.144 -2.144l-.301 -.301a2.877 2.877 0 0 1 0 -4.069l2.643 -2.643a2.877 2.877 0 0 1 4.069 0z" /><path d="M15 9h.01" />
                                        </svg>
                                    </a>
                                    <?php endif; ?>
                                    <?php if (checkAccess('user', 'delete')): ?>
                                        <a class="btn btn-icon btn-outline-danger" href="/user/delete/<?php e($user['id']); ?>" onclick="return confirm('Вы точно хотите удалить пользователя «<?php e($user['name']); ?>»?');">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M4 7l16 0" />
                                                <path d="M10 11l0 6" />
                                                <path d="M14 11l0 6" />
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                            </svg>
                                        </a>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById('search-input').addEventListener('input', function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('#user-table tr');
        
        rows.forEach(function(row) {
            let text = row.textContent.toLowerCase();
            if (text.includes(filter)) {
                row.style.display = '';
                let cells = row.querySelectorAll('td.filterable');
                cells.forEach(function(cell) {
                    cell.innerHTML = cell.textContent.replace(new RegExp(filter, "gi"), match => `<b style="font-weight: 700;">${match}</b>`);
                });
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
