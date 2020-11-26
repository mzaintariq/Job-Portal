<?php

session_start();
    if(!isset($_SESSION['user'])) {
        header("Location:./index.php");
        die();
    } else if ($_SESSION['type']=='jobseeker') {
        echo "You have no access here. Please leave.";
        die();
    }


?>