<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/php/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
$sid = htmlspecialchars($_GET["id"]);
?>
<html>
    <head>
        <!-- CSS Stylesheet -->
        <link href="/css/updateprofile.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <!-- Header -->
        <?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/layout/header.php"); ?>

        <div class="container" style="margin-top: 200px; min-height: 640px;">

            <section id="sign-up">
                <div class="inner">
                    <section class="entry-content sign-up">
                        <form class="form" method="POST" action="?">

                            <fieldset style="margin-top: 50px;padding-bottom: 25px">

                                <div>
                                    <span class="box_">
                                        <label>Summer Term:</label>
                                        <select class="box" name="summer">
                                            <option value="0">Study Term</option>
                                            <option value="1">Work Term</option>
                                        </select>
                                    </span>
                                    <span class="box_">
                                        <label>Fall Term:</label>
                                        <select class="box" name="fall">
                                            <option value="0">Study Term</option>
                                            <option value="1">Work Term</option>
                                        </select>
                                    </span>
                                    <span class="box_">
                                        <label>Winter Term:</label>
                                        <select class="box" name="winter">
                                            <option value="0">Study Term</option>
                                            <option value="1">Work Term</option>
                                        </select>
                                    </span>
                                </div>

                            </fieldset>

                            <div>
                                <input type="submit" style="margin-top: 50px;"/>
                            </div>
                        </form>
                    </section>
                </div>
            </section>












        </div>

        <?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/layout/footer.php"); ?>
    </body>
</html>