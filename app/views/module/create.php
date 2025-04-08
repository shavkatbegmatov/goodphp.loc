<form class="card card-md" method="POST" action="/module/create">
    <div class="card-body">
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-<?php echo htmlspecialchars($_SESSION['message']['type'], ENT_QUOTES, 'UTF-8'); ?>" role="alert">
                <?php echo htmlspecialchars($_SESSION['message']['text'], ENT_QUOTES, 'UTF-8'); unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>

        <div id="error-message" class="alert alert-danger d-none" role="alert"></div>

        <!-- Поле для названия модуля -->
        <div class="mb-3">
            <label class="form-label required">Название модуля</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Введите название модуля">
            <p class="form-text text-muted">
                Название должно содержать от 4 до 100 символов и состоять только из латинских букв, цифр и символа подчеркивания.
            </p>
        </div>

        <div class="form-footer">
            <button type="submit" class="btn btn-primary w-100">Создать модуль</button>
        </div>
    </div>
</form>

<script>
    document.querySelector('form').addEventListener('submit', function (event) {
        const name = document.getElementById('name');
        const errorMessage = document.getElementById('error-message');
        let errorMessages = [];

        // Валидация: допускаются только латинские буквы, цифры и символ подчеркивания, длина от 4 до 100 символов.
        const nameValue = name.value.trim();
        const nameRegex = /^[a-zA-Z0-9_]{4,100}$/;
        if (!nameValue) {
            errorMessages.push('Пожалуйста, введите название модуля.');
            name.classList.add('is-invalid', 'is-invalid-lite');
        } else if (!nameRegex.test(nameValue)) {
            errorMessages.push('Название модуля должно содержать от 4 до 100 символов и состоять только из латинских букв, цифр и символа подчеркивания.');
            name.classList.add('is-invalid', 'is-invalid-lite');
        } else {
            name.classList.remove('is-invalid', 'is-invalid-lite');
        }

        if (errorMessages.length > 0) {
            event.preventDefault();
            errorMessage.classList.remove('d-none');
            let errorList = '<ul>';
            errorMessages.forEach(function(message) {
                errorList += '<li>' + message + '</li>';
            });
            errorList += '</ul>';
            errorMessage.innerHTML = errorList;
        } else {
            errorMessage.classList.add('d-none');
        }
    });
</script>
