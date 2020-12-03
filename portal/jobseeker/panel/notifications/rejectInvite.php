<?php

require('../../js_verify.php');
require('../../../connect.php');

$success=true;
$jobtitle='';
$app_id=$_POST['app_id'];
$sql = "SELECT `title`,`emp_id` FROM `jobs` WHERE `job_id` IN (SELECT `job_id` FROM `applications` WHERE `app_id`=" . $app_id . ")";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$jobtitle=$row['title'];
$emp_id=$row['emp_id'];

$js_name='';
//deleting the application. The notification will automatically get deleted.
$sql = "DELETE FROM `applications` WHERE `app_id`=$app_id";
if(!mysqli_query($conn,$sql)) {
    $success=false;
}


//finding out job seeker's name to notify employer
$sql = "SELECT `firstname`,`lastname` FROM `jobseekers` WHERE `js_id`=" . $_SESSION['user'] . " LIMIT 0,1";
$result = mysqli_query($conn,$sql);
if($result!=false && mysqli_num_rows($result)>0) {  
    $row=mysqli_fetch_assoc($result);
    $js_name=$row['firstname'] . ' ' . $row['lastname'];
} else {
    die("Invalid account. Try logging in again.");
}

//sending notification to employer
$content = "Employee " . $js_name . " rejected your invitation for job \"" . $jobtitle . "\". His application has been deleted.";
$sql="INSERT INTO `notifications` (emp_id,app_id,type,content) VALUES ($emp_id,NULL,'message','$content')";

if(!mysqli_query($conn,$sql)) {
    $success=false;
    echo "Could not send notification to employer.";
}

if($success) {
    echo "done";
} else {
    echo "Something went wrong.";
}


?>