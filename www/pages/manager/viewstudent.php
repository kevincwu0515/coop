<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/php/functions.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["id"]))
        $id = $_POST["id"];
    if (!empty($_POST["name"]))
        $name = $_POST["name"];
    if (!empty($_POST["username"]))
        $username = $_POST["username"];
}
?>
<html>
    <head>
    </head>

    <body>
        <!-- Header -->
        <?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/layout/header.php"); ?>


        <div class="container" style="margin-top: 200px; min-height: 800px;">
            <form class="form" method = "POST" action = "/pages/manager/viewstudent.php">
                <span>Search By Student Acc Id: </span>
                <input type="number" name="id" />
                <input type="Submit" />
            </form>
            <form class="form" method = "POST" action = "/pages/manager/viewstudent.php">
                Search By Student Name:
                <input type="text" name="name"/>
                <input type="Submit" />
            </form>
            <form class="form" method = "POST" action = "/pages/manager/viewstudent.php">
                Search By Acc Username:
                <input type="text" name="username"/>
                <input type="Submit" />
            </form>
            <table class="table table-striped table-hover" style="margin-top: 50px">
                <thead>
                    <tr>
                        <td><b>Id</b></td>
                        <td><b>Username</b></td>
                        <td><b>Student Name</b></td>
                        <td><b>Account Type</b></td>
                        <td><b>Action</b></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($id)) {
                        $sql = "SELECT *, a.id AS aid, p.id AS pid FROM `accounts` a LEFT JOIN `profiles` p ON a.id = p.accid  WHERE a.id=$id AND `acctype`=1;";
                    } else if (!empty($name)) {
                        $sql = "SELECT *, a.id AS aid, p.id AS pid FROM accounts a LEFT JOIN profiles p ON p.accid = a.id WHERE CONCAT( firstname, ' ' , lastname ) like '%$name%' AND `acctype`=1;";
                    } else if (!empty($username)) {
                        $sql = "SELECT *, a.id AS aid, p.id AS pid FROM accounts a LEFT JOIN profiles p ON p.accid = a.id WHERE `username` LIKE'%$username%' AND `acctype`=1;";
                    } else {
                        $sql = "SELECT *, a.id AS aid, p.id AS pid FROM `accounts` a LEFT JOIN `profiles` p ON a.id = p.accid WHERE `acctype`=1;";
                    }
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        $name = $row['firstname'] . " " . $row['lastname'];
                        ?>
                        <tr>
                            <td><?php echo $row['aid']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $name; ?></td>
                            <td><?php echo getAccountTypeById($row['acctype']); ?></td>


                            <td width="180px">
                                <a href="studentterm?id=<?php echo $row['aid']; ?>" style="text-decoration: none;">
                                    <button style="width: 80px;height:25px;vertical-align:top;">View</button>
                                </a>

                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>  	
        </div>

        <?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/layout/footer.php"); ?>
    </body>
</html>