<?php
session_start();
require_once ($_SERVER['DOCUMENT_ROOT'] . '/includes/php/functions.php');

$result = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    for ($i = 1; $i <= 3; $i++) {
        if (!empty($_POST["startdatedate$i"]) && !empty($_POST["enddatedate$i"])) {
            $start = date('Y-m-d', strtotime($_POST["startdatedate$i"]));
            $end = date('Y-m-d', strtotime($_POST["enddatedate$i"]));

            $sql = "UPDATE `schoolterm`  SET `startday` ='$start', `endday` ='$end' WHERE `id` = $i;";

            if ($conn->query($sql)) {
                $result = $result. "Sucessfully updated " . getTermById($i) . " term <br />";
            }else{
                $result = "Error!! <br />";
            }
        }
    }
}
?>
<html>
    <head>
        <link href="/css/updateprofile.css" rel="stylesheet" type="text/css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

        <script src="https://jonthornton.github.io/jquery-timepicker/jquery.timepicker.js"></script>
        <link rel="stylesheet" type="text/css" href="https://jonthornton.github.io/jquery-timepicker/jquery.timepicker.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.standalone.css" />

    </head>

    <body>
        <!-- Header -->
        <?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/layout/header.php"); ?>

        <div class="container" style="margin-top: 200px; min-height: 800px; width:600px;">
            <?php
            if (!empty($result)) {
                echo $result;
            }
            ?>
            <form class="form" method="POST" action="?" style="text-align:center">
                <?php
                for ($i = 1; $i <= 3; $i++) {
                    $sql = "SELECT * FROM `schoolterm` WHERE `id` = $i;";
                    $result = $conn->query($sql);
                    if ($row = $result->fetch_assoc()) {
                        $title;
                        if ($i == 1) {
                            $title = "Summer Term";
                        } else if ($i == 2) {
                            $title = "Fall Term";
                        } else if ($i == 3) {
                            $title = "Winter Term";
                        }
                        $startdate = date("M d, Y", strtotime($row["startday"]));
                        $enddate = date("M d, Y", strtotime($row["endday"]));
                        ?>
                        <fieldset style="margin-top: 20px;padding-bottom: 25px; width:515px;">

                            <legend style="margin-left: 10px;"><?php echo $title; ?></legend>
                            <p id="anchorExample" style="margin-top: 15px;margin-left: 40px">
                                From: <input type="text" class="date" name="startdatedate<?php echo $i; ?>" placeholder="<?php echo $startdate; ?>"/>

                                <span style="margin-left: 25px;">to: </span>
                                <input type="text" class="date" name="enddatedate<?php echo $i; ?>" placeholder="<?php echo $enddate; ?>"/>
                            </p>
                        </fieldset>
                        <?php
                    }
                }
                ?>
                <div>
                    <input type="submit" style="margin-top: 50px;margin-right: 160px"/>
                </div>
            </form>
        </div>
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