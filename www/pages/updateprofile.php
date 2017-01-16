<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/php/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

$userid = getUserId();
$acctype = getUsertypeById($userid);

$sql = "SELECT * FROM `profiles` WHERE `accid` = '$userid'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    //profile does not exist add new profile.
    $conn->query("INSERT INTO profiles (accid) VALUES ('$userid');");
} else if ($result->num_rows == 1) {
    //function getUserProfile
    $sql = "SELECT * FROM `profiles` WHERE `accid` = $userid;";
    global $conn;
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $houseaddress = "";
    if (!empty($_POST['housenumber']) && !empty($_POST['streetname'])) {
        $houseaddress = $_POST['housenumber'] . " " . $_POST['streetname'];
    }
    $array = array(
        /* Rest */
        //Personal Information
        array($_POST['firstname'], "firstname"),
        array($_POST['lastname'], "lastname"),
        //Personal Information
        array($houseaddress, "address"),
        array($_POST['city'], "city"),
        array($_POST['province'], "province"),
        array($_POST['postalcode'], "postalcode"),
        array($_POST['country'], "country"),
        //Contact Information
        array($_POST['email'], "email"),
        array($_POST['phonenumber'], "phonenumber"),
        array($_POST['website'], "website"),
        //Social Media Information
        array($_POST['twitter'], "twitter"),
        array($_POST['linkedin'], "linked"),
        array($_POST['github'], "github"),
        array($_POST['facebook'], "facebook"),
        array($_POST['googleplus'], "googleplus"),
        array($_POST['instagram'], "instagram"),
        //Summary
        array($_POST['profile_p1'], "profile_p1"),
        array($_POST['profile_p2'], "profile_p2")
    );
    $sql = "SET ";
    foreach ($array as $arr) {
        if (!empty($arr[0])) {
            $sql = "$sql $arr[1] = \"$arr[0]\", ";
        }
    }
    /* Employee Only */
    $extra = array();
    if ($acctype == 1) {
        $extra = array(
            array($_POST['occupation'], "occupation"),
            array($_POST['department'], "department"),
            array($_POST['schoolyear'], "schoolyear")
        );
    } else if ($acctype == 2) {
        $extra = array(
            /* Employer Only */
            array(
                $_POST['companyname'], "companyname")
        );
    }
    foreach ($extra as $arr) {
        if (!empty($arr[0])) {
            $sql = "$sql $arr[1] = \"$arr[0]\", ";
        }
    }

    $sql = substr($sql, 0, -2); // remove the last 2 character

    $sql = "UPDATE profiles  $sql WHERE `accid` = '$userid';";
    if ($conn->query($sql)) {
        sendPopup("profile successfully updated!");
    } else {
        sendPopup("something went wrong, please try again!");
    }
//    echo $sql;
}
?>
<html>
    <head>
        <title>Coop System Management</title>
        <!-- Page Icon -->
        <link rel="shortcut icon" type="images/x-icon" href="/images/cms.ico" />
        <!-- CSS Stylesheet -->
        <link href="/css/updateprofile.css" rel="stylesheet" type="text/css" />
    </head>


    <body>
        <!-- Header -->
        <?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/layout/header.php"); ?>


        <!-- Body -->
        <div class="section">

            <?php
            if (!empty($row)) {
                ?>
                <section id="sign-up">
                    <div class="inner">
                        <section class="entry-content sign-up">
                            <form class="form" method="POST" action="?">

                                <fieldset style="margin-top: 50px;padding-bottom: 25px">
                                    <legend style="margin-left: 10px;">Personal Information</legend>
                                    <?php
                                    if ($acctype == 2) {
                                        ?>
                                        <div>
                                            <span class="box_">
                                                <label>Company Name:</label>
                                                <input class="box" name="companyname" placeholder="<?php echo $row['companyname']; ?>"/>
                                            </span>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <div>
                                        <span class="box_left">
                                            <label>First Name:</label>
                                            <input class="box" name="firstname" placeholder="<?php echo $row['firstname']; ?>"/>
                                        </span>
                                        <span class="box_right">
                                            <label>Last Name:</label>
                                            <input class="box" name="lastname" placeholder="<?php echo $row['lastname']; ?>" />
                                        </span>
                                    </div>

                                    <?php
                                    if ($acctype == 1) {
                                        ?>
                                        <div>
                                            <span class="box_">
                                                <label>Occupation:</label>
                                                <input class="box" name="occupation" placeholder="<?php echo $row['occupation']; ?>"/>
                                            </span>
                                            <span class="box_left">
                                                <label>Department:</label>
                                                <select class="box" name="department">
                                                    <option value="<?php echo $row['department']; ?>"><?php echo getDepartmentById($row['department']); ?></option>
                                                    <option value="1">Arts</option>
                                                    <option value="2">Business Administration</option>
                                                    <option value="3">Computer Science</option>
                                                    <option value="4">Mathematics and Statistics</option>
                                                    <option value="5">Nursing</option>
                                                    <option value="6">Social Sciences</option>
                                                </select>
                                            </span>
                                            <span class="box_right">
                                                <label>School Year:</label>
                                                <select class="box" name="schoolyear">
                                                    <option value="<?php echo $row['schoolyear']; ?>"><?php echo $row['schoolyear']; ?></option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                </select>
                                            </span>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                </fieldset>

                                <fieldset style="margin-top: 50px; padding-bottom: 25px">
                                    <legend style="margin-left: 10px;">Address Information</legend>
                                    <?php
                                    $address = explode(" ", $row['address']);
                                    ?>
                                    <div>
                                        <span class="box_left">
                                            <label>House Number:</label>
                                            <input class="box" name="housenumber" placeholder="<?php if (is_numeric($address[0])) echo $address[0]; ?>"/>
                                        </span>
                                        <span class="box_right">
                                            <label>Street Name:</label>
                                            <input class="box"  name="streetname" placeholder="<?php
                                            if (!empty($address[1]))
                                                echo $address[1];
                                            if (!empty($address[2]))
                                                echo " " . $address[2];
                                            ?>"/>
                                        </span>
                                    </div>

                                    <div>
                                        <span class="box_left">
                                            <label>City:</label>
                                            <input class="box" name="city" placeholder="<?php echo $row['city']; ?>"/>
                                        </span>
                                        <span class="box_right">
                                            <label>Postal Code:</label>
                                            <input class="box" name="postalcode" placeholder="<?php echo $row['postalcode']; ?>"/>
                                        </span>
                                    </div>

                                    <div>
                                        <span class="box_left">
                                            <label>Province:</label>
                                            <input class="box" name="province" placeholder="<?php echo $row['province']; ?>"/>
                                        </span>
                                        <span class="box_right">
                                            <label>Country:</label>
                                            <input class="box" name="country" placeholder="<?php echo $row['country']; ?>"/>
                                        </span>
                                    </div>

                                </fieldset>

                                <fieldset style="margin-top: 50px; padding-bottom: 25px">
                                    <legend style="margin-left: 10px;">Contact Information</legend>

                                    <div>
                                        <span class="box_">
                                            <label>Email Address:</label>
                                            <input class="box" name="email" placeholder="<?php echo $row['email']; ?>"/>
                                        </span>
                                    </div>

                                    <div>
                                        <span class="box_left">
                                            <label>Phone Number:</label>
                                            <input class="box" name="phonenumber" placeholder="<?php echo $row['phonenumber']; ?>"/>
                                        </span>
                                        <span class="box_right">
                                            <label>Website:</label>
                                            <input class="box"  name="website" placeholder="<?php echo $row['website']; ?>"/>
                                        </span>
                                    </div>

                                </fieldset>

                                <fieldset style="margin-top: 50px; padding-bottom: 25px">
                                    <legend style="margin-left: 10px;">Social Media Information</legend>

                                    <div>
                                        <span class="box_">
                                            <label>Twitter Username:</label>
                                            <input class="box"  name="twitter" placeholder="<?php echo $row['twitter']; ?>"/>
                                        </span>
                                    </div>

                                    <div>
                                        <span class="box_left">
                                            <label>Linkedin link:</label>
                                            <input class="box" name="linkedin" placeholder="<?php echo $row['linkedin']; ?>"/>
                                        </span>
                                        <span class="box_right">
                                            <label>Github link:</label>
                                            <input class="box" name="github" placeholder="<?php echo $row['github']; ?>"/>
                                        </span>
                                    </div>

                                    <div>
                                        <span class="box_left">
                                            <label>Facebook link:</label>
                                            <input class="box" name="facebook" placeholder="<?php echo $row['facebook']; ?>"/>
                                        </span>
                                        <span class="box_right">
                                            <label>Googleplus link:</label>
                                            <input class="box" name="googleplus" placeholder="<?php echo $row['googleplus']; ?>"/>
                                        </span>
                                    </div>

                                    <div>
                                        <span class="box_left">
                                            <label>Instagram link:</label>
                                            <input class="box" name="instagram" placeholder="<?php echo $row['instagram']; ?>"/>
                                        </span>
                                    </div>
                                </fieldset>

                                <fieldset style="margin-top: 50px; padding-bottom: 25px">
                                    <legend style="margin-left: 10px;">Summary</legend>

                                    <div>
                                        <span class="box_">
                                            <label>
                                                <?php
                                                if ($acctype == 1) {
                                                    echo "What is your objective/goal?";
                                                } else if ($acctype == 2) {
                                                    echo "Describe your company:";
                                                }
                                                ?>
                                            </label>
                                            <textarea class="big_box" name="profile_p1" placeholder="<?php echo $row['profile_p1']; ?>"></textarea>
                                        </span>
                                        <span class="box_">
                                            <label>
                                                <?php
                                                if ($acctype == 1) {
                                                    echo "Describe yourself:";
                                                } else if ($acctype == 2) {
                                                    echo "What kind of employee are you looking for?";
                                                }
                                                ?>
                                            </label>
                                            <textarea class="big_box"  name="profile_p2" placeholder="<?php echo $row['profile_p2']; ?>"></textarea>
                                        </span>
                                    </div>

                                </fieldset>

                                <div>
                                    <input type="submit" style="margin-top: 50px;"/>
                                </div>
                            </form>
                        </section>
                    </div>
                </section>
                <?php
            } else {
                echo "Your new profile has been added to the page. Please reload the page.";
            }
            ?>
        </div>

        <!-- Footer -->
        <?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/layout/footer.php"); ?>
    </body>
</html>
