<?php
/**
 * Created by IntelliJ IDEA.
 * User: abhinav
 * Date: 13/2/16
 * Time: 8:54 PM
 */
include_once __DIR__ . '/../autoload.php';

/**
 * Class Session Starts session and has some helper method
 */
class Session {
    function __construct() {
        session_start();
    }

    /**
     * Validates session variable's path key. If it's not validate Helper::showError() is called.
     */
    function validateOrRedirect() {
        if (!isset($_SESSION['path'])) {
            Helper::showError('Invalid Path');
        }

        $path = realpath($_SESSION['path']);

        if (!file_exists($path) || !is_dir($path)) {
            Helper::showError('Invalid Path');
        }
    }

    /**
     * Sets application specific $_SESSION variables from $_POST
     */
    function setConfig() {
        $path = Helper::postVar('path');
        if ($path !== null) {
            if (!is_dir($path)) {
                Helper::showError('Invalid path');

                return;
            }
            $_SESSION['path'] = Helper::postVar('path');
            $_SESSION['showHiddenFile'] = Helper::postVar('showHiddenFile') == 'on';
            $_SESSION['sortDirFirst'] = Helper::postVar('sortDirFirst') == 'on';
        }

        if (Helper::arrayVar($_SESSION, 'path') == null) {
            Helper::showError('Invalid path');
        }
    }
}
