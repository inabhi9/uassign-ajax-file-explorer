<?php
/**
 * Created by IntelliJ IDEA.
 * User: abhinav
 * Date: 13/2/16
 * Time: 8:35 PM
 */
ini_set("display_errors", "1");
error_reporting(E_ALL);

set_error_handler(function($errno, $errstr, $errfile, $errline, array $errcontext) {
    // error was suppressed with the @-operator
    if (0 === error_reporting()) {
        return false;
    }
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});

spl_autoload_register(
    function ($class_name) {
        include_once __DIR__ . "/scripts/{$class_name}.php";
    }
);
