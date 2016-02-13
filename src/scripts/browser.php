<?php
session_start();

$_SESSION['path'] = $_POST['path'];
?>

<h5>Browsing <input class="form-control"/></h5>
<div class="row">
    <div class="col-md-12">
        <div id="ajaxBrowser"></div>
    </div>
</div>

