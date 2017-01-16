<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/php/functions.php';
?>
<html>

    <head>
        <title>Coop System Management</title>
        <!-- Page Icon -->
        <link rel="shortcut icon" href="/includes/images/icon.ico" type="images/x-icon" />
        <!-- CSS Stylesheet -->
        <link href="/css/posting.css" rel="stylesheet" type="text/css" />

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script type="text/javascript" src="/includes/js/dropdown.js"></script>
    </head>
    <!-- Body -->
    <body>
        <!-- Header -->
        <?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/layout/header.php"); ?>

        <div class="section">


            <?php
            $userid = $_SESSION['user_id'];
            $usertype = getUsertypeById($userid);

            $type = 0;
            $input = "";
            $sort = 0;
            $dept = 0;
            $sy = 0;
            if (!empty($_GET["type"])) {
                $type = htmlspecialchars($_GET["type"]);
            }

            if (!empty($_GET["input"])) {
                $input = htmlspecialchars($_GET["input"]);
            }

            if (!empty($_GET["sort"])) {
                $sort = htmlspecialchars($_GET["sort"]);
            }

            if (!empty($_GET["dept"])) {
                $dept = htmlspecialchars($_GET["dept"]);
            }
            if (!empty($_GET["sy"])) {
                $sy = htmlspecialchars($_GET["sy"]);
            }
            $sql = "SELECT * FROM postings";

            if (!empty($input)) {// 1 -> t + d  2 -> t only  3-> d only
                if ($type == 1 || empty($type)) {
                    $sql = $sql . " WHERE (title LIKE '%$input%' OR `description` LIKE '%$input%')";
                } else if ($type == 2) {
                    $sql = $sql . " WHERE `title` LIKE '%$input%' ";
                } else if ($type == 3) {
                    $sql = $sql . " WHERE `description` LIKE '%$input%'";
                }
            }


            if (!empty($dept) && $dept != 0) {
                if (empty($input))
                    $sql = $sql . "  WHERE `department` = $dept ";
                else
                    $sql = $sql . "  AND `department` = $dept ";
            }
            
            if (!empty($sy) && $sy != 0) {
                if (empty($dept))
                    $sql = $sql . "  WHERE `schoolyear` = $sy ";
                else
                    $sql = $sql . "  AND `schoolyear` = $sy ";
            }

            if (!empty($sort)) {
                if ($sort == 1) {
                    $sql = $sql . " ORDER BY postdate DESC";
                } else if ($sort == 2) {
                    $sql = $sql . " ORDER BY enddate ASC";
                }
            }
            $result = $conn->query($sql);
            $post_count = 0;
            if ($result) {
                $post_count = $result->num_rows;
            }
            ?>
            <div class="preferbox" style="margin-top: 5px">
                <nav>
                    <h4><?php echo $post_count ?> posting(s) found.</h4>
                    <hr  style="margin-bottom: 15px" />
                    <h4>Search By: </h4>
                    <?php
                    $array = array(array("Title and Description."), array("Title only."), array("Description only."));
                    ?>
                    <ul>
                        <?php
                        $i = 0;
                        foreach ($array as $arr) {
                            $i++;
                            ?>
                            <li <?php if ($arr === reset($array)) echo "style=\"margin-top: 15px\""; ?>>
                                <label style = "display:inline-flex;">
                                    <input type = "radio" class = "radio__input" value = "/pages/posting.php?<?php echo "type=$i" . "&input=$input" . "&sort=$sort" . "&dept=$dept" . "&sy=$sy"; ?>">
                                    <div class = "radio__fill">
                                        <?php
                                        if ($type == 0 && $i == 1)
                                            echo "<span class = \"selected\"></span>";
                                        if ($type == $i)
                                            echo "<span class = \"selected\"></span>";
                                        ?>
                                    </div>
                                    <span class = "preferbox-list-item_label"> <?php echo $arr[0]; ?> </span>
                                </label>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>

                    <hr  style="margin-bottom: 15px" />

                    <h4>Sort By: </h4>

                    <?php
                    $array = array(array("Date posted."), array("End date."));
                    ?>
                    <ul>
                        <?php
                        $i = 0;
                        foreach ($array as $arr) {
                            $i++;
                            ?>
                            <li <?php if ($arr === reset($array)) echo "style=\"margin-top: 15px\""; ?>>
                                <label style = "display:inline-flex;">
                                    <input type = "radio" class = "radio__input" value = "/pages/posting.php?<?php echo "type=$type" . "&input=$input" . "&sort=$i" . "&dept=$dept" . "&sy=$sy"; ?>">
                                    <div class = "radio__fill">
                                        <?php
                                        if ($sort == $i)
                                            echo "<span class = \"selected\"></span>";
                                        ?>
                                    </div>
                                    <span class = "preferbox-list-item_label"> <?php echo $arr[0]; ?> </span>
                                </label>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>


                    <hr style="margin-bottom: 15px"/>

                    <h4>Department:</h4>

                    <?php
                    $array = array(
                        array("Any."),
                        array("Arts."),
                        array("Business Administration."),
                        array("Computer Science."),
                        array("Mathematics and Statistics."),
                        array("Nursing."),
                        array("Social Sciences."));
                    ?>
                    <ul>
                        <?php
                        $i = 0;
                        foreach ($array as $arr) {
                            ?>
                            <li <?php if ($arr === reset($array)) echo "style=\"margin-top: 15px\""; ?>>
                                <label style = "display:inline-flex;">
                                    <input type = "radio" class = "radio__input" value="/pages/posting.php?<?php echo "type=$type" . "&input=$input" . "&sort=$sort" . "&dept=$i". "&sy=$sy"; ?>">
                                    <div class = "radio__fill">
                                        <?php
                                        if ($dept == 0 && $i == 0)
                                            echo "<span class = \"selected\"></span>";
                                        if ($dept == $i)
                                            echo "<span class = \"selected\"></span>";
                                        ?>
                                    </div>
                                    <span class = "preferbox-list-item_label"> <?php echo $arr[0]; ?> </span>
                                </label>
                            </li>
                            <?php
                            $i++;
                        }
                        ?>
                    </ul>
                    <hr style="margin-bottom: 15px" />
                    <h4>School Year:</h4>

                    <?php
                    $array = array(
                        array("Any."),
                        array("Freshman."),
                        array("Sophomore."),
                        array("Junior."),
                        array("Senior."),
                        array("Graduate."));
                    ?>
                    <ul>
                        <?php
                        $i = 0;
                        foreach ($array as $arr) {
                            ?>
                            <li <?php if ($arr === reset($array)) echo "style=\"margin-top: 15px\""; ?>>
                                <label style = "display:inline-flex;">
                                    <input type = "radio" class = "radio__input" value="/pages/posting.php?<?php echo "type=$type" . "&input=$input" . "&sort=$sort" . "&dept=$dept" . "&sy=$i"; ?>">
                                    <div class = "radio__fill">
                                        <?php
                                        if ($sy == 0 && $i == 0)
                                            echo "<span class = \"selected\"></span>";
                                        if ($sy == $i)
                                            echo "<span class = \"selected\"></span>";
                                        ?>
                                    </div>
                                    <span class = "preferbox-list-item_label"> <?php echo $arr[0]; ?> </span>
                                </label>
                            </li>
                            <?php
                            $i++;
                        }
                        ?>
                    </ul>
                    <hr />
                </nav>

                <script type="text/javascript">
                    $('input[type="radio"]').on('click', function () {
                        window.location = $(this).val();
                    });
                </script>
            </div>

            <div class="postingsection">
                <?php
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $title = $row["title"];
                        $postTime = date("F d, Y", strtotime($row["postdate"]));
                        $endTime = date("F d, Y", strtotime($row["enddate"]));
                        $companyname = getCompanyNameById($row["accid"]);
                        $postid = $row["id"];
                        $salary = $row["salary"];
                        $department = $row["department"];
                        $schoolyear = $row["schoolyear"];
                        if ($salary == null || $salary == "0")
                            $salary = "Not Available";
                        $location = $row["city"] . ", " . $row["province"];
                        ?>
                        <a href="/pages/detail.php?input=<?php echo $postid; ?>">
                            <div class="box">
                                <h2><?php echo $title; ?></h2>
                                <br />
                                <font size="4">
                                <span style="margin-left: 30px;">Posted on:  <?php echo $postTime; ?></span>
                                <span style="margin-left: 80px;">By:  <?php echo $companyname; ?></span><br> </br>
                                </font>

                                <table >
                                    <tr>

                                        <td>
                                            <img height="32" width="32" src="/includes/images/posting/map.png"></img> 
                                        </td>
                                        <td>
                                            <span style="font-size: 18px; margin-left: 15px;">
                                                <?php echo $location; ?>
                                            </span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <img height="32" width="32" src="/includes/images/posting/salary.png"></img>
                                        </td>
                                        <td width="400px">
                                            <span style="font-size: 18px; margin-left: 15px;">
                                                <?php echo $salary; ?>
                                            </span>
                                        </td>

                                        <td>
                                            <img height="32" width="32" src="/includes/images/posting/calender.png"></img>

                                        </td>
                                        <td>
                                            <span style="font-size: 18px; margin-left: 15px;">
                                                <?php echo $endTime; ?>
                                            </span>
                                        </td>
                                    <tr>
                                    <tr>
                                        <td>
                                            <img height="32" width="32" src="/includes/images/posting/school.png"></img>
                                        </td>
                                        <td>
                                            <span style="font-size: 18px;margin-left: 15px;">
                                                <?php echo getSchoolYearById($schoolyear); ?>
                                            </span>
                                        </td>

                                        <td>
                                            <img height="32" width="32" src="/includes/images/posting/department.png"></img>

                                        </td>
                                        <td>
                                            <span style="font-size: 18px;margin-left: 15px;">
                                                <?php echo getDepartmentById($department); ?>
                                            </span>
                                        </td>
                                    <tr/>

                                </table>

                            </div>
                        </a>
                        <?php
                    }
                } else {
                    echo "0 results";
                }
                ?>
            </div>
        </div>

        <!-- Footer -->
        <?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/layout/footer.php"); ?>
    </body>

</html>