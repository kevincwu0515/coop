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

        <!-- Personal Information section -->
        <div class="section">
            <h2 style="font-size:24px;">Personal Information</th>
                <table style="padding-top: 15px">
                    <?php
                    /* array(url, text) */
                    $profile = "/pages/viewprofile.php?id=" . getUserId();
                    $uicon = "/pages/uploadfile.php?type=i";
                    $uresume = "/pages/uploadfile.php?type=r";
                    $utranscript = "/pages/uploadfile.php?type=t";
                    $vresume = "/pages/viewfile.php?type=r&id=" . getUserId();
                    $vtranscript = "/pages/viewfile.php?type=t&id=" . getUserId();

                    $array = array(
                        array($profile, "View your profile"),
                        array("/pages/updateprofile.php", "Update your profile"),
                        array($uicon, "Upload profile icon"),
                        array($uresume, "Upload your resume"),
                        array($utranscript, "Upload your transcipt"),
                        array($vresume, "View yours resume"),
                        array($vtranscript, "View yours transcript")
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

        <!-- TODO: email validation -->

        <!-- Footer -->
        <?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/layout/footer.php"); ?>
    </body>
</html>