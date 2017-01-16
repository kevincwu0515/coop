<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/php/functions.php';
$userid = getUserId();
?>
<html>
    <head>
        <!-- Title -->
        <title>Coop System Management</title>
        <!-- Page Icon -->
        <link rel="shortcut icon" href="/includes/images/icon.ico" type="images/x-icon" />
        <!-- CSS Stylesheet -->
        <link rel="stylesheet" href="/css/table.css" type="text/css" media="screen" />
    </head>


    <body>
        <!-- Header -->
        <?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/layout/header.php"); ?>

        <!-- Personal Information section -->
        <div class="section">
            <table>
                <thead>
                    <tr>
                        <th>Job Title:</th>
                        <th>Employer:</th>
                        <th>Apply Date:</th>
                        <th>Status:</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <?php
                        $sql = "SELECT * FROM applications a INNER JOIN postings pt ON a.postid = pt.id INNER JOIN profiles pr ON pt.accid = pr.accid WHERE  studentid='$userid'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $postid = $row["postid"];
                                $apply = date("F d, Y", strtotime($row["applytime"]));
                                $companyname = $row['companyname'];
                                ?>
                            <tr>
                                <td><?php echo $row["title"]; ?></td>
                                <td><?php echo $companyname; ?> </td>
                                <td><?php echo $apply; ?></td>
                                <td><?php echo getStatusById($row["status"]); ?></td>
                                <td width="260px">
                                    <a href="/pages/detail.php?input=<?php echo $postid ?>" style="text-decoration: none;">
                                        <button style="width: 80px;height:40px;vertical-align:top;">View Post</button>
                                    </a>
                                    <a href="" style="text-decoration: none;">
                                        <button style="width: 80px;height:40px;vertical-align:top;">Cancel</button>
                                    </a>
                                    <a href="/pages/student/sub/selectinterview.php?pid=<?php echo $postid; ?>" style="text-decoration: none;">
                                        <button style="width: 80px;height:40px;vertical-align:top;">Schedule Interview</button>
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>

            </table>
        </div>

        <!-- Footer -->
        <?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/layout/footer.php"); ?>
    </body>
</html>