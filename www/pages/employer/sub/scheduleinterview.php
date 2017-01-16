<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
?>
<?php
$postid = htmlspecialchars($_GET["id"]);
$studentid = htmlspecialchars($_GET["s"]);
$insert_result = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    for ($i = 1; $i <= 5; $i++) {
        if (!empty($_POST["date$i"]) && !empty($_POST["time$i"])) {
            $check = "SELECT * FROM `interviewtime` WHERE `postid` = $postid AND `studentid` = $studentid AND `interviewnumber` = $i;";
            $result = $conn->query($check);
            if ($result->num_rows == 0) {

                $datestamp = date('Y-m-d', strtotime($_POST["date$i"]));
                $timestamp = date("G:i:00", strtotime($_POST["time$i"]));

                $time = "$datestamp $timestamp";



                $sql = "INSERT INTO `interviewtime` (`interviewnumber`, `postid`, `studentid`, `time`) VALUES ('$i', '$postid', '$studentid','$time');";
                if ($conn->query($sql)) {
                    $insert_result = $insert_result . "Interview time $i scheduled on " . $_POST["date$i"] . " at " . $_POST["time$i"] . "<br /><br />";
                    $update_app_status = "SELECT status FROM applications WHERE postid = $postid AND studentid = $studentid;";
                    $result = $conn->query($update_app_status);
                    if ($row = $result->fetch_assoc()) {
                        if ($row["status"] == 0) {
                            $update_app_status = "UPDATE applications SET status=1 WHERE postid = $postid AND studentid = $studentid;";
                            $conn->query($update_app_status);
                        }
                    }
                }
            }
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
        <!-- -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

        <script src="https://jonthornton.github.io/jquery-timepicker/jquery.timepicker.js"></script>
        <link rel="stylesheet" type="text/css" href="https://jonthornton.github.io/jquery-timepicker/jquery.timepicker.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.standalone.css" />

    </head>

    <body>
        <!-- Header -->
        <?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/layout/header.php"); ?>
        <!-- Body -->
        <div class="section">
            <?php
            if (!empty($insert_result)) {
                echo $insert_result;
            }
            ?>
            <!-- Body -->
            <section class="sign-up">
                <form class="form" method="POST" action="">
                    <?php
                    $i = 1;
                    for ($i; $i <= 5; $i++) {
                        $stmt = "SELECT * FROM `interviewtime` WHERE postid = $postid AND studentid = $studentid AND interviewnumber = $i;";
                        $result = $conn->query($stmt);
                        if ($row = $result->fetch_assoc()) {
                            $interviewtime = $row["time"];
                            $date = date('Y-m-d', strtotime($interviewtime));
                            $time = date("G:ia", strtotime($interviewtime));
                            ?>
                            <fieldset style="margin-top: 20px;padding-bottom: 25px">
                                <legend style="margin-left: 10px;">Interview Time <?php echo $i; ?></legend>
                                <p style="margin-top: 15px;margin-left: 40px">
                                    Date:<input type="text" class="date" value="<?php echo $date; ?>" disabled/>
                                    Time:<input type="text" class="time" value="<?php echo $time ?>" disabled/>
                                </p>
                            </fieldset>
                            <?php
                        } else {
                            ?>
                            <fieldset style="margin-top: 20px;padding-bottom: 25px">

                                <legend style="margin-left: 10px;">Interview Time <?php echo $i; ?></legend>
                                <p id="anchorExample" style="margin-top: 15px;margin-left: 40px">
                                    Date:<input type="text" class="date" name="date<?php echo $i; ?>"/>
                                    Time:<input type="text" class="time" name="time<?php echo $i; ?>"/>
                                </p>
                            </fieldset>
                            <?php
                        }
                    }
                    ?>
                    <div>
                        <input type="submit"/>
                    </div>
                </form>
            </section>


        </div>
        <!-- Footer -->
        <?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/layout/footer.php"); ?>
    </body>

</html>


<script>
    $('#anchorExample .time').timepicker({
        'timeFormat': 'g:ia'
    });

    $('#anchorExample .date').datepicker({
        'format': 'M d yyyy',
        'autoclose': true
    });

    var anchorExampleEl = document.getElementById('anchorExample');
    var anchorDatepair = new Datepair(anchorExampleEl, {
        anchor: $('#anchorSelect').val()
    });
</script>