<?php

//this is a toggle block file. Subsequent requests to this file will block / unblock a user
require('../admin_verify.php');
require('../../connect.php');

// Create connection
$conn = new mysqli($servername, $username, $pwd, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    if(!isset($_POST['id'])) {
        die('No employer id specified');
    }


    $id = $_POST['id'];

    //checking if employee is already blocked
    $returnText='';
    $sql='';
    $sql0 = "SELECT `blocked` FROM `employers` WHERE `emp_id`=$id LIMIT 0,1";
    $result = mysqli_query($conn,$sql0);
    if($result!=false && mysqli_num_rows($result)>0) {
        $row=mysqli_fetch_assoc($result);
        if($row['blocked']==0) {
            $sql = "UPDATE `employers` SET `blocked`=1 WHERE `emp_id`=$id";
            $returnText='blocked';
        } else {
            $sql = "UPDATE `employers` SET `blocked`=0 WHERE `emp_id`=$id";
            $returnText='unblocked';
        }
    }

    
    
    if(mysqli_query($conn,$sql)) {
        echo $returnText;
    } else {
        echo "failure";
    }
}

?>