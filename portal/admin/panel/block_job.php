<?php

    //this is a toggle block file. Subsequent requests to this file will block / unblock a user
    require('../admin_verify.php');
    require('../../connect.php');

    if(!isset($_POST['id'])) {
        die('No job id specified');
    }


    $id = $_POST['id'];

    //checking if job is already blocked
    $returnText='';
    $sql='';
    $sql0 = "SELECT `blocked` FROM `jobs` WHERE `job_id`=$id LIMIT 0,1";
    $result = mysqli_query($conn,$sql0);
    if($result!=false && mysqli_num_rows($result)>0) {
        $row=mysqli_fetch_assoc($result);
        if($row['blocked']==0) {
            $sql = "UPDATE `jobs` SET `blocked`=1 WHERE `job_id`=$id";
            $returnText='blocked';
        } else {
            $sql = "UPDATE `jobs` SET `blocked`=0 WHERE `job_id`=$id";
            $returnText='unblocked';
        }
    }



    if(mysqli_query($conn,$sql)) {
        echo $returnText;
    } else {
        echo "failure";
    }


?>