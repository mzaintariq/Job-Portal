<?php

require('../../emp_verify.php');
require('../../../connect.php');

$tableName='employers';
require('../../../prename.php');    //to find out name of employer for sending notification to jobseeker

if(!isset($_POST['job_id']) || !isset($_POST['notif_id'])) {
    die('Insufficient information.');
}
$job_id=$_POST['job_id'];
$jobtitle;
$notif_id=$_POST['notif_id'];
$js_id;
$success=true;


//getting job seeker's id and job's title
$sql = "SELECT `js_id`,`title` FROM `jobs` WHERE `job_id`=$job_id;";
$result = mysqli_query($conn,$sql);
if($result==false) {
    $success=false;
} else if(mysqli_num_rows($result)==0) {
    die('Job not found.');
} else {
    $row=mysqli_fetch_assoc($result);
    $js_id=$row['js_id'];
    $jobtitle=$row['title'];
}

//updating jobs table
$sql = "UPDATE `jobs` SET `js_id`=NULL WHERE `job_id`=$job_id";
$result = mysqli_query($conn,$sql);
if($result==false) {
    $success=false;
}

//updating jobseeker's employment status
$sql = "UPDATE `jobseekers` SET `employment_status`=0 WHERE `js_id`=$js_id";
$result = mysqli_query($conn,$sql);
if($result==false) {
    $success=false;
}

//deleting from employments table
$sql = "DELETE FROM `employments` WHERE `job_id`=$job_id AND `js_id`=$js_id";
if(!mysqli_query($conn,$sql)) {
    $success=false;
}

//deleting the resignation request notification
$sql = "DELETE FROM `notifications` WHERE `notif_id`=$notif_id";
if(!mysqli_query($conn,$sql)) {
    $success=false;
}

//sending notification to jobseeker
$content = "Employer " . $name . " accepted your resignation for job \"" . $jobtitle . "\". You no longer are employed for that job.";
$sql="INSERT INTO `notifications` (js_id,app_id,type,content) VALUES ($js_id,NULL,'message','$content')";
if(!mysqli_query($conn,$sql)) {
    $success=false;
}


if($success) {
    echo "done";
} else {
    echo "Something went wrong. Please contact admin or try again.";
}

?>