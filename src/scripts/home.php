<?php
include_once __DIR__ . '/../autoload.php';
(new Session());

$path = Helper::arrayVar($_SESSION, 'path', '/');
?>


<div class="jumbotron">
    <h1>Ajax File Explorer</h1>

    <p class="lead"> Intuitive ajax based directory browser and file downloader </p>

    <form class="form-inline" action="index.php?route=browser" method="post">

        <div class="lead">
            <div class="form-group">
                <label class="sr-only" for="path">Directory path</label>
                <input type="text"
                       class="form-control"
                       id="path"
                       placeholder="Directory path"
                       name="path"
                       value="<?= $path ?>"
                       style="width: 400px">
            </div>
            <div class="checkbox" style="padding-left: 10px">
                <label>
                    <input type="checkbox" name="showHiddenFile"> Show hidden files
                </label>
            </div>

            <div class="checkbox" style="padding-left: 10px">
                <label>
                    <input type="checkbox" name="sortDirFirst" checked> Sort directory first
                </label>
            </div>

        </div>

        <p>
            <button
                class="btn btn-lg btn-success"
                type="submit">
                Browse
            </button>
        </p>
    </form>
</div>
