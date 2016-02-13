<?php
/**
 * Created by IntelliJ IDEA.
 * User: abhinav
 * Date: 13/2/16
 * Time: 6:44 PM
 */

session_start();
// Base path
$path = realpath($_SESSION['path']);
$file = $_GET['file'];

$file = $path . '/' . $file;

if (file_exists($file) && is_file($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($file));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    ob_clean();
    flush();
    readfile($file);
    exit;
}
