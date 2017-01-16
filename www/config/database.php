<?php

/* Home Server */
define("HOST", "localhost");    // The host you want to connect to.
define("USER", "root");         // The database username. 
define("PASSWORD", "");         // The database password. 
define("DATABASE", "coop");     // The database name.

/* School Server */
//define("HOST", "localhost");
//define("USER", "wu12o_user");
//define("PASSWORD", "wu12o_pass");
//define("DATABASE", "wu12o_db");

$conn = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
