<?php

ini_set('display_errors', 0);
error_reporting(E_ALL);

function formatError($message, $file, $line, $type = '') {
    $errorType   = htmlspecialchars($type);
    $errorMessage= htmlspecialchars($message);
    $errorFile   = htmlspecialchars($file);
    $errorLine   = htmlspecialchars($line);
    $templateFile = APP_PATH . '/views/errors/error.php';

    ob_start();
    include $templateFile;
    return ob_get_clean();
}


function logErrorToFile($errno, $errstr, $errfile, $errline) {
    $logFile = __DIR__ . '/../logs/errors.log';
    $date = date('Y-m-d H:i:s');
    $entry = "[$date] ($errno) $errstr in $errfile:$errline\n";
    error_log($entry, 3, $logFile);
}

function handleError($errno, $errstr, $errfile, $errline) {
    $formattedError = formatError($errstr, $errfile, $errline, $errno);
    echo $formattedError;
    logErrorToFile($errno, $errstr, $errfile, $errline);
}

function customErrorHandler($errno, $errstr, $errfile, $errline) {
    handleError($errno, $errstr, $errfile, $errline);
    return true;
}

function customExceptionHandler($exception) {
    handleError("Exception", $exception->getMessage(), $exception->getFile(), $exception->getLine());
}

function shutdownHandler() {
    $error = error_get_last();
    if ($error !== null) {
        handleError($error['type'], $error['message'], $error['file'], $error['line']);
    }
}

set_error_handler('customErrorHandler');
set_exception_handler('customExceptionHandler');
register_shutdown_function('shutdownHandler');
