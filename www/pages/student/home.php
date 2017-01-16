<?php session_start(); ?>
<html>
    <head>
        <!-- Title -->
        <title>Coop System Management</title>
        <!-- Page Icon -->
        <link rel="shortcut icon" href="/includes/images/icon.ico" type="images/x-icon" />
        <!-- CSS Stylesheet -->
        <link href="/css/photobanner.css" rel="stylesheet" type="text/css" />
    </head>


    <body>
        <!-- Header -->
        <?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/layout/header.php"); ?>


        <!-- photo banner -->
        <div id="photo_banner">
            <header>
                <h2>Featured Employer</h2>
                <br />
                <p>
                    Featured Employer is a comprehensive marketing package that provides your healthcare job 
                    listings with maximum exposure to healthcare professionals on Health Career Center, and 
                    with a network posting purchase, across several sites within the network.
                </p>
            </header>

            <div class="banner">
                <img class="first" src="default_profile.jpg" alt="" />
                <?php addPhotoBanner() ?>
            </div>
        </div><!-- ./photo_banner -->

        <!-- Footer -->
        <?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/layout/footer.php"); ?>
    </body>
</html>

<?php

function addPhotoBanner() {
    $filepath = $_SERVER['DOCUMENT_ROOT'] . "/uploads/profile/";
    for ($i = 1; $i <= 10; $i++) {
        $filename = $filepath . $i . "-icon.png";
        if (file_exists($filename)) {
            echo "<a href=\"/pages/viewprofile.php?id=$i\">"
            . "<img style=\"width:300px;height:300px;\" src=\"/uploads/profile/" . $i . "-icon.png\"/>"
            . "</a>";
        }
    }
}
?>