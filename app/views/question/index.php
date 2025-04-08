<div class="card">
    <div class="card-header">
        <h3 class="card-title">Таблица вопросов</h3>
    </div>
    <div class="card-body border-bottom py-3">
        <div class="d-flex">
            <div class="text-secondary">
                Поиск:
                <div class="ms-2 d-inline-block">
                    <input type="text" id="search-input" class="form-control" aria-label="Search questions" placeholder="Введите для поиска...">
                </div>
            </div>
            <div class="btn-list ms-auto">
                <?php if (checkAccess('question', 'create')): ?>
                    <a href="/question/create" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                        Создать вопрос
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
                <th>Текст вопроса</th>
                <th>Тип</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody id="question-table">
            <?php foreach ($questions as $question): ?>
                <tr>
                    <td class="text-muted filterable"><?php e($question['id']); ?></td>
                    <td class="filterable" style="max-width: 300px; word-wrap: break-word;">
                        <div class="d-flex py-1 align-items-center">
                            <div class="flex-fill">
                                <div class="font-weight-medium"><?php e($question['text']); ?></div>
                            </div>
                        </div>
                    </td>
                    <td class="filterable" style="max-width: 300px; word-wrap: break-word;">
                        <div class="d-flex py-1 align-items-center">
                            <div class="flex-fill">
                                <div class="font-weight-medium"><?php e($question['question_type']); ?></div>
                            </div>
                        </div>
                    </td>
                    <td class="text-end">
                        <div class="btn-list d-flex flex-nowrap">
                            <?php if (checkAccess('question', 'delete')): ?>
                                <a class="btn btn-icon btn-outline-danger" href="/question/delete/<?php e($question['id']); ?>"
                                   onclick="return confirm('Вы точно хотите удалить вопрос «<?php e($question['text']); ?>»?');">
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
                            <!-- Если нужно добавить другие действия (редактирование и т.п.) – сюда можно вставить дополнительную кнопку -->
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    // Поиск по таблице вопросов: фильтруются строки, если текст в строке соответствует введённой строке в поисковом поле
    document.getElementById('search-input').addEventListener('input', function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('#question-table tr');

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
