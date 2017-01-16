<?php
session_start();

$type = htmlspecialchars($_GET["type"]);
$id = htmlspecialchars($_GET["id"]);
$file = "/uploads/" . $id . "-";
if ($type == "t") { //Transcript
    $file = $file . "transcript.pdf";
} else if ($type == "r") { // Resume
    $file = $file . "resume.pdf";
}
?>
<html>
    <!-- Head -->
    <head>
        <title>Coop System Management</title>
        <!-- Page Icon -->
        <link rel="shortcut icon" href="/includes/images/icon.ico" type="images/x-icon" />
        <!-- CSS Stylesheet -->
        <link href="/css/layout.css" rel="stylesheet" type="text/css" />
    </head>
    <!-- Body -->
    <body>
        <!-- Header -->
        <?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/layout/header.php"); ?>

        <!-- Body -->
        <div class="section">
            <?php
            echo $file;
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . $file)) {
                echo "<embed src=\" $file ?>\" width=\"1200px\" height=\"800px\" />";
            } else {
                echo "no file uploaded.";
            }
            ?>
        </div>
    </body>
    <!-- Footer -->
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/layout/footer.php"); ?>
</html>
