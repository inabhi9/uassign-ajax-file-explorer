<?php
/**
 * Created by IntelliJ IDEA.
 * User: abhinav
 * Date: 13/2/16
 * Time: 1:10 PM
 */
include_once __DIR__ . '/../autoload.php';
(new Session())->validateOrRedirect();

// Base path
$path = realpath($_SESSION['path']);
$sortDirFirst = $_SESSION['sortDirFirst'];
$showHiddenFile = $_SESSION['showHiddenFile'];
// relative path to base path
$relativePath = Helper::getVar('path');
// absolute directory path
$directory = $path . $relativePath;

Helper::echoJson(Helper::scanDir($directory, $relativePath, $showHiddenFile, $sortDirFirst));
