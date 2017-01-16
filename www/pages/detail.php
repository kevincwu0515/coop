<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/php/functions.php';

$postid = htmlspecialchars($_GET["input"]);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $userid = getUserId();
    $allow = checkRequirement($userid, $postid);
    if ($allow !== true) {
        sendPopup($allow);
    } else {
        $stmt = "INSERT INTO applications (postid, studentid) VALUES ('$postid', '$userid');";
        $conn->query($stmt);
        sendPopup("You have successfully applied!");
    }
}

$sql = "SELECT * FROM `postings` WHERE `id` = " . $postid;
$result = $conn->query($sql);
?>
<button onclick="goBack()">Go Back</button>

<script>
    function goBack() {
        window.history.back();
    }
</script>
<?php
if ($result->num_rows == 0) {
    echo "ERROR! Posting not exist.";
} else {
    $row = $result->fetch_assoc();
    $employerid = $row["accid"];
    $companyname = getCompanyNameById($employerid);
    $title = $row["title"];
    $description = $row["description"];
    $address = $row["address"];
    $location = $row["city"] . ", " . $row["province"];
    $salary = $row["salary"];
    if ($salary == null || $salary == "0") {
        $salary = "Not Available";
    }
    $postTime = date("F d, Y", strtotime($row["postdate"]));
    $endTime = date("F d, Y", strtotime($row["enddate"]));
    $department = $row["department"];
    $schoolyear = $row["schoolyear"];
    ?>
    <html>
        <header>
            <link href="/css/detail.css" rel="stylesheet" type="text/css" />
        </header>
        <body>
            <div class="section">

                <div style="margin-left: 100px; margin-top: 50px;"> <!-- Title, post date, author -->
                    <h1 style="font-size: 36px;"><?php echo $title; ?></h1>

                    <span style="margin-left: 50px;font-size: 20px;">
                        Posted on: <?php echo $postTime; ?>
                        <span style="margin-left: 150px;">
                            By: 
                            <a href="/pages/viewprofile.php?id=<?php echo $employerid; ?>">
                                <?php echo $companyname; ?>
                            </a>
                        </span>
                    </span>
                </div>
                <hr align="center" width="1000px"/>

                <div style="margin-left: 100px;">
                    <h2 style="font-size: 24px;">Job Details</h2>
                    <div style="vertical-align: middle;">
                        <table >
                            <tr>

                                <td>
                                    <img height="32" width="32" src="/includes/images/posting/map.png"></img> 
                                </td>
                                <td>
                                    <span style="font-size: 18px;">
                                        Location: 
                                        <a href="https://www.google.ca/maps/place/<?php echo $address . " " . $location; ?>"> 
                                            <?php echo $location; ?>
                                        </a>
                                    </span>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <img height="32" width="32" src="/includes/images/posting/salary.png"></img>
                                </td>
                                <td width="400px">
                                    <span style="font-size: 18px;">
                                        Not Available
                                    </span>
                                </td>

                                <td>
                                    <img height="32" width="32" src="/includes/images/posting/calender.png"></img>

                                </td>
                                <td>
                                    <span style="font-size: 18px;">
                                        Not Available
                                    </span>
                                </td>
                            <tr>
                            <tr>
                                <td>
                                    <img height="32" width="32" src="/includes/images/posting/school.png"></img>
                                </td>
                                <td>
                                    <span style="font-size: 18px;">
                                        Not Available
                                    </span>
                                </td>

                                <td>
                                    <img height="32" width="32" src="/includes/images/posting/department.png"></img>

                                </td>
                                <td>
                                    <span style="font-size: 18px;">
                                        Not Available
                                    </span>
                                </td>
                            <tr/>

                        </table>
                    </div>
                </div>
                <hr align="center" width="1000px"/>
                <div style="margin-left: 100px;">
                    <h4 style="font-size: 24px;">Job Description</h4>
                    <div class="jobdesc">
                        <?php echo $description; ?>
                    </div>
                </div>
                <hr align="center" width="1000px"/>
                <form method="POST" action="/pages/detail.php?input=<?php echo $postid; ?>">
                    <button type="submit" style="margin-top: 50px;margin-left: 500px;width:150px; height:50px;">Click Here to Apply</button>
                </form>
            </div>
        </div>
    </body>
    </html>
    <?php
}
?>
<?php

function checkRequirement($userid, $postid) {
    if (isEmployer(getUsertypeById($userid))) {
        return "You can not apply to coop position as an employeer!";
    }
    if (hasApplyBefore($userid, $postid)) {
        return "You already applied to this position!";
    }
    if (!hasAProfile($userid)) {
        return "You need to create a profile first in order to apply for a position!";
    }
    return true;
}

function hasApplyBefore($userid, $postid) {
    global $conn;
    $sql = "SELECT * FROM `applications` WHERE `postid` = $postid AND `studentid` = $userid;";
    $result = $conn->query($sql);
    if ($result->fetch_assoc()) {
        return true;
    } else {
        return false;
    }
}

function hasAProfile($userid) {
    global $conn;
    $sql = "SELECT * FROM `profiles` WHERE accid = " . $userid;
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        return true;
    } else {
        return false;
    }
}
?>