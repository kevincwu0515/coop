<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/php/functions.php';

$type = htmlspecialchars($_GET["type"]);
$id = getUserId();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo uploadFile($type, $id);
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
            <h3>Requirement:</h3>
            <?php
            $type = htmlspecialchars($_GET["type"]);
            if ($type == "t" || $type == "r") {
                ?>
                <p>
                    1. File must be .pdf extension.
                    <br />
                    2. File size must be under 2 mb.
                </p>
                <?php
            } else if ($type == "i") {
                ?>
                <p>
                    1. File must be .png extension.
                    <br />
                    2. File size must be under 2 mb.
                    <br />
                    3. Pixel aspect ratio of the image must be 1:1. (Same width and height etc. square image)
                </p>
                <?php
            }
            ?>
            <form method="post" enctype="multipart/form-data" style="margin-top: 50px">
                <label for="file"><b>Choose a file:</b></label>
                <input type="file" name="file"/>
                <br /> <br /> <br />
                <input type="submit" value="upload" style="padding: 8px 35px 8px 35px;"/>
            </form>
        </div>
        <!-- Footer -->
        <?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/layout/footer.php"); ?>
    </body>
</html>
<?php

function uploadFile($type, $id) {
    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];

        // File properties
        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];
        $file_size = $file['size'];
        $file_error = $file['error'];


        // file extension
        $file_ext = explode('.', $file_name);
        $file_ext = strtolower(end($file_ext));

        $correctsize = true;
        if ($type == "t") { //Transcript
            $allowed = array('pdf');
        } else if ($type == "r") { // Resume
            $allowed = array('pdf');
        } else if ($type == "i") { // Icon
            $allowed = array('png');
            $image = $_FILES["file"]['tmp_name'];
            list($width, $height) = getimagesize($image);

            if ($width != $height) {
                sendPopup("You can only upload square image!!!");
                $correctsize = false;
            }
        }
        if ($correctsize) {
            if (!in_array($file_ext, $allowed)) {
                sendPopup("please upload required extension only.");
            } else if ($file_error == 0 && $correctsize) {
                if ($file_size < 2097152) {   // 2 Mb = 2097152  4 Mb = 4194304
                    if ($type === "t") { //Transcript
                        $file_name_new = $id . "-transcript" . "." . $file_ext;
                    } else if ($type === "r") { // Resume
                        $file_name_new = $id . "-resume" . "." . $file_ext;
                    } else if ($type === "i") { // Icon
                        $file_name_new = $id . "-icon" . "." . $file_ext;
                    }

                    $file_destination = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';
                    if ($type === "t") { //Transcript
                        $file_destination = $file_destination . $file_name_new;
                    } else if ($type === "r") { // Resume
                        $file_destination = $file_destination . $file_name_new;
                    } else if ($type === "i") { // Icon
                        $file_destination = $file_destination . "/profile/" . $file_name_new;
                    }
                    if (move_uploaded_file($file_tmp, $file_destination)) {
                        sendPopup("file successfully uploaded");
                    }
                } else {
                    sendPopup("Please upload file unsize 2Mb only.");
                }
            }
        }
    }
}
?>