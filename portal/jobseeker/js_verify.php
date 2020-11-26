<?php

session_start();
    if(!isset($_SESSION['user'])) {
        header("Location:./index.php?login");
        die();
    } else if($_SESSION['type']=='employer' || $_SESSION['type']=='admin') {
        echo "You have no access here. Please leave.";
        die();
    }

?>