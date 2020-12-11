<?php

require('../../js_verify.php');
    //through this file,
    //if user was not logged in, he would be redirected to login page and the following lines of code would not run
    //note that the session_start() command is included in above file

    require('../../../connect.php');
    //this file loads database connection credentials and creates the $conn object
    //it also checks if connection was successful and displays error if it was not


        $job_id=$_POST['job_id'];
        $js_id = $_SESSION['user'];
        $statement = $_POST['statement'];
        $answers = $_POST['answers'];

        $sql = "INSERT INTO `applications` (job_id,js_id,statement,answers) VALUES ($job_id,$js_id,'$statement','$answers')";

        $result = mysqli_query($conn,$sql);


        if($result) {
            echo "Successfully Applied For Job";
            echo "<script>window.location='index.php?apply=success';</script>";
            //header('Location:index.php?apply=success'); //return success message through URL
        } else {
            echo "Failed to apply.";
            echo "<script>window.location='index.php?apply=failed';</script>";
            //header('Location:index.php?apply=failed');  //return failure message through URL
        }

?>