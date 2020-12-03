<?php

if(!isset($_POST['job_id'])) {
    die("Insufficient information.");
}
$job_id=$_POST['job_id'];
require('../../js_verify.php');
require('../../../connect.php');

$tableName='jobseekers';
require('../../../prename.php');

//finding emp_id
$emp_id = -1;
$sql0 = "SELECT `emp_id`,`title` FROM `jobs` WHERE `job_id`=" . $job_id;

$result = mysqli_query($conn,$sql0);
if($result!=false && mysqli_num_rows($result)>0) {
    $row=mysqli_fetch_assoc($result);
    $emp_id=$row['emp_id'];
} else {
    die('Job invalid or employer no longer exists.');
}


$type='resignation';
$content=$name . " " . $lastname . " wishes to resign from job " . $row['title'] . ".";
$sql = "INSERT INTO `notifications` (`emp_id`,`type`,`content`,`additional_details`) VALUES($emp_id,'$type','$content',$job_id)";

if(mysqli_query($conn,$sql)) {
    echo "done";
} else {
    echo "Could not send notification to Employer. Try again or contact admin.";
}

?>