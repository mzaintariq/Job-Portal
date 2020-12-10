<?php

require('../admin_verify.php');
require('../../connect.php');

//getting all employer IDs
$sql = "SELECT `emp_id` FROM `employers` WHERE `emp_id`>20"; 
$result=$conn->query($sql);
while($row=$result->fetch_assoc()) {
    $sql = "INSERT INTO `notifications` (`emp_id`,`type`,`content`) VALUES (" . $row['emp_id'] . ",'message','Welcome to the Job Portal')";
    $conn->query($sql);
}

//getting all jobseeker IDs
$sql = "SELECT `js_id` FROM `jobseekers` WHERE `js_id`>23"; 
$result=$conn->query($sql);
while($row=$result->fetch_assoc()) {
    $sql = "INSERT INTO `notifications` (`js_id`,`type`,`content`) VALUES (" . $row['js_id'] . ",'message','Welcome to the Job Portal')";
    $conn->query($sql);
}


?>