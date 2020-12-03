<?php

require('../../js_verify.php');
require('../../../connect.php');


if(!isset($_POST['app_id']) || !isset($_POST['notif_id'])) {
    die("Incomplete information.");
}

$app_id=$_POST['app_id'];
$notif_id=$_POST['notif_id'];
$js_id = $_SESSION['user'];
$job_id=-1;
$emp_id=-1;
$jobtitle='';
$js_name='';

//finding job_id and emp_id
$sqlJobID = "SELECT applications.job_id,jobs.emp_id,jobs.title FROM `applications`, `jobs` WHERE applications.app_id=$app_id";
$result=mysqli_query($conn,$sqlJobID);
if($result!=false && mysqli_num_rows($result)>0) {
    $row0=mysqli_fetch_assoc($result);
    $job_id=$row0['job_id'];
    $emp_id=$row0['emp_id'];
    $jobtitle=$row0['title'];
} else {
    die("Invalid application. " . $app_id . $sqlJobID);
}

$success=true;
//this variable will remain true to the end, unless an error occurs

//updating jobs table
$sql = "UPDATE `jobs` SET `js_id`=$js_id WHERE `job_id`=$job_id";
$result = mysqli_query($conn,$sql);
if($result==false) {
    $success=false;
}

//updating jobseeker's employment status
$sql = "UPDATE `jobseekers` SET `employment_status`=1 WHERE `js_id`=$js_id";
$result = mysqli_query($conn,$sql);
if($result==false) {
    $success=false;
}

//updating employments table
$sql = "INSERT INTO `employments` (`job_id`,`js_id`,`emp_id`,`status`) VALUES ($job_id,$js_id,$emp_id,1)";
if(!mysqli_query($conn,$sql)) {
    $success=false;
}

//deleting the application of the user as it is useless now
//this also ensures that the employer doesn't hire the user back again without him applying
//NOTE: due to foreign key constraint, the notification about this app_id will automatically get deleted

$sql = "DELETE FROM `applications` WHERE `app_id`=$app_id";
if(!mysqli_query($conn,$sql)) {
    echo $sql;
    $success=false;
}

//finding out job seeker's name to notify employer
$sql = "SELECT `firstname`,`lastname` FROM `jobseekers` WHERE `js_id`=$js_id LIMIT 0,1";
$result = mysqli_query($conn,$sql);
if($result!=false && mysqli_num_rows($result)>0) {  
    $row=mysqli_fetch_assoc($result);
    $js_name=$row['firstname'] . ' ' . $row['lastname'];
} else {
    die("Invalid account. Try logging in again.");
}

//sending notification to employer
$content = "Employee " . $js_name . " accepted invitation for job \"" . $jobtitle . "\". Employee has been hired.";
$sql="INSERT INTO `notifications` (emp_id,app_id,type,content) VALUES ($emp_id,NULL,'message','$content')";
if(!mysqli_query($conn,$sql)) {
    $success=false;
}

if ($success) {
    echo "done";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    die();
}
$conn->close();
?>