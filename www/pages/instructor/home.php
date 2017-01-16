<?php session_start(); ?>
<html>
    <head>
        <!-- Title -->
        <title>Coop System Management</title>
        <!-- Page Icon -->
        <link rel="shortcut icon" href="/includes/images/icon.ico" type="images/x-icon" />
        <!-- CSS Stylesheet -->
                <link href="/css/updateprofile.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <!-- Header -->
        <?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/layout/header.php"); ?>
        <!-- Body -->
                <section class="sign-up">
            <p style="margin-top: 50px;margin-left: -150px;font-size: 26px">
                Current term: <b><?php echo getCurrentTerm();?></b>.
            </p>
            <?php
            for ($i = 1; $i <= 3; $i++) {
                $sql = "SELECT * FROM `schoolterm` WHERE `id` = $i;";
                $result = $conn->query($sql);
                if ($row = $result->fetch_assoc()) {
                    $title;
                    if ($i == 1) {
                        $title = "Summer Term";
                    } else if ($i == 2) {
                        $title = "Fall Term";
                    } else if ($i == 3) {
                        $title = "Winter Term";
                    }
                    $startdate = date("M d, Y", strtotime($row["startday"]));
                    $enddate = date("M d, Y", strtotime($row["endday"]));
                    ?>
                    <fieldset style="margin-top: 20px;padding-bottom: 25px; width:515px;">

                        <legend style="margin-left: 10px;"><?php echo $title; ?></legend>
                        <p id="anchorExample" style="margin-top: 15px;margin-left: 40px">
                            From: <input type="text" class="date" name="date" value="<?php echo $startdate; ?>" disabled/>

                            <span style="margin-left: 25px;">to: </span>
                            <input type="text" class="date" name="date" value="<?php echo $enddate; ?>" disabled/>
                        </p>
                    </fieldset>
                    <?php
                }
            }
            ?>
        </section>

        <!-- Footer -->
        <?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/layout/footer.php"); ?>
    </body>

</html>