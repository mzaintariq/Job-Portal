<?php

    //this is a toggle block file. Subsequent requests to this file will block / unblock a user
    require('../../emp_verify.php');
    require('../../../connect.php');

    if(!isset($_POST['id'])) {
        die('No job id specified');
    }


    $id = $_POST['id'];

    //checking if employee is already blocked
    $returnText='';
    $sql='';
    $sql0 = "SELECT `status` FROM `jobs` WHERE `job_id`=$id LIMIT 0,1";
    $result = mysqli_query($conn,$sql0);
    if($result!=false && mysqli_num_rows($result)>0) {
        $row=mysqli_fetch_assoc($result);
        if($row['status']==0) {
            $sql = "UPDATE `jobs` SET `status`=1 WHERE `job_id`=$id";
            $returnText='status changed to active';
        } else {
            $sql = "UPDATE `jobs` SET `status`=0 WHERE `job_id`=$id";
            $returnText='status changed to inactive';
        }
    }



    if(mysqli_query($conn,$sql)) {
        echo $returnText;
    } else {
        echo "failure";
    }


?>