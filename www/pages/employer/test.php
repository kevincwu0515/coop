<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/php/functions.php';
$userid = getUserId();

//$postid = htmlspecialchars($_GET["id"]);
//$studentid = htmlspecialchars($_GET["s"]);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    for ($i = 1; $i <= 5; $i++) {
        $month = $_POST["month$i"];
        $day = $_POST["day$i"];
        $year = $_POST["year$i"];

        $hour = $_POST["hour$i"];
        $minute = $_POST["minute$i"];
        $period = $_POST["period$i"];
        if (!empty($month) && !empty($day) && !empty($year) && !empty($hour) && !empty($minute) && !empty($period)) {
            echo "$i <br />";
            echo "$month $day $year $hour $minute $period <br />";
            echo "Student: $studentid";
        }
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
        <!-- Body -->
        <div class="section">

            <!-- Body -->
            <section id="sign-up">
                <div class="inner">
                    <section class="entry-content sign-up">

                        <form class="form" method="POST" action="scheduleinterview.php?id=<?php echo $postid ?>&s=<?php echo $studentid; ?>">

                            <?php
                            for ($i = 1; $i <= 5; $i++) {
                                ?>
                                <fieldset style="margin-top: 20px;padding-bottom: 25px">

                                    <legend style="margin-left: 10px;">Interview Time <?php echo $i; ?>.</legend>

                                    <div>
                                        <span class="box_">
                                            <label style="margin-left: 75px;">Date:</label>
                                            <select class="box_date" name="month<?php echo $i; ?>" style="margin-left: 100px;">
                                                <option value=""></option>
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
                                            <select class="box_date" name="day<?php echo $i; ?>">
                                                <option value=""></option>
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
                                            <select class="box_date" name="year<?php echo $i; ?>">
                                                <option value=""></option>
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


                                    <div>                                    
                                        <span class="box_">
                                            <label style="margin-left: 75px;">Time:</label>
                                            <select class="box_date" name="hour<?php echo $i; ?>" style="margin-left: 100px;">
                                                <option value=""></option>
                                                <option value="01">01:</option>
                                                <option value="02">02:</option>
                                                <option value="03">03:</option>
                                                <option value="04">04:</option>
                                                <option value="05">05:</option>
                                                <option value="06">06:</option>
                                                <option value="07">07:</option>
                                                <option value="08">08:</option>
                                                <option value="09">09:</option>
                                                <option value="10">10:</option>
                                                <option value="11">11:</option>
                                                <option value="12">12:</option>
                                            </select>
                                            <select class="box_date" name="minute<?php echo $i; ?>">
                                                <option value=""></option>
                                                <option value="00">00</option>
                                                <option value="15">15</option>
                                                <option value="30">30</option>
                                                <option value="45">45</option>
                                            </select>
                                            <select class="box_date" name="period<?php echo $i; ?>">
                                                <option value=""></option>
                                                <option value="AM">AM</option>
                                                <option value="PM">PM</option>
                                            </select>
                                        </span>
                                    </div>
                                </fieldset>
                                <?php
                            }
                            ?>

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