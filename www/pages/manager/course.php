<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/php/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
?>
<html>
    <head>
    </head>

    <body>
        <!-- Header -->
        <?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/layout/header.php"); ?>

        <div class="container" style="margin-top: 200px; min-height: 640px;">
            <form class="form" method = "POST" action = "/pages/manager/viewstudent.php">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <td><b>School Year</b></td>
                            <td><b>Course Id</b></td>
                            <td><b>Course Name</b></td>
                            <td><b>Instructor</b></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM course;";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><b><?php echo getSchoolYearById($row["year"]); ?></b></td>
                                <td><b><input type="text" name="courseid" value="<?php echo $row["course"]; ?>"/></b></td>
                                <td><b><input type="text" name="coursename" value="<?php echo $row["coursename"]; ?>" /></b></td>
                                <td><b>
                                        <select class="box" name="instructorid">
                                            <option value="<?php echo $row["instructor"]; ?>"><?php echo $row["instructor"] . " - " . getFullNameById($row["instructor"]); ?></option>
                                            <?php
                                            $instructor = "SELECT * FROM `accounts` WHERE `acctype`=3;";
                                            $result2 = $conn->query($instructor);
                                            while ($row2 = $result2->fetch_assoc()) {
                                                ?>
                                                <option value="<?php echo $row2["id"]; ?>"><?php echo $row2["id"] . " - " . getFullNameById($row2["id"]); ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </b></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <input type="Submit" value="Update" />
            </form>
        </div>

        <?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/layout/footer.php"); ?>
    </body>
</html>