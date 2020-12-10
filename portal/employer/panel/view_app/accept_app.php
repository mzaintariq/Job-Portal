<?php

    require('../../emp_verify.php');
    //if user was not logged in, he would be redirected to login page and the following lines of code would not run
    //note that the session_start() command is included in above file
    
    //connecting to database
    require('../../../connect.php');


    $js_id = $_POST['js_id'];
    $job_id = $_POST['job_id'];
    $app_id = $_POST['app_id'];
?>

<?php
    $success=true;
    //this variable will remain true to the end, unless an error occurs

    //testing to see if someone is already hired in this job
    $sql0 = "SELECT `js_id` FROM `jobs` WHERE `job_id`=$job_id";
    $result=$conn->query($sql0);
    $row=$result->fetch_assoc();
    if($row['js_id']!=NULL) {
        header("Location:./index.php?success=false");
        die('You already hired someone for this job. Fire that employee first.');
    }
    

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
    $sql = "INSERT INTO `employments` (`job_id`,`js_id`,`emp_id`,`status`) VALUES ($job_id,$js_id," . $_SESSION['user'] . ",1)";
    if(!mysqli_query($conn,$sql)) {
        $success=false;
    }

    //deleting the application of the user as it is useless now
    //this also ensures that the employer doesn't hire the user back again without him applying
    $sql = "DELETE FROM `applications` WHERE `job_id`=$job_id AND `js_id`=$js_id";
    if(!mysqli_query($conn,$sql)) {
        $success=false;
    }

    if ($success) {
        echo "New record created successfully";
        header("Location:./index.php?success=true");
        die();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
?>