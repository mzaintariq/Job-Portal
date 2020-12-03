<?php

require('../../emp_verify.php');
require('../../../connect.php');

if(!isset($_POST['all']) || !isset($_POST['notif_id'])) {
    die("Insufficient information.");
}

$sql='';
if($_POST['all']==0)
    $sql = "DELETE FROM `notifications` WHERE `notif_id`=" . $_POST['notif_id'] . " AND `emp_id`=" . $_SESSION['user'];

else if ($_POST['all']==1)
    $sql = "DELETE FROM `notifications` WHERE `emp_id`=" . $_SESSION['user'];


    if (mysqli_query($conn,$sql)) {
        echo "done";
    } else {
        echo "Error deleting notification.";
    }

    mysqli_close($conn);
?>