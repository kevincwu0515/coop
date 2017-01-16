<?php 
session_start(); 
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/php/functions.php';
?>
<html>
    <head>
        <!-- Title -->
        <title>Coop System Management</title>
        <!-- Page Icon -->
        <link rel="shortcut icon" href="/includes/images/icon.ico" type="images/x-icon" />
    </head>

    <body>
        <!-- Header -->
        <?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/layout/header.php"); ?>
        <!-- Body -->
        <div class="section">


            <h2>Personal Information</h2>
            <table style="padding-top: 15px">
                <?php
                /* array(url, text) */
                $viewprofile = "/pages/viewprofile.php?id=" . getUserId();
                $array = array(
                    array($viewprofile, "View your profile"),
                    array("/pages/updateprofile.php", "Update your profile"),
                    array("/pages/uploadfile.php?type=i", "Upload profile icon")
                );
                $bullet = "/images/layout/bullet_black.png";
                foreach ($array as $arr) {
                    ?>
                    <tr height="25">
                        <td width="8">
                            <img src="/images/layout/bullet_black.png" alt="" width="14" height="14"> 
                        </td>
                        <td>
                            <a href="<?php echo $arr[0]; ?>" style="text-decoration: none;"><font face = "Arial"><?php echo $arr[1]; ?> </font></a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </table>
        </div>
        <!-- Footer -->
        <?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/layout/footer.php"); ?>
    </body>

</html>