<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo config('APP_NAME'); if (!empty($title)) echo (' | ' . $title) ?></title>
        <link rel="icon" type="image/png" href="/assets/static/logo-small.png">
        <link rel="stylesheet" href="/assets/dist/css/tabler.min.css">
        <link rel="stylesheet" href="/assets/dist/css/demo.min.css">

        <style>
            * {
                border-radius: 0 !important;
                font-family: monospace !important;
            }
        </style>
    </head>
    <body class="layout-fluid">
        <script src="/assets/dist/js/demo-theme.min.js"></script>
        <div class="page">
            <aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark" style="background: url('/assets/bg.jpg'); background-size: 100%;">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="navbar-brand navbar-brand-autodark">
                        <a href="/">
                            <img src="/assets/static/logo.png" class="navbar-brand-image" style="width: 180px; height: 50px;" alt="logo">
                        </a>
                    </div>
                    <div class="collapse navbar-collapse" id="sidebar-menu">
                        <ul class="navbar-nav pt-lg-3">
                            <li class="nav-item">
                                <a class="nav-link" href="/">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M19 8.71l-5.333 -4.148a2.666 2.666 0 0 0 -3.274 0l-5.334 4.148a2.665 2.665 0 0 0 -1.029 2.105v7.2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-7.2c0 -.823 -.38 -1.6 -1.03 -2.105" />
                                        </svg>
                                    </span>

                                    <span class="nav-link-title">
                                        Главная страница
                                    </span>
                                </a>
                            </li>
                            <?php if (checkAccess('question', 'read')): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="/questions">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-help-hexagon"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.875 6.27c.7 .398 1.13 1.143 1.125 1.948v7.284c0 .809 -.443 1.555 -1.158 1.948l-6.75 4.27a2.269 2.269 0 0 1 -2.184 0l-6.75 -4.27a2.225 2.225 0 0 1 -1.158 -1.948v-7.285c0 -.809 .443 -1.554 1.158 -1.947l6.75 -3.98a2.33 2.33 0 0 1 2.25 0l6.75 3.98h-.033z" /><path d="M12 16v.01" /><path d="M12 13a2 2 0 0 0 .914 -3.782a1.98 1.98 0 0 0 -2.414 .483" /></svg>
                                        </span>

                                        <span class="nav-link-title">
                                            Вопросы
                                        </span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (checkAccess('questionnaire', 'read')): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="/questionnaires">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-files"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 3v4a1 1 0 0 0 1 1h4" /><path d="M18 17h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h4l5 5v7a2 2 0 0 1 -2 2z" /><path d="M16 17v2a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h2" /></svg>
                                        </span>

                                        <span class="nav-link-title">
                                            Анкеты
                                        </span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (checkAccess('surveyresponse', 'read')): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="/surveyresponses">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-device-tablet-question"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 21h-9a1 1 0 0 1 -1 -1v-16a1 1 0 0 1 1 -1h12a1 1 0 0 1 1 1v7" /><path d="M19 22v.01" /><path d="M19 19a2.003 2.003 0 0 0 .914 -3.782a1.98 1.98 0 0 0 -2.414 .483" /><path d="M11 17a1 1 0 1 0 2 0a1 1 0 0 0 -2 0" /></svg>
                                        </span>

                                        <span class="nav-link-title">
                                            Прохождения опросов
                                        </span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (checkAccess('module', 'read')): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="/modules">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-blocks"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 4a1 1 0 0 1 1 -1h5a1 1 0 0 1 1 1v5a1 1 0 0 1 -1 1h-5a1 1 0 0 1 -1 -1z" /><path d="M3 14h12a2 2 0 0 1 2 2v3a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h3a2 2 0 0 1 2 2v12" /></svg>
                                        </span>

                                        <span class="nav-link-title">
                                            Модули
                                        </span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (checkAccess('permission', 'read')): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="/permissions">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-key"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16.555 3.843l3.602 3.602a2.877 2.877 0 0 1 0 4.069l-2.643 2.643a2.877 2.877 0 0 1 -4.069 0l-.301 -.301l-6.558 6.558a2 2 0 0 1 -1.239 .578l-.175 .008h-1.172a1 1 0 0 1 -.993 -.883l-.007 -.117v-1.172a2 2 0 0 1 .467 -1.284l.119 -.13l.414 -.414h2v-2h2v-2l2.144 -2.144l-.301 -.301a2.877 2.877 0 0 1 0 -4.069l2.643 -2.643a2.877 2.877 0 0 1 4.069 0z" /><path d="M15 9h.01" /></svg>
                                        </span>

                                        <span class="nav-link-title">
                                            Разрешения
                                        </span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (checkAccess('role', 'read')): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="/roles">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-masks-theater"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M13.192 9h6.616a2 2 0 0 1 1.992 2.183l-.567 6.182a4 4 0 0 1 -3.983 3.635h-1.5a4 4 0 0 1 -3.983 -3.635l-.567 -6.182a2 2 0 0 1 1.992 -2.183z" /><path d="M15 13h.01" /><path d="M18 13h.01" /><path d="M15 16.5c1 .667 2 .667 3 0" /><path d="M8.632 15.982a4.037 4.037 0 0 1 -.382 .018h-1.5a4 4 0 0 1 -3.983 -3.635l-.567 -6.182a2 2 0 0 1 1.992 -2.183h6.616a2 2 0 0 1 2 2" /><path d="M6 8h.01" /><path d="M9 8h.01" /><path d="M6 12c.764 -.51 1.528 -.63 2.291 -.36" /></svg>
                                        </span>

                                        <span class="nav-link-title">
                                            Роли
                                        </span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (checkAccess('user', 'read')): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="/users">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>
                                        </span>

                                        <span class="nav-link-title">
                                            Пользователи
                                        </span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <div class="hr"></div>
                            <li class="nav-item">
                                <a class="nav-link" href="/account">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                                    </span>

                                    <span class="nav-link-title">
                                        Учетная запись
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </aside>
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="container-xl">
                        <?php echo $content; ?>
                    </div>
                </div>
            </div>
        </div>
        <script src="/assets/dist/js/tabler.min.js"></script>
        <script src="/assets/dist/js/demo.min.js"></script>
    </body>
</html>