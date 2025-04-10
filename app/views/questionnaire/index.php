<div class="card">
    <div class="card-header">
        <h3 class="card-title">Таблица анкет</h3>
    </div>
    <div class="card-body border-bottom py-3">
        <div class="d-flex">
            <div class="text-secondary">
                Поиск:
                <div class="ms-2 d-inline-block">
                    <input type="text" id="search-input" class="form-control" aria-label="Search questionnaires" placeholder="Введите для поиска...">
                </div>
            </div>
            <div class="btn-list ms-auto">
                <?php if (checkAccess('questionnaire', 'create')): ?>
                    <a href="/questionnaire/create" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                        Создать анкету
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
                <th>Название анкеты</th>
                <th>Описание</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody id="questionnaire-table">
            <?php foreach ($questionnaires as $questionnaire): ?>
                <tr>
                    <td class="text-muted filterable"><?php e($questionnaire['id']); ?></td>
                    <td class="filterable" style="max-width: 300px; word-wrap: break-word;">
                        <div class="d-flex py-1 align-items-center">
                            <div class="flex-fill">
                                <div class="font-weight-medium"><?php e($questionnaire['name']); ?></div>
                            </div>
                        </div>
                    </td>
                    <td class="filterable" style="max-width: 300px; word-wrap: break-word;">
                        <?php e($questionnaire['description']); ?>
                    </td>
                    <td class="text-end">
                        <div class="btn-list d-flex flex-nowrap">
                            <?php if (checkAccess('questionnaire', 'update')): ?>
                                <a class="btn btn-icon btn-outline-orange" href="/questionnaire/edit/<?php e($questionnaire['id']); ?>" title="Редактировать">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-pencil"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /></svg>
                                </a>
                            <?php endif; ?>
                            <?php if (checkAccess('questionnaire', 'delete')): ?>
                                <a class="btn btn-icon btn-outline-danger" href="/questionnaire/delete/<?php e($questionnaire['id']); ?>"
                                   onclick="return confirm('Вы точно хотите удалить анкету «<?php e($questionnaire['name']); ?>»?');"
                                   title="Удалить">
                                    <!-- SVG-иконка корзины -->
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
        let rows = document.querySelectorAll('#questionnaire-table tr');

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
