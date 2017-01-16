<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/php/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

$userid = getUserId();


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $houseaddress = $_POST['housenumber'] . " " . $_POST['streetname'];

    $day = $_POST['year'] . "-" . $_POST['month'] . "-" . $_POST['day'] . " 00:00:00";

    $array = array(
        array($_POST['jobtitle'], "title"),
        array($houseaddress, "address"),
        array($_POST['city'], "city"),
        array($_POST['province'], "province"),
        array($_POST['postalcode'], "postalcode"),
        array($_POST['country'], "country"),
        array($_POST['department'], "department"),
        array($_POST['schoolyear'], "schoolyear"),
        array($_POST['salary'], "salary"),
        array($day, "enddate"),
        array($_POST['description'], "description")
    );
    $sql = "INSERT INTO postings (accid, ";
    $allow = true;
    foreach ($array as $arr) {
        if (empty($arr[1])) {
            $allow = false;
        }
    }
    if (!$allow) {
        sendPopup("Unable to submite a new posting. Make sure all the fields must be filled correct!!");
    } else if ($allow) {
        foreach ($array as $arr) {
            $sql = $sql . $arr[1] . ", ";
        }
        $sql = substr($sql, 0, -2); // remove the last 2 character
        $sql = $sql . ") VALUES ('$userid', ";

        foreach ($array as $arr) {
            $sql = $sql . "'" . $arr[0] . "', ";
        }
        $sql = substr($sql, 0, -2); // remove the last 2 character
        $sql = $sql . ");";
        echo $sql;
        if ($conn->query($sql)) {
            sendPopup("New posting successfully submitted!");
        } else {
            sendPopup("Something went wrong, please try again!");
        }
    }
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
            <section id="sign-up">
                <div class="inner">
                    <section class="entry-content sign-up">

                        <form class="form" method="POST" action="?">

                            <fieldset style="margin-top: 50px;padding-bottom: 25px">
                                <legend style="margin-left: 10px;">Job Info</legend>

                                <div>
                                    <span class="box_">
                                        <label>Job Title:</label>
                                        <input class="box" name="jobtitle" />
                                    </span>
                                </div>
                            </fieldset>

                            <fieldset style="margin-top: 50px;padding-bottom: 25px">
                                <legend style="margin-left: 10px;
                                        ">Address Information</legend>

                                <div>
                                    <span class="box_left">
                                        <label>House Number:</label>
                                        <input class="box" name="housenumber"/>
                                    </span>
                                    <span class="box_right">
                                        <label>Street Name:</label>
                                        <input class="box"  name="streetname"/>
                                    </span>
                                </div>

                                <div>
                                    <span class="box_left">
                                        <label>City:</label>
                                        <input class="box" name="city"/>
                                    </span>
                                    <span class="box_right">
                                        <label>Postal Code:</label>
                                        <input class="box" name="postalcode"/>
                                    </span>
                                </div>

                                <div>
                                    <span class="box_left">
                                        <label>Province:</label>
                                        <input class="box" name="province"/>
                                    </span>
                                    <span class="box_right">
                                        <label>Country:</label>
                                        <input class="box" name="country"/>
                                    </span>
                                </div>
                            </fieldset>

                            <fieldset style="margin-top: 50px;
                                      padding-bottom: 25px">
                                <legend style="margin-left: 10px;
                                        ">Other Information</legend>

                                <div>
                                    <span class="box_">
                                        <label>Salary: (0 for not available)</label>
                                        <input class="box" name="salary" placeholder="0"/>
                                    </span>
                                </div>
                                <div>
                                    <span class="box_left">
                                        <label>Department:</label>
                                        <select class="box" name="department">
                                            <option value="0">Any</option>
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
                                            <option value="0">Any</option>
                                            <option value="1">Freshman</option>
                                            <option value="2">Sophomore</option>
                                            <option value="3">Junior</option>
                                            <option value="4">Senior</option>
                                            <option value="5">Graduate</option>
                                        </select>
                                    </span>
                                </div>

                                <div>
                                    <span class="box_">
                                        <label>End Date:</label>
                                        <select class="box_date" name="month">
                                            <option value="01">Jan</option>
                                            <option value="02">Feb</option>
                                            <option value="03">Mar</option>
                                            <option value="04">Apr</option>
                                            <option value="05">May</option>
                                            <option value="06">Jun</option>
                                            <option value="07">Jul</option>
                                            <option value="08">Aug</option>
                                            <option value="09">Sep</option>
                                            <option value="10">Oct</option>
                                            <option value="11">Nov</option>
                                            <option value="12">Dec</option>
                                        </select>
                                        <select class="box_date" name="day">
                                            <option value="01">1</option>
                                            <option value="02">2</option>
                                            <option value="03">3</option>
                                            <option value="04">4</option>
                                            <option value="05">5</option>
                                            <option value="06">6</option>
                                            <option value="07">7</option>
                                            <option value="08">8</option>
                                            <option value="09">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                            <option value="14">14</option>
                                            <option value="15">15</option>
                                            <option value="16">16</option>
                                            <option value="17">17</option>
                                            <option value="18">18</option>
                                            <option value="19">19</option>
                                            <option value="20">20</option>
                                            <option value="21">21</option>
                                            <option value="22">22</option>
                                            <option value="23">23</option>
                                            <option value="24">24</option>
                                            <option value="25">25</option>
                                            <option value="26">26</option>
                                            <option value="27">27</option>
                                            <option value="28">28</option>
                                            <option value="29">29</option>
                                            <option value="30">30</option>
                                            <option value="31">31</option>
                                        </select>
                                        <select class="box_date" name="year">
                                            <option value="2016">2016</option>
                                            <option value="2017">2017</option>
                                            <option value="2018">2018</option>
                                            <option value="2019">2019</option>
                                            <option value="2020">2020</option>
                                            <option value="2021">2021</option>
                                            <option value="2022">2022</option>
                                        </select>   
                                    </span>
                                </div>

                            </fieldset>


                            <fieldset style="margin-top: 50px;
                                      padding-bottom: 25px">
                                <legend style="margin-left: 10px;
                                        ">Job Information</legend>

                                <div>
                                    <span class="box_">
                                        <label>Describe the job:</label>
                                        <textarea class="big_box" name="description"></textarea>
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
        </div>

        <!-- Footer -->
        <?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/layout/footer.php"); ?>
    </body>
</html>

