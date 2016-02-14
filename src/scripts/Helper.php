<?php
/**
 * Created by IntelliJ IDEA.
 * User: abhinav
 * Date: 13/2/16
 * Time: 6:01 PM
 */
include_once __DIR__ . '/../autoload.php';

/**
 * Class Helper
 *
 * To provide useful methods
 */
class Helper {

    /**
     * Scans directory and prepares the list of file/dir found within directory with its information
     *
     * @param string $directory Absolute directory path to be scanned
     * @param string $relativePath Meta information to be passed in return array
     * @param bool|true $showHiddenFile If list should include hidden files
     * @param bool|true $sortDirFirst If list should be sorted by directory first then files
     * @return array
     */
    static function scanDir(
        $directory,
        $relativePath,
        $showHiddenFile = true,
        $sortDirFirst = true
    ) {
        $response = [];
        $scannedDirectory = array_diff(scandir($directory), ['..', '.']);

        foreach ($scannedDirectory as $item) {
            // Skip hidden file is user not asked
            if ($showHiddenFile == false && strpos($item, '.') === 0) {
                continue;
            }

            // absolute dir/file path
            $itemPath = $directory . '/' . $item;
            $type = is_dir($itemPath) ? 'dir' : 'file';
            $stats = stat($itemPath);
            $size = self::human_filesize($stats['size']);

            $data = [
                'name' => $item,
                'type' => $type,
                'size' => $type == 'dir' ? '--' : $size,
                'lastModified' => date('F jS, Y \a\t h:m a', $stats['mtime']),
                'relativePath' => "{$relativePath}/{$item}"
            ];
            $response[] = $data;
        }

        if ($sortDirFirst == true) self::sortDirFirst($response);

        return $response;
    }

    /**
     * Converts gives file size to human readable form. ie to 1024 bytes to 1kb
     *
     * @param int $size Size in byte to be converted to human readable form
     * @param int $precision Precision to be kept. Default is 2
     * @return string Human readable file size
     */
    static function human_filesize($size, $precision = 2) {
        for ($i = 0; ($size / 1024) > 0.9; $i++, $size /= 1024) {
            ;
        }

        return round($size, $precision) . ['B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'][$i];
    }

    /**
     * Helper function to sort array of array containing the name and type. Used by self::scanDir()
     *
     * @param array $ar
     */
    private static function sortDirFirst(&$ar) {
        usort(
            $ar,
            function ($a, $b) {
                if ($a['type'] == $b['type']) {
                    return $a['name'] > $b['name'];
                } else {
                    return $a['type'] != 'dir';
                }
            }
        );
    }

    /**
     * Redirects user to index.php with parameter error
     *
     * @param string $message Message to appended
     */
    static function showError($message) {
        header('Location: /index.php?error=' . $message);
        exit;
    }

    /**
     * Helper function to retrieve variable from array $_GET
     *
     * @param string $variable Variable name to be accessed
     * @param mixed $default Default value if $variable not found in the array. Default is null
     * @return string
     */
    static function getVar($variable, $default = null) {
        return self::arrayVar($_GET, $variable, $default);
    }

    /**
     * Helper function to retrieve variable from the array
     *
     * @param array $array Array to be looked for
     * @param string $variable Variable name to be accessed
     * @param mixed $default Default value if $variable not found in the array. Default is null
     * @return string
     */
    static function arrayVar($array, $variable, $default = null) {
        return isset($array[$variable]) && !empty($array[$variable]) ? $array[$variable] : $default;
    }

    /**
     * Helper function to retrieve variable from array $_POST
     *
     * @param string $variable Variable name to be accessed
     * @param mixed $default Default value if $variable not found in the array. Default is null
     * @return string
     */
    static function postVar($variable, $default = null) {
        return self::arrayVar($_POST, $variable, $default);
    }

    /**
     * Echo given array into json and exits. This also set the proper header
     *
     * @param array $arr
     */
    static function echoJson($arr) {
        header('Content-Type: application/json');
        echo json_encode($arr);
        exit;
    }

}
