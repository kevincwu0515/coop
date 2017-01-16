<?php
session_start();
require_once ($_SERVER['DOCUMENT_ROOT'] . '/includes/php/functions.php');

$type = htmlspecialchars($_GET["type"]);
$success = true;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['user'];
    $password = $_POST['pass'];

    $success = login($username, $password, $type);
}
if (getUserType() != 0 && getUserType() == getTypeId($type)) {
    headToHomePage();
}
?>
<html>
    <head>
        <title>Coop System <?php echo $type; ?> Login Page</title>
        <!-- Page Icon -->
        <link rel="shortcut icon" type="images/x-icon" href="images/icon.png" />
        <!-- CSS Stylesheet -->
        <link href="/css/login.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <div class="login-card">
            <?php
            if (getUserType() != 0 && getUserType() != getTypeId($type)) {
                echo "<h1>Please Log out first to continue.</h1><br>";
                ?>
                <form action="/pages/logout.php">
                    <input type="submit" name="logout" class="login login-submit" value="logout">
                </form>
                <?php
                return;
            }
            ?>
            <h1>Log-in</h1><br>
            <form method="post">
                <input type="text" name="user" placeholder="Username">
                <input type="password" name="pass" placeholder="Password">
                <input type="submit" name="login" class="login login-submit" value="login">
            </form>

            <div class="login-help">
                <a href="#">Forgot Password</a>
            </div>
            <?php
            if ($success == false) {
                ?>
                <div class="login-wrong-pass">
                    Incorrect password! Please Try again.
                </div>
                <?php
            }
            ?>
        </div>

    </body>
</html>