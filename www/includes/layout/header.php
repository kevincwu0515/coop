<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/php/functions.php';

$acctype = getUserType();
/* Student, Teacher & Instructor Page */
if ($acctype == 1 || $acctype == 2 || $acctype == 3) {
    ?>
    <link href = "/css/layout.css" rel = "stylesheet"> 
    <script src="/js/index.js"></script>
    <?php
    addHeader($acctype);
    /* Manager & Admin Page */
} else if ($acctype == 4 || $acctype == 5) {
    ?>
    <link href="/css/index-page2.css" rel="stylesheet">
    <?php
    addHeader($acctype);
} else {
    
}

function addHeader($acctype) {
    if ($acctype == 1 || $acctype == 2 || $acctype == 3) {
        ?>
        <!-- Header -->
        <div class="header">
            <div class="container">
                <!-- logo -->
                <div class="logo">
                    <a href="/"><img src="/images/layout/logo.png" alt="logo" style ="margin-top: 50px;"/></a>
                </div>

                <!-- Search bar -->
                <div class="searchBar">
                    <input type="text" placeholder="Ex: IT assistant" id="input"/>
                    <a href="#" onclick="searchPost(); return false;">
                        <img src="/images/layout/search_btn.png" alt="Search" style="border:1px solid #f44242;padding-left: 6px;"/>
                    </a>
                </div>

            </div>

        </div>
        <?php
        addNavBar($acctype);
    } else if ($acctype == 4 || $acctype == 5) {
        if ($acctype == 4) {
            $array = array(
                array("/pages/manager/home.php", "Home")
            );
        } else if ($acctype == 5) {
            $array = array(
                array("/pages/admin/home.php", "Home"),
                array("/pages/admin/accmanagement.php", "Acc Management")
            );
        }
        ?>
        <nav class="navbar navbar-fixed-top">
            <div class="container">
                <div class="navbar-title"><a href="/" style="color:white;text-decoration: none;">Coop System</a></div>
                <div>
                    <?php
                    foreach ($array as $arr) {
                        if ($arr === reset($array)) {
                            ?>
                            <ul class="nav-list navbar-nav">
                                <li class="active"><a href="<?php echo $arr[0] ?>"><?php echo $arr[1] ?></a></li>
                            </ul>
                            <?php
                        } else {
                            ?>
                            <ul class="nav-list navbar-nav">
                                <li><a href="<?php echo $arr[0] ?>"><?php echo $arr[1] ?></a></li>
                            </ul>
                            <?php
                        }
                    }
                    ?>
                    <ul class="nav-list navbar-nav navbar-right">
                        <li>
                            <a href="/pages/logout.php/pages/logout.php">Log out </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <?php
    }
}

function addNavBar($acctype) {
    if ($acctype == 1) {
        $array = array(
            array("/pages/student/home.php", "Home"),
            array("/pages/student/profile.php", "Profile"),
            array("/pages/posting.php", "Browse"),
            array("/pages/student/application.php", "Application")
        );
    } else if ($acctype == 2) {
        $array = array(
            array("/pages/employer/home.php", "Home"),
            array("/pages/employer/profile.php", "Profile"),
            array("/pages/employer/posting.php", "Posting"),
            array("/pages/posting.php", "Browse"),
            array("/pages/employer/application.php", "Application")
        );
    } else if ($acctype == 3) {
        $array = array(
            array("/pages/instructor/home.php", "Home"),
            array("/pages/posting.php", "Browse"),
            array("/pages/instructor/student.php", "Student")
        );
    }
    ?>
    <div class="navBar">            
        <ul class="container">
            <?php
            foreach ($array as $arr) {
                if ($arr === reset($array)) { // First Element is hovered (Home)
                    echo "<li><a href=\"$arr[0]\" class=\"item active\">" . $arr[1] . "</a></li>";
                } else {
                    echo "<li><a href=\"$arr[0]\" class=\"item\">" . $arr[1] . "</a></li>";
                }
            }
            ?>
            <a href="/pages/logout.php" class="btn" >
                <img src="/images/layout/logout_btn.png" alt="logout" />
            </a>
        </ul>
    </div>
    <?php
}
?>