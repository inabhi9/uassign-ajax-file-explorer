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
$path = '/home/abhinav';
// relative path to base path
$relativePath = $_GET['path'];

header('Content-Type: application/json');

$response = [];
$directory = $path . $relativePath;
$scanned_directory = array_diff(scandir($directory), ['..', '.']);


foreach ($scanned_directory as $item) {
    $itemPath = $directory . '/' . $item;
    $type = is_dir($itemPath) ? 'dir' : 'file';
    $size = Helper::human_filesize($stats['size']);
    $stats = stat($itemPath);


    $data = [
        'name'         => $item,
        'type'         => $type,
        'size'         => $type == 'dir' ? '--' : $size,
        'lastModified' => date('F jS, Y \a\t', $stats['mtime']),
        'relativePath' => "{$relativePath}/{$item}"
    ];
    $response[] = $data;
}

// Soring by directory first
usort(
    $response,
    function ($a, $b) {
        if ($a['type'] == $b['type']) {
            return $a['name'] > $b['name'];
        } else {
            return $a['type'] != 'dir';
        }
    }
);

echo json_encode($response);
