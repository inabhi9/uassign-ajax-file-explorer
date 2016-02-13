<?php
include_once __DIR__ . '/../autoload.php';
(new Session())->setConfig();
?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Path:
            <span style="font-style: italic"><?= $_SESSION['path'] ?></span>
        </h3>
    </div>
    <div class="panel-body" style="padding: 5px 16px 0px 16px">
        <div class="row" style="margin-bottom: 5px">
            <div class="col-md-7">
                <strong>Name</strong>
            </div>

            <div class="col-md-3">
                <strong>Last Modified</strong>
            </div>

            <div class="col-md-2">
                <strong>Size</strong>
            </div>
        </div>
        <div id="ajaxBrowser"></div>
    </div>
</div>
