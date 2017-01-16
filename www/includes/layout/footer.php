<!-- footer -->
<?php
$acctype = getUserType();
if ($acctype == 1 || $acctype == 2 || $acctype == 3) {
    ?>
    <footer>
        <span>
            Copyright (C) 2016 <a href="http://www.uwindsor.ca/">University of Windsor</a>    
        </span>
    </footer>

    <?php
} else if ($acctype == 4 || $acctype == 5) {
    ?>
    <div class="footer">
        <div class="container">
            <h2>Coop System Prototype</h2>
            <p>University of Windsor Ⓒ 2016</p>
        </div>
    </div>
    <?php
}
?>