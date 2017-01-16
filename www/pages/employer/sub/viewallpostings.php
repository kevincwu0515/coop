<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/php/functions.php';
$userid = getUserId();

if (!empty($_GET["d"])) {
    $postid = htmlspecialchars($_GET["d"]);
    $sql = "DELETE FROM `postings` WHERE `id` = $postid;";
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
                        <th>Posted Date:</th>
                        <th>End Day:</th>
                        <th>Option:</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>

                        <?php
                        $sql = "SELECT * FROM `postings` where `accid`='$userid'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                            <tr>
                                <td><?php echo $row["id"]; ?></td>

                                <td><b><?php echo $row["title"]; ?></b></td>
                                <?php $postdate = date("M d, Y", strtotime($row["postdate"])); ?>
                                <td><?php echo $postdate; ?></td>
                                <?php $endTime = date("M d, Y", strtotime($row["enddate"])); ?>
                                <td><?php echo $endTime; ?></td>

                                <td width="130px">
                                    <a href="editposting.php?id=<?php echo $row["id"]; ?>" style="text-decoration: none;">
                                        <input type="button" value="Edit" style="width:60px;height:25px;" />
                                    </a>
                                    <a href="viewallpostings.php?d=<?php echo $row["id"]; ?>" style="text-decoration: none;">
                                        <input type="button" name="postid" value="Delete" style="width:60px;height:25px;"/>
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