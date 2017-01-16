<!-- import javascript -->
<script src="/js/index.js"></script>

<button onclick="goBack()" style="margin:15px 15px 15px 15px;">Go Back</button>


<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/php/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

$id = htmlspecialchars($_GET["id"]);
$acctype = getUsertypeById($id);

if ($acctype != 1 && $acctype != 2) {
    echo "Profile does not exist!";
    return;
}

global $conn;

$sql = "SELECT * FROM `profiles` WHERE accid = " . $id;
$result = $conn->query($sql);
if ($result->num_rows == 1) {
    getProfile($id, $acctype);
} else {
    echo "Profile does not exist!";
    return;
}

function getProfile($id, $acctype) {
    $sql = "SELECT * FROM `profiles` WHERE accid = $id";
    global $conn;
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $fname = $row['firstname'];
    $lname = $row['lastname'];
    /* Address Info */
    $address = $row['address'];
    $city = $row['city'];
    $province = $row['province'];
    $addresscode = $row['postalcode'];
    $country = $row['country'];
    /* Contact Info */
    $pnumber = $row['phonenumber'];
    $email = $row['email'];
    $website = $row['website'];
    $twitter = $row['twitter'];

    /* Profile Info */
    $profile_p1 = $row['profile_p1'];
    $profile_p2 = $row['profile_p2'];

    /* Social Media */
    $linkedin = $row['linkedin'];
    $github = $row['github'];
    $facebook = $row['facebook'];
    $googleplus = $row['googleplus'];
    $instagram = $row['instagram'];

    if (isStudent($acctype)) {
        $occupation = $row['occupation'];
        $department = $row['department'];
        $schoolyear = $row['schoolyear'];
    } else if (isEmployer($acctype)) {
        $cname = $row['companyname'];
        $fnumber = $row['faxnumber'];
    }
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <title> Profile of <?php echo $fname . " " . $lname; ?> </title>
            <!--CSS Stylesheet -->
            <link rel = "stylesheet" type = "text/css" href = "/css/profile.css" />
        </head>
        <body>

            <div id = "wrapper">
                <div id = "content">
                    <header>
                        <section id = "contact-details">
                            <div class = "header_1">
                                <?php
                                $profilepic = "/uploads/profile/" . $id . "-icon.png";
                                if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $profilepic)) {
                                    $profilepic = "/uploads/profile/" . "default_profile.jpg";
                                }
                                ?>
                                <img src = "<?php echo $profilepic ?>" width = "250" height = "250" alt = "Your Name" />
                            </div>
                            <div class = "header_2">
                                <h1>
                                    <span>
                                        <?php
                                        if (isStudent($acctype)) {
                                            echo $fname . " " . $lname;
                                        } else if (isEmployer($acctype)) {
                                            echo $cname;
                                        }
                                        ?>
                                    </span>
                                </h1>
                                <h3>
                                    <?php
                                    if (isStudent($acctype)) {
                                        echo "$occupation";
                                        if (!empty($department))
                                            echo "<br /><font style=\"font-size: 22px;font-style: normal;\">Department of " . getDepartmentById($department);
                                        if (!empty($schoolyear))
                                            echo "<br /> year $schoolyear</font>";
                                    } else if (isEmployer($acctype)) {
                                        echo "$fname $lname";
                                    }
                                    ?>
                                </h3>
                                <ul class = "info">
                                    <li class = "address">
                                        <?php echo $address . ", " . $city . ", " . $province . ", " . $country; ?>
                                    </li>
                                    <li>
                                        <?php echo "$pnumber"; ?>
                                    </li>
                                    <li><a href = "mailto:<?php echo $email; ?>"><?php echo $email; ?></a></li>
                                    <li><a href = "<?php echo "http://$website"; ?>"><?php echo $website; ?></a></li>
                                    <li><a href = "https://twitter.com/<?php echo $twitter; ?>" title = "Follow Me on Twitter">@<?php echo $twitter; ?></a></li>
                                    <?php
                                    if (isStudent($acctype)) {
                                        echo "<li>"
                                        . "<a href = \"/pages/viewfile.php?type=r&id=$id\">View resume</a>"
                                        . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                                        . "<a href = \"/pages/viewfile.php?type=t&id=   $id\">View transcript</a>"
                                        . "</li>";
                                    }
                                    ?>
                                </ul>
                            </div>
                        </section>
                    </header>

                    <div class = "clear">&nbsp;
                    </div>
                    <dl>
                        <!--<dd>-->

                        <p style="margin-left: 15px;font-size: 22px;font-style: normal;">
                            <b>
                                <?php
                                if ($acctype == 1) {
                                    echo "Student's Objective/goal:";
                                } else if ($acctype == 2) {
                                    echo "About the company:";
                                }
                                ?>
                            </b>
                        </p>

                        <p style="margin-left: 60px;margin-right: 60px;">
                            <?php echo $profile_p1; ?>
                        </p>

                        <p style="margin-left: 15px;font-size: 22px;font-style: normal;">
                            <b>
                                <?php
                                if ($acctype == 1) {
                                    echo "About Student:";
                                } else if ($acctype == 2) {
                                    echo "what we are looking:";
                                }
                                ?>
                            </b>
                        </p>

                        <p style="margin-left: 60px;margin-right: 60px;">
                            <?php echo $profile_p2; ?>
                        </p>
                    </dl>

                    <div class = "clear">&nbsp;
                    </div>

                    <footer id = "footer">
                        <!--Begin Footer Content -->
                        <div class = "footer_content">
                            <!--Begin Schema Person -->
                            <ul class = "icons_1">
                                <li><a href = "<?php echo $linkedin; ?>" title = "LinkedIn"><img src = "/includes/images/profile/linkedin.png" width = "32" height = "32" alt = "LinkedIn" /></a></li>
                                <li><a href = "<?php echo $github; ?>" title = "Github"><img src = "/includes/images/profile/github.png" width = "32" height = "32" alt = "Github" /></a></li>
                                <li><a href = "<?php echo $facebook; ?>" title = "Facebook"><img src = "/includes/images/profile/facebook.png" width = "32" height = "32" alt = "Facebook" /></a></li>
                                <li><a href = "<?php echo $googleplus; ?>" title = "Googleplus"><img src = "/includes/images/profile/googleplus.png" width = "32" height = "32" alt = "GooglePlus" /></a></li>
                                <li><a href = "<?php echo $instagram; ?>" title = "Instagram"><img src = "/includes/images/profile/instagram.png" width = "32" height = "32" alt = "Instagram" /></a></li>
                            </ul>
                        </div>
                    </footer>
                </div>
            </div>
        </body>
    </html>
    <?php
}
?>