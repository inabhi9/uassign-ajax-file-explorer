<?php

/**
 * Created by IntelliJ IDEA.
 * User: abhinav
 * Date: 13/2/16
 * Time: 6:01 PM
 */
class Helper {
    static function scanDir(
        $directory,
        $relativePath,
        $showHiddenFile = true,
        $sortDirFirst = true
    ) {
        $response = [];
        $scannedDirectory = array_diff(scandir($directory), ['..', '.']);

        foreach ($scannedDirectory as $item) {
            if ($showHiddenFile == false && strpos($item, '.') !== false) {
                continue;
            }

            $itemPath = $directory . '/' . $item;
            $type = is_dir($itemPath) ? 'dir' : 'file';
            $stats = stat($itemPath);
            $size = self::human_filesize($stats['size']);

            $data = [
                'name' => $item,
                'type' => $type,
                'size' => $type == 'dir' ? '--' : $size,
                'lastModified' => date('F jS, Y \a\t', $stats['mtime']),
                'relativePath' => "{$relativePath}/{$item}"
            ];
            $response[] = $data;
        }

        if ($sortDirFirst == true) {
            self::sortDirFirst($response);
        }

        return $response;
    }

    static function human_filesize($size, $precision = 2) {
        for ($i = 0; ($size / 1024) > 0.9; $i++, $size /= 1024) {
        }

        return round($size, $precision) . ['B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'][$i];
    }

    static function sortDirFirst(&$ar) {
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

}
