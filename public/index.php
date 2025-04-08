<?php

session_start();

const BASE_PATH = __DIR__ . '/..';
const CORE_PATH = __DIR__ . '/../core';
const APP_PATH = __DIR__ . '/../app';

require_once CORE_PATH . '/helpers.php';
require_once CORE_PATH . '/error.php';
require_once CORE_PATH . '/database.php';
require_once CORE_PATH . '/router.php';
