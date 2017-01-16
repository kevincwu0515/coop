<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/php/functions.php';
$accid = htmlspecialchars($_GET["id"]);

$sql = "SELECT * FROM `accounts` WHERE `id` = $accid";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>
<html>
    <head>
        <link href="/css/updateprofile.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <!-- Header -->
        <?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/layout/header.php"); ?>


        <div class="container" style="margin-top: 200px; min-height: 800px;">


            <section id="sign-up">
                <div class="inner">
                    <section class="entry-content sign-up">
                        <form class="form" method="POST" action="?">

                            <fieldset style="margin-top: 50px;padding-bottom: 25px">
                                <legend style="margin-left: 10px;">Account Information</legend>
                                <div>
                                    <span class="box_left">
                                        <label>Username:</label>
                                        <input class="box" name="username" value="<?php echo $row["username"] ?>" disabled/>
                                    </span>
                                    <span class="box_right">
                                        <label>Account Type:</label>
                                        <select class="box" name="acctype">
                                            <option value="<?php echo $row["acctype"]; ?>"><?php echo getAccountTypeById($row["acctype"]); ?></option>
                                            <option value="1">Student</option>
                                            <option value="2">Employer</option>
                                            <option value="3">Instructor</option>
                                            <option value="4">Manager</option>
                                            <option value="5">System Administrator</option>
                                        </select>
                                    </span>
                                    <span class="box_left">
                                        <label>Password:</label>
                                        <input class="box" name="password" placeholder="********" />
                                    </span>
                                    <span class="box_right">
                                        <label>Confirm Password:</label>
                                        <input class="box" name="password" placeholder="********" />
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
