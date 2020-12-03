<?php

    require('../../emp_verify.php');
    //if user was not logged in, he would be redirected to login page and the following lines of code would not run
    //note that the session_start() command is included in above file
    
    //connecting to database
    require('../../../connect.php');


    $js_id = $_POST['js_id'];
    $job_id = $_POST['job_id'];
    $emp_id = $_SESSION['user'];
    $app_id = $_POST['app_id'];
?>

<?php
    $success=true;
    //this variable will remain true to the end, unless an error occurs

    $content="";
    $sqlGetContent = "SELECT `firstname`,`lastname` FROM `employers` WHERE `emp_id`=" . $_SESSION['user'] . " LIMIT 0,1";
    $result = mysqli_query($conn,$sqlGetContent);
    if($result==false) {
        die("You are an invalid user. Log in again.");
    }
    $row=mysqli_fetch_assoc($result);

    $content = $row['firstname'] . " " . $row['lastname'] . " accepted your job application. Do you want to start working on this job?";
    // updating notifications table
    $sql = "INSERT INTO `notifications` (js_id, emp_id, app_id, type, content) VALUES ('$js_id', NULL, '$app_id', 'jobinvite', '$content')";
    $result = mysqli_query($conn,$sql);
    if($result==false) {
        $success=false;
    }

    //deleting the application of the user as it is useless now
    //this also ensures that the employer doesn't hire the user back again without him applying
    // $sql = "DELETE FROM `applications` WHERE `job_id`=$job_id AND `js_id`=$js_id";
    // if(!mysqli_query($conn,$sql)) {
    //     $success=false;
    // }

    if ($success) {
        echo "New record created successfully";
        header("Location:./apps.php?success=1&job_id=" . $job_id);
        die();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
?>