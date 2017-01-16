<?php
session_start();
require_once ($_SERVER['DOCUMENT_ROOT'] . '/includes/php/functions.php');
?>
<html>
    <head>
        <meta http-equiv="refresh" content="3; url=/" />
        <title>Coop System Logout Page</title>
        <!-- Page Icon -->
        <link rel="shortcut icon" type="images/x-icon" href="images/icon.png" />
        <!-- CSS Stylesheet -->
        <link href="/css/login.css" rel="stylesheet" type="text/css" />

    </head>

    <body>
        <?php logout(); ?>

        <div class="login-card">
            <h1>Logout!</h1><br>
            <hr /><br />
            <p style="text-align: center;">
                You have successfully logout
                <br /><br />
                <b>
                    Redirecting to home page in 3 seconds...
                </b>
            </p>
        </div>

    </body>
</html>
<?php

function logout() {
    session_unset();
    session_destroy();
}
?>