<form class="card card-md" method="POST" action="/questionnaire/edit/<?php e($questionnaire['id']); ?>">
    <div class="card-body">
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-<?php e($_SESSION['message']['type']); ?>" role="alert">
                <?php e($_SESSION['message']['text']); unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>

        <div id="error-message" class="alert alert-danger d-none" role="alert"></div>

        <!-- Поле для описания анкеты -->
        <div class="mb-3">
            <label class="form-label">Описание анкеты</label>
            <textarea class="form-control" name="description" id="description" placeholder="Введите описание анкеты" rows="3"><?php e($questionnaire['description']); ?></textarea>
            <p class="form-text text-muted">Необязательно, но можно указать краткое описание.</p>
        </div>

        <!-- Таблица для выбора вопросов -->
        <div class="mb-3">
            <label class="form-label">Вопросы анкеты</label>
            <div class="table-responsive">
                <table class="table table-bordered" id="questionsTable">
                    <thead>
                    <tr>
                        <th class="w-1">#</th>
                        <th>Вопрос</th>
                        <th>Порядок отображения</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $rowIndex = 0; ?>
                    <?php if (!empty($questionnaireQuestions)): ?>
                        <?php foreach ($questionnaireQuestions as $qRow): ?>
                            <tr data-index="<?php e($rowIndex); ?>">
                                <td><?php e($rowIndex + 1); ?></td>
                                <td>
                                    <select class="form-control" name="questions[<?php e($rowIndex); ?>][question_id]">
                                        <option value="">Выберите вопрос</option>
                                        <?php foreach ($allQuestions as $question): ?>
                                            <option value="<?php e($question['id']); ?>" <?php if($question['id'] == $qRow['question_id']) echo 'selected'; ?>>
                                                <?php e($question['text']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="questions[<?php e($rowIndex); ?>][display_order]" value="<?php e($qRow['display_order']); ?>" placeholder="Порядок">
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-icon btn-outline-danger remove-row" title="Удалить">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="18" y1="6" x2="6" y2="18"/>
                                            <line x1="6" y1="6" x2="18" y2="18"/>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                            <?php $rowIndex++; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <button type="button" id="addQuestionBtn" class="btn btn-secondary mt-3">Добавить вопрос</button>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary w-100">Сохранить анкету</button>
    </div>
</form>

<script>
    // Предполагаем, что все вопросы передаются с backend в виде JSON
    const allQuestions = <?php echo json_encode(array_values($allQuestions)); ?>;
    let rowCount = <?php echo $rowIndex; ?>;

    // Функция для создания options для select из массива вопросов
    function createQuestionOptions() {
        let optionsHtml = '<option value="">Выберите вопрос</option>';
        allQuestions.forEach(function(question) {
            optionsHtml += `<option value="${question.id}">${question.text}</option>`;
        });
        return optionsHtml;
    }

    // Обработчик кнопки "Добавить вопрос"
    document.getElementById('addQuestionBtn').addEventListener('click', function() {
        const tbody = document.querySelector('#questionsTable tbody');
        const newRow = document.createElement('tr');
        newRow.setAttribute('data-index', rowCount);
        newRow.innerHTML = `
            <td>${rowCount + 1}</td>
            <td>
                <select class="form-control" name="questions[${rowCount}][question_id]">
                    ${createQuestionOptions()}
                </select>
            </td>
            <td>
                <input type="number" class="form-control" name="questions[${rowCount}][display_order]" value="${rowCount + 1}" placeholder="Порядок">
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-icon btn-outline-danger remove-row" title="Удалить">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
            </td>
        `;
        tbody.appendChild(newRow);
        rowCount++;
    });

    // Делегирование события удаления строки
    document.querySelector('#questionsTable tbody').addEventListener('click', function(event) {
        if(event.target.closest('.remove-row')) {
            const row = event.target.closest('tr');
            row.parentNode.removeChild(row);
        }
    });

    // Валидация формы перед отправкой
    document.querySelector('form').addEventListener('submit', function(event) {
        let valid = true;
        let errors = [];
        const errorDiv = document.getElementById('error-message');

        // Если нужна дополнительная валидация для описания анкеты, можно добавить ее здесь
        // Проверяем, что хотя бы одна строка с вопросом добавлена
        const rows = document.querySelectorAll('#questionsTable tbody tr');
        if (rows.length === 0) {
            valid = false;
            errors.push('Добавьте хотя бы один вопрос в анкету.');
        }
        // Проверяем, что у каждого select выбран вопрос (значение не пустое)
        rows.forEach(function(row) {
            const select = row.querySelector('select');
            if (select.value.trim() === '') {
                valid = false;
                errors.push('Выберите вопрос во всех строках.');
                select.classList.add('is-invalid', 'is-invalid-lite');
            } else {
                select.classList.remove('is-invalid', 'is-invalid-lite');
            }
        });

        if (!valid) {
            event.preventDefault();
            errorDiv.classList.remove('d-none');
            errorDiv.innerHTML = `<ul><li>${errors.join('</li><li>')}</li></ul>`;
        } else {
            errorDiv.classList.add('d-none');
        }
    });
</script>
