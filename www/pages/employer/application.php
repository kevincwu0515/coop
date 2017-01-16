<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/php/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
$userid = getUserId();

if (!empty($_GET["d"])) {
    $postid = htmlspecialchars($_GET["d"]);
    $sql = "DELETE FROM `postings` WHERE `id`=$postid;";
    $conn->query($sql);
    sendPopup("Post Deleted!");
}
?>
<html>
    <head>
        <!-- Title -->
        <title>Coop System Management</title>
        <!-- Page Icon -->
        <link rel="shortcut icon" href="/includes/images/icon.ico" type="images/x-icon" />
        <!-- CSS Stylesheet -->
        <link rel="stylesheet" href="/css/table.css" type="text/css" media="screen" />

    </head>

    <body>
        <!-- Header -->
        <?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/layout/header.php"); ?>
        <!-- Body -->
        <div class="section">
            <table>
                <thead>
                    <tr>
                        <th>Id:</th>
                        <th>Job Title:</th>
                        <th>Number of Application(s):</th>
                        <th>Action:</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <?php
                        $sql = "SELECT * FROM `postings` where `accid`=$userid";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $postid = $row["id"];
                                $count = getTotalAppNum($postid);
                                ?>
                            <tr>
                                <td><?php echo $row["id"]; ?>.</td>

                                <td><b><?php echo $row["title"]; ?>.</b></td>
                                <td><?php echo $count; ?>.</td>

                                <td width="120px">
                                    <a href="sub/appdetails.php?id=<?php echo $row["id"]; ?>" style="text-decoration: none;">
                                        <input type="button" value="View Detail" style="width:90px;height:30px;margin-left: 10px;" />
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>

            </table>
        </div>
        <!-- Footer -->
        <?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/layout/footer.php"); ?>
    </body>

</html>

<?php

function getTotalAppNum($postid) {
    $stmt = "SELECT * FROM `applications` where `postid`=$postid;";
    global $conn;
    $result = $conn->query($stmt);
    $totalApp = $result->num_rows;
    return $totalApp;
}
?>