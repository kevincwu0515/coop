<?php session_start(); ?>
<html>
    <head>
    </head>

    <body>
        <!-- Header -->
        <?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/layout/header.php"); ?>

        <div class="container" style="margin-top: 200px; min-height: 640px;">
            <a href="/pages/manager/schooltermtracking.php">Modify/view School term</a><br /><br />

            <a href="/pages/manager/viewstudent.php">Student term tracking</a><br /><br />

            <a href="/pages/manager/course.php">Course Instructor Information</a><br /><br />

        </div>

        <?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/layout/footer.php"); ?>
    </body>
</html>