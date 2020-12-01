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
    $sql = "UPDATE `jobs` SET `js_id`=$js_id, `status`=0 WHERE `job_id`=$job_id";
    $result = mysqli_query($conn,$sql);
?>

<?php
    $sql = "UPDATE `jobseekers` SET `employment_status`=1 WHERE `js_id`=$js_id";
    $result = mysqli_query($conn,$sql);
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        header("Location:./index.php?success=true");
        die();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
?>