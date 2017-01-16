<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/php/functions.php';
$userid = getUserId();

$postid = htmlspecialchars($_GET["id"]);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentid = htmlspecialchars($_GET["sid"]);
    $status = getIdByAction($_POST['action']);
    $update_app_status = "UPDATE `applications` SET `status`=$status WHERE `postid` = $postid AND `studentid` = $studentid;";
    echo $update_app_status;
    if ($conn->query($update_app_status)) {
        if ($status == 3)
            sendPopup("Student successfully accepted.");
        else if ($status == 4)
            sendPopup("Student successfully declined.");
    }
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
            <h1>Post</h1>
            <table>
                <thead>
                    <tr>
                        <th>Id:</th>
                        <th>Job Title:</th>
                        <th>Posted Date:</th>
                        <th>End Day:</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>

                        <?php
                        $sql = "SELECT * FROM `postings` WHERE `id` = $postid ";
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
                            </tr>
                            <?php
                        }
                    }
                    ?>

                </tbody>
            </table>
            <h1>Student</h1>
            <table>
                <thead>
                    <tr>
                        <th>App Number:</th>
                        <th>Name:</th>
                        <th>Apply Time:</th>
                        <th>Resume:</th>
                        <th>Status:</th>
                        <th>Action:</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>

                        <?php
                        $sql = "SELECT * FROM `applications` JOIN profiles ON `studentid` = accid WHERE `postid` = $postid ;";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $appid = $row['id'];
                                $studentid = $row['studentid'];
                                $studentname = $row['firstname'] . " " . $row['lastname'];
                                $applytime = $row['applytime'];
                                ?>
                            <tr>

                                <td style="text-align: center"><?php echo $appid; ?></td>
                                <td style="text-align: center"><?php echo $studentname; ?></td>
                                <td style="text-align: center"><?php echo $applytime; ?></td>
                                <td style="text-align: center"><a href = "/pages/viewprofile.php?id=<?php echo $row["studentid"]; ?>">Click Here</a></td>
                                <td style="text-align: center"><?php echo getStatusById($row['status']); ?></td>
                                <td>
                                    <a href="scheduleinterview.php?id=<?php echo $row["id"]; ?>&s=<?php echo $row["studentid"]; ?>" style="text-decoration: none;">
                                        <button style="width: 80px;height:40px;vertical-align:top;">Schedule Interview</button>
                                    </a>
                                    <form style="display:inline-block;" method="POST" action="/pages/employer/sub/appdetails.php?id=1&sid=<?php echo $studentid; ?>">
                                        <input type="submit" style="width: 80px;height:40px;" name="action"  value="Accept"/>
                                        <input type="submit" style="width: 80px;height:40px;" name="action" value="Decline"/>
                                    </form>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>

                </tbody>
            </table>

            <h1>Interview</h1>
            <table>
                <thead>
                    <tr>
                        <th>Name:</th>
                        <th>Time:</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>

                        <?php
                        $sql = "SELECT * FROM `interviewtime` INNER JOIN `profiles` ON `studentid` = `accid` WHERE `postid` = $postid AND status = 1;";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $studentname = $row['firstname'] . " " . $row['lastname'];
                                $interviewtime = date("M d, Y - G:i a", strtotime($row["time"]));
                                ?>
                            <tr>

                                <td style="text-align: center"><?php echo $studentname; ?></td>
                                <td style="text-align: center"><?php echo $interviewtime; ?></td>
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

function getIdByAction($action) {
    if ($action == "Accept") {
        return 3;
    } else if ($action == "Decline") {
        return 4;
    }
}
