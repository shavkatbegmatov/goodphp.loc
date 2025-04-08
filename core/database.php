<?php

require_once CORE_PATH . '/redbean/rb.php';

$dsn = sprintf(
    'mysql:host=%s;dbname=%s;charset=utf8',
    config('DB_HOST'),
    config('DB_NAME')
);

R::setup($dsn, config('DB_USER'), config('DB_PASSWORD'));
R::freeze(true);