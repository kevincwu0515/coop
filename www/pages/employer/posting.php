<?php session_start(); ?>
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
            <h2>Posting Information</h2>
            <table style="padding-top: 15px">
                <tr height="25">
                    <td> <img align=left SRC="/images/layout/bullet_black.png" alt="" width="14" height="14"> </td>
                    <td> <font face="Arial"> 
                        <a href="sub/newposting.php" style="text-decoration: none;">Create new posting</a>
                        </font> 
                    </td>
                </tr>
                <tr height="25">
                    <td> <img align=left SRC="/images/layout/bullet_black.png" alt="" width="14" height="14"> </td>
                    <td> <font face="Arial"> 
                        <a href="sub/viewallpostings" style="text-decoration: none;">Edit your posting(s)
                        </a>
                        </font> 
                    </td>
                </tr>
                <tr height="25">
                    <td> <img align=left SRC="/images/layout/bullet_black.png" alt="" width="14" height="14"> </td>
                    <td> <font face="Arial"> 
                        <a href="" style="text-decoration: none;">Check your posting(s)
                        </a>
                        </font> 
                    </td>
                </tr>
            </table>
        </div>
        <!-- Footer -->
        <?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/layout/footer.php"); ?>
    </body>

</html>