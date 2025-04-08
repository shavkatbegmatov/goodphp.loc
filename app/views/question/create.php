<form class="card card-md" method="POST" action="/question/create">
    <div class="card-body">
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-<?php e($_SESSION['message']['type']); ?>" role="alert">
                <?php e($_SESSION['message']['text']); unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>

        <div id="error-message" class="alert alert-danger d-none" role="alert"></div>

        <!-- Поле для ввода текста вопроса -->
        <div class="mb-3">
            <label class="form-label required">Текст вопроса</label>
            <textarea class="form-control" name="text" id="text" placeholder="Введите текст вопроса" rows="4"></textarea>
            <p class="form-text text-muted">Введите полный текст вопроса.</p>
        </div>

        <!-- Выбор типа вопроса -->
        <div class="mb-3">
            <label class="form-label required">Тип вопроса</label>
            <div class="form-selectgroup">
                <label class="form-selectgroup-item">
                    <input type="radio" name="question_type" value="multiple_choice" class="form-selectgroup-input" checked>
                    <span class="form-selectgroup-label">Множественный выбор</span>
                </label>
                <label class="form-selectgroup-item">
                    <input type="radio" name="question_type" value="text" class="form-selectgroup-input">
                    <span class="form-selectgroup-label">Текстовый ответ</span>
                </label>
            </div>
        </div>

        <div class="form-footer">
            <button type="submit" class="btn btn-primary w-100">Создать вопрос</button>
        </div>
    </div>
</form>

<script>
    document.querySelector('form').addEventListener('submit', function(event) {
        const textField = document.getElementById('text');
        const errorMessage = document.getElementById('error-message');
        let errors = [];

        const textValue = textField.value.trim();
        if (!textValue) {
            errors.push('Пожалуйста, введите текст вопроса.');
            textField.classList.add('is-invalid', 'is-invalid-lite');
        } else {
            textField.classList.remove('is-invalid', 'is-invalid-lite');
        }

        if (errors.length > 0) {
            event.preventDefault();
            errorMessage.classList.remove('d-none');
            let errorList = '<ul>';
            errors.forEach(function(msg) {
                errorList += '<li>' + msg + '</li>';
            });
            errorList += '</ul>';
            errorMessage.innerHTML = errorList;
        } else {
            errorMessage.classList.add('d-none');
        }
    });
</script>
