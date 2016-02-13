<?php
session_start();

if (isset($_POST['path']) && !empty($_POST['path'])) {
    $path = $_POST['path'];
    if (!file_exists($path) || !is_dir($path)) {
        header('Location: index.php?error=Invalid path');
        exit;
    }

    $_SESSION['path'] = $_POST['path'];
    $_SESSION['showHiddenFile'] = $_POST['showHiddenFile'] == 'on';
    $_SESSION['sortDirFirst'] = $_POST['sortDirFirst'] == 'on';
}
?>

<h5>Browsing <input class="form-control"/></h5>
<div class="row">
    <div class="col-md-12">
        <div id="ajaxBrowser"></div>
    </div>
</div>

