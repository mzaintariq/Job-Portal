<?php

    require('../../emp_verify.php');
    //if user was not logged in, he would be redirected to login page and the following lines of code would not run
    //note that the session_start() command is included in above file
    
    //connecting to database
    require('../../../connect.php');


    $js_id = $_POST['js_id'];
    // $job_id = $_POST['job_id'];
    $emp_id = $_POST['emp_id'];
    $app_id = $_POST['app_id'];
?>

<?php
    $success=true;
    //this variable will remain true to the end, unless an error occurs

    // updating notifications table
    $sql = "INSERT INTO `notifications` (js_id, emp_id, app_id, type, content) VALUES ('$js_id', '$emp_id', '$app_id', '$type', '$content')";
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
        header("Location:./index.php?success=true");
        die();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
?>