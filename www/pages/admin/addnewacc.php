<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/php/functions.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = "";
    if (!empty($_POST['username'])) {
        if (!empty($_POST['password'])) {
            if ($_POST['confirm_password']) {
                        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        if (accountExist($_POST['username'])) {
            $message = "Username in used!!";
        } else if ($password != $confirm_password) {
            $message = "Password does not match!";
        } else {
            $username = $_POST['username'];
            $acctype = $_POST['acctype'];
            $sql = "INSERT INTO `accounts` (`username`, `password`, `acctype`) VALUES ('$username', '$password', '$acctype');";
            if ($conn->query($sql)) {
                $message = "New Account created!";
            }
        }
            }
        }
    } else {
        $message = "All the input field must be filled in order to create new Account!";
    }
    sendPopup($message);
}
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
                        <form class="form" method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>">

                            <fieldset style="margin-top: 50px;padding-bottom: 25px">
                                <legend style="margin-left: 10px;">Account Information</legend>
                                <div>
                                    <span class="box_left">
                                        <label>Username:</label>
                                        <input class="box" name="username"/>
                                    </span>
                                    <span class="box_right">
                                        <label>Account Type:</label>
                                        <select class="box" name="acctype">
                                            <option value="1">Student</option>
                                            <option value="2">Employer</option>
                                            <option value="3">Instructor</option>
                                            <option value="4">Manager</option>
                                            <option value="5">System Administrator</option>
                                        </select>
                                    </span>
                                    <span class="box_left">
                                        <label>Password:</label>
                                        <input class="box" name="password"/>
                                    </span>
                                    <span class="box_right">
                                        <label>Confirm Password:</label>
                                        <input class="box" name="confirm_password"/>
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
<?php

function accountExist($username) {
    global $conn;
    $sql = "SELECT * FROM `accounts` WHERE `username`=\"$username\";";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
        return true;
    else
        return false;
}
?>