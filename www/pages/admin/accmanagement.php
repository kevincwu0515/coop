<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/php/functions.php';
?>
<html>
    <head>
    </head>

    <body>
        <!-- Header -->
        <?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/layout/header.php"); ?>


        <div class="container" style="margin-top: 200px; min-height: 800px;">
            <a href="/pages/admin/addnewacc.php">Add New Account</a><br /><br />
            <a href="/pages/admin/displayallacc.php">Manage Account</a><br /><br />
        </div>

        <?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/layout/footer.php"); ?>
    </body>
</html>