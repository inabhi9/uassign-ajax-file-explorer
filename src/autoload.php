<?php
/**
 * Created by IntelliJ IDEA.
 * User: abhinav
 * Date: 13/2/16
 * Time: 8:35 PM
 */
ini_set("display_errors", "1");
error_reporting(E_ALL);

spl_autoload_register(
    function ($class_name) {
        include_once __DIR__ . "/scripts/{$class_name}.php";
    }
);
