<?php
include_once __DIR__ . '/autoload.php';

$route = Helper::getVar('route');
if (empty($route))
    $route = 'home';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Ajax File Browser</title>

    <!-- Bootstrap -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- Optional theme -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="assets/css/jqAjaxBrowser.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="container">
    <div class="header clearfix">
        <nav>
            <ul class="nav nav-pills pull-right">
                <li role="presentation"
                    class="<?= $route == 'home' ? 'active' : '' ?>">
                    <a href="index.php">Home</a>
                </li>
                <li role="presentation"
                    class="<?= $route == 'browser' ? 'active' : '' ?>">
                    <a href="index.php?route=browser">Browser</a>
                </li>
                <li role="presentation"><a href="#">Repo</a></li>
            </ul>
        </nav>
        <h3 class="text-muted"><a href="index.php">Ajax File Explorer</a></h3>
    </div>

    <div class="container">
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger" role="alert">
                <strong>Error!</strong> <?= htmlentities($_GET['error']) ?>
            </div>
        <?php endif ?>

        <?php include __DIR__ . "/scripts/{$route}.php" ?>
    </div>

    <footer class="footer">
        <p>&copy; 2015 Abhinav</p>
    </footer>

</div>
<!-- /container -->

<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="assets/js/jqAjaxBrowser.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#ajaxBrowser').ajaxBrowser({
            url        : 'scripts/browse-directory.php',
            downloadUrl: 'scripts/download-file.php'
        });
    });

</script>
</body>
</html>
