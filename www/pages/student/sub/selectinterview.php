<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/php/functions.php';
$userid = getUserId();
$postid = htmlspecialchars($_GET["pid"]);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['time'])) {
        $interviewtime = $_POST['time'];
        $sql = "UPDATE `interviewtime` SET `status` = 1 WHERE `interviewnumber` = $interviewtime and postid = $postid;";
        if ($conn->query($sql))
            sendPopup("Interview time successfully selected!");
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
        <link href="/css/updateprofile.css" rel="stylesheet" type="text/css" />
    </head>


    <body>
        <!-- Header -->
        <?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/layout/header.php"); ?>
        <div class="section">
            <h2 style="margin-left: 75px;">Please Select a time frame. </h2>
            <br /> <br />
            <form class="form" method = "POST" action = "<?php echo $_SERVER['REQUEST_URI']; ?>">
                <?php
                $selectedTime = getSelectedTime($postid, $userid);
                $i = 1;
                for ($i; $i <= 5; $i++) {
                    $sql = "SELECT * FROM `interviewtime` WHERE postid = $postid AND studentid = $userid AND interviewnumber = $i;";
                    $result = $conn->query($sql);
                    if ($row = $result->fetch_assoc()) {
                        $timestamp = new DateTime($row['time']);
                        $time = $timestamp->format('M j, Y - g:ia');
                        if ($selectedTime > 0) {
                            if ($selectedTime == $i) {
                                ?>
                                <input style="height:20px; width:20px; vertical-align: middle;margin-left: 150px;" type="radio" name="time" value="<?php echo $i ?>" checked="checked">
                                <?php
                            } else {
                                ?>
                                <input style="height:20px; width:20px; vertical-align: middle;margin-left: 150px;" type="radio" name="time" value="<?php echo $i ?>" disabled>
                                <?php
                            }
                        } else {
                            ?>
                            <input style="height:20px; width:20px; vertical-align: middle;margin-left: 150px;" type="radio" name="time" value="<?php echo $i ?>"/>
                            <?php
                        }
                        echo "<span style=\"font-size:20px\">" . $time . "</span><br /> <br />";
                    }
                }
                ?>
                <div>
                    <input type="submit" style="margin-left:150px;width:150px;height:50px;margin-bottom: 50px;"/>
                </div>   
            </form>
        </div>
        <!-- Footer -->
        <?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/layout/footer.php"); ?>
    </body>
</html>

<?php

function getSelectedTime($postid, $userid) {
    global $conn;
    $sql = "SELECT * FROM `interviewtime` WHERE `postid` = $postid AND `studentid` = $userid AND status = 1;";
    $result = $conn->query($sql);
    if ($row = $result->fetch_assoc()) {
        return $row["interviewnumber"];
    } else {
        return 0;
    }
}
?>