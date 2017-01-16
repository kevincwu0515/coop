<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/php/functions.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["id"]))
        $id = $_POST["id"];
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
            <form class="form" method = "POST" action = "/pages/admin/displayallacc.php">
                <span>Search By Acc Id: </span>
                <input type="number" name="id" />
                <input type="Submit" />
            </form>
            <form class="form" method = "POST" action = "/pages/admin/displayallacc.php">
                Search By Acc Username:
                <input type="text" name="username"/>
                <input type="Submit" />
            </form>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <td><b>Id</b></td>
                        <td><b>Username</b></td>
                        <td><b>Password</b></td>
                        <td><b>Account Type</b></td>
                        <td><b>Action</b></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($id)) {
                         $sql = "SELECT * FROM `accounts` WHERE `id` = $id;";
                    } else if (!empty($username)) {
                        $sql = "SELECT * FROM `accounts` WHERE `username` LIKE '%$username%';";
                    } else {
                        $sql = "SELECT * FROM `accounts`;";
                    }
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td>*********</td>
                            <td><?php echo getAccountTypeById($row['acctype']); ?></td>


                            <td width="180px">
                                <a href="modifyacc.php?id=<?php echo $row["id"]; ?>" style="text-decoration: none;">
                                    <button style="width: 60px;height:25px;vertical-align:top;">Modify</button>
                                </a>
                                <button style="width: 60px;height:25px;vertical-align:top;">Delete</button>

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