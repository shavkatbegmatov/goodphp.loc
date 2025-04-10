<form method="POST" action="/question/answer_options/<?php e($question['id']); ?>">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Управление вариантами ответа для вопроса "<?php e($question['text']); ?>"</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="answerOptionsTable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Текст варианта</th>
                        <th>Порядок отображения</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $index = 0; ?>
                    <?php foreach ($answeroptions as $option): ?>
                        <tr data-index="<?php e($index); ?>">
                            <td>
                                <?php if(isset($option['id'])): ?>
                                    <input type="hidden" name="answeroptions[<?php e($index); ?>][id]" value="<?php e($option['id']); ?>">
                                    <?php e($option['id']); ?>
                                <?php else: ?>
                                    Новое
                                <?php endif; ?>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="answeroptions[<?php e($index); ?>][option_text]" value="<?php e($option['option_text']); ?>">
                            </td>
                            <td>
                                <input type="number" class="form-control" name="answeroptions[<?php e($index); ?>][display_order]" value="<?php e($option['display_order']); ?>">
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-icon btn-outline-danger remove-row" title="Удалить">
                                    <!-- Простой SVG-иконка крестика -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="18" y1="6" x2="6" y2="18"/>
                                        <line x1="6" y1="6" x2="18" y2="18"/>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        <?php $index++; ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <button type="button" id="addRowBtn" class="btn btn-secondary mt-3">Добавить вариант</button>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary w-100">Сохранить варианты</button>
        </div>
    </div>
</form>

<script>
    // Устанавливаем начальный счетчик строк равным числу существующих строк
    let rowCount = <?php echo $index; ?>;

    // Обработчик кнопки "Добавить вариант"
    document.getElementById('addRowBtn').addEventListener('click', function() {
        const tbody = document.querySelector('#answerOptionsTable tbody');
        const newRow = document.createElement('tr');
        newRow.setAttribute('data-index', rowCount);

        // Формируем HTML для новой строки. Так как вариант новый, поле id оставляем пустым.
        newRow.innerHTML = `
      <td>Новое</td>
      <td>
        <input type="text" class="form-control" name="answeroptions[${rowCount}][option_text]" value="" placeholder="Введите текст варианта">
      </td>
      <td>
        <input type="number" class="form-control" name="answeroptions[${rowCount}][display_order]" value="" placeholder="Введите порядок">
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

    // Делегирование события клика по кнопкам удаления строки
    document.querySelector('#answerOptionsTable tbody').addEventListener('click', function(event) {
        if (event.target.closest('.remove-row')) {
            const row = event.target.closest('tr');
            row.parentNode.removeChild(row);
        }
    });
</script>
