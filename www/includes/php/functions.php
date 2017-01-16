<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

function setUserId($userid) {
    $_SESSION['user_id'] = $userid;
}

function setUserType($acctype) {
    $_SESSION['type'] = $acctype;
}

function getUserId() {
    if (!isset($_SESSION['user_id'])) {
        return 0;
    } else {
        return $_SESSION['user_id'];
    }
}

function getUserType() {
    if (!isset($_SESSION['type'])) {
        return 0;
    } else {
        return $_SESSION['type'];
    }
}

function getTypeId($acctype) {
    if ($acctype == "student") {
        return 1;
    } else if ($acctype == "employer") {
        return 2;
    } else if ($acctype == "instructor") {
        return 3;
    } else if ($acctype == "manager") {
        return 4;
    } else if ($acctype == "admin") {
        return 5;
    }
    return 0;
}

function login($user, $pass, $acctype) {
    global $conn;
    $user = mysqli_real_escape_string($conn, $_POST['user']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);

    $acctype = getTypeId($acctype);

    $stmt = "SELECT id FROM `accounts` WHERE username = '$user' and password = '$pass' and acctype = '$acctype'";

    $result = mysqli_query($conn, $stmt);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if ($count == 0 || $count > 1) {
        return false;
    } else if ($count == 1) {
        setUserType($acctype);
        setUserId($row['id']);
        headToHomePage();
        return true;
    }
}

function headToHomePage() {
    $acctype = getUserType();
    $destiny = "location: /pages/";
    if ($acctype == 1) {
        $destiny = $destiny . "student/home.php";
    } else if ($acctype == 2) {
        $destiny = $destiny . "employer/home.php";
    } else if ($acctype == 3) {
        $destiny = $destiny . "instructor/home.php";
    } else if ($acctype == 4) {
        $destiny = $destiny . "manager/home.php";
    } else if ($acctype == 5) {
        $destiny = $destiny . "admin/home.php";
    }
    header($destiny);
}

function getUsertypeById($targetId) {
    global $conn;
    $sql = "SELECT `acctype` FROM `accounts` WHERE `id` = " . $targetId;
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row["acctype"];
}

function getCompanyNameById($targetId) {
    global $conn;
    $sql = "SELECT `companyname` FROM `profiles` WHERE `accid` = " . $targetId;
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row["companyname"];
}

function isStudent($usertype) {
    if ($usertype == 1) {
        return true;
    } else {
        return false;
    }
}

function isEmployer($usertype) {
    if ($usertype == 2) {
        return true;
    } else {
        return false;
    }
}

function sendPopup($message) {
    echo "<script type='text/javascript'>alert('$message');</script>";
}

function getSchoolYearById($year) {
    if ($year == 0) {
        return "Any";
    } else if ($year == 1) {
        return "Freshman";
    } else if ($year == 2) {
        return "Sophomore";
    } else if ($year == 3) {
        return "Junior";
    } else if ($year == 4) {
        return "Senior";
    } else if ($year == 5) {
        return "Graduate";
    }
    return "";
}

function getDepartmentById($id) {
    if ($id == 0)
        return "Any";
    else if ($id == 1)
        return "Arts";
    else if ($id == 2)
        return "Business Administration";
    else if ($id == 3)
        return "Computer Science";
    else if ($id == 4)
        return "Mathematics and Statistics";
    else if ($id == 5)
        return "Nursing";
    else if ($id == 6)
        return "Social Sciences";
    else
        return "";
}

function getStatusById($id) {
    if ($id == 0) {
        return "Pending";
    } else if ($id == 1) {
        return "Interview Scheduling";
    } else if ($id == 2) {
        return "Interview Time Confirmed";
    } else if ($id == 3) {
        return "Accepted";
    } else if ($id == 4) {
        return "Declined";
    }
}

function getAccountTypeById($id) {
    if ($id == 1) {
        return "Student";
    } else if ($id == 2) {
        return "Employer";
    } else if ($id == 3) {
        return "Instructor";
    } else if ($id == 4) {
        return "Manager";
    } else if ($id == 5) {
        return "System Administrator";
    }
}

function getFullNameById($id) {
    global $conn;
    $sql = "SELECT * FROM `profiles` WHERE `accid` = $id;";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row["firstname"] . " " . $row["lastname"];
}

function getCurrentDate() {
    $now = new DateTime();
    return $now->format('M d, Y');
}

function getTermById($id) {
    if ($id == 1) {
        return "Summer";
    } else if ($id == 2) {
        return "Fall";
    } else if ($id == 3) {
        return "Winter";
    }
}

function getCurrentTerm() {
    if (inSummerTerm()) {
        return "Summer";
    } else if (inFallTerm()) {
        return "Fall";
    } else if (inWinterTerm()) {
        return "Winter";
    }
}

function inSummerTerm() {
    global $conn;
    $sql = "SELECT * FROM `schoolterm` WHERE `id` = 1;";
    $result = $conn->query($sql);
    if ($row = $result->fetch_assoc()) {
        $startdate = date("M d, Y", strtotime($row["startday"]));
        $enddate = date("M d, Y", strtotime($row["endday"]));
        $now = getCurrentDate();
        if (strtotime($now) > strtotime($startdate) && strtotime($now) < strtotime($enddate)) {
            return true;
        }
    }
}

function inFallTerm() {
    global $conn;
    $sql = "SELECT * FROM `schoolterm` WHERE `id` = 2;";
    $result = $conn->query($sql);
    if ($row = $result->fetch_assoc()) {
        $startdate = date("M d, Y", strtotime($row["startday"]));
        $enddate = date("M d, Y", strtotime($row["endday"]));
        $now = getCurrentDate();
        if (strtotime($now) > strtotime($startdate) && strtotime($now) < strtotime($enddate)) {
            return true;
        }
    }
}

function inWinterTerm() {
    global $conn;
    $sql = "SELECT * FROM `schoolterm` WHERE `id` = 3;";
    $result = $conn->query($sql);
    if ($row = $result->fetch_assoc()) {
        $startdate = date("M d, Y", strtotime($row["startday"]));
        $enddate = date("M d, Y", strtotime($row["endday"]));
        $now = getCurrentDate();
        if (strtotime($now) > strtotime($startdate) && strtotime($now) < strtotime($enddate)) {
            return "true";
        }
    }
}

?>
