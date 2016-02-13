<?php
/**
 * Created by IntelliJ IDEA.
 * User: abhinav
 * Date: 13/2/16
 * Time: 1:10 PM
 */
require_once __DIR__ . '/helper.php';

session_start();
// Base path
$path = realpath($_SESSION['path']);
$sortDirFirst = $_SESSION['sortDirFirst'];
$showHiddenFile = $_SESSION['showHiddenFile'];
// relative path to base path
$relativePath = $_GET['path'];
// absolute directory path
$directory = $path . $relativePath;

header('Content-Type: application/json');

echo json_encode(Helper::scanDir($directory, $relativePath, $showHiddenFile, $sortDirFirst));
