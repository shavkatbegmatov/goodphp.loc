<form class="card card-md" method="POST" action="/user/create">
    <div class="card-body">
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-<?php echo htmlspecialchars($_SESSION['message']['type'], ENT_QUOTES, 'UTF-8'); ?>" role="alert">
                <?php echo htmlspecialchars($_SESSION['message']['text'], ENT_QUOTES, 'UTF-8'); unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>

        <div id="error-message" class="alert alert-danger d-none" role="alert"></div>
        
        <div class="mb-3">
            <label class="form-label required">Имя пользователя</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Введите имя пользователя">
            <p class="form-text text-muted">Ваше имя пользователя должно содержать только буквенно-цифровые символы и символы подчеркивания и быть длиной от 4 до 100 символов.</p>
        </div>
        <div class="mb-3">
            <label class="form-label required">Пароль</label>
            <div class="input-group input-group-flat">
                <input type="password" class="form-control" name="password" id="password" placeholder="Введите пароль">
                <span class="input-group-text">
                    <a href="#" class="link-secondary" title="Show password" onclick="togglePasswordVisibility();">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                            <path
                                d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                        </svg>
                    </a>
                </span>
            </div>
            <p class="form-text text-muted">Длина пароля должна составлять не менее 8 символов.</p>
        </div>
        <div class="form-footer">
            <button type="submit" class="btn btn-primary w-100">Создать пользователя</button>
        </div>
    </div>
</form>

<script>
    function togglePasswordVisibility() {
        const passwordField = document.getElementById('password');
        const passwordFieldType = passwordField.getAttribute('type');
        passwordField.setAttribute('type', passwordFieldType === 'password' ? 'text' : 'password');
    }

    document.querySelector('form').addEventListener('submit', function (event) {
        const name = document.getElementById('name');
        const email = document.getElementById('email');
        const password = document.getElementById('password');
        const errorMessage = document.getElementById('error-message');
        let errorMessages = [];

        if (!name.value.trim()) {
            errorMessages.push('Пожалуйста, введите имя пользователя.');
            name.classList.add('is-invalid');
            name.classList.add('is-invalid-lite');
        } else if (!/^[a-zA-Z0-9_]{4,100}$/.test(name.value.trim())) {
            errorMessages.push('Ваше имя пользователя должно содержать только буквенно-цифровые символы и символы подчеркивания и быть длиной от 4 до 100 символов.');
            name.classList.add('is-invalid');
            name.classList.add('is-invalid-lite');
        } else {
            name.classList.remove('is-invalid');
            name.classList.remove('is-invalid-lite');
        }

        if (!password.value.trim()) {
            errorMessages.push('Пожалуйста, введите пароль.');
            password.classList.add('is-invalid');
            password.classList.add('is-invalid-lite');
        } else if (password.value.trim().length < 8) {
            errorMessages.push('Длина пароля должна составлять не менее 8 символов.');
            password.classList.add('is-invalid');
            password.classList.add('is-invalid-lite');
        } else {
            password.classList.remove('is-invalid');
            password.classList.remove('is-invalid-lite');
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