<?php

require('../../js_verify.php');
    //through this file,
    //if user was not logged in, he would be redirected to login page and the following lines of code would not run
    //note that the session_start() command is included in above file

    require('../../../connect.php');
    //load database connection credentials
        
        // Create connection
        $conn = new mysqli($servername, $username, $pwd, $dbname);
        // Check connection
        if ($conn->connect_error) {
            header('Location:login.php?connectionfailed=1');
            die("Connection failed: " . $conn->connect_error);
        } else {
            $sql = "SELECT `firstname`,`gender` FROM `jobseekers` WHERE `js_id`=" . $_SESSION['user'] . " LIMIT 0,1";
            $result = mysqli_query($conn,$sql);
            $row=mysqli_fetch_assoc($result);

            if($row['gender']==0) {
                $prename=' Mr.';
            } else if ($row['gender']==1) {
                $prename=' Ms.';
            } else {
                $prename='';
            }
            
            $name=$row['firstname'];
        }


        $job_id=$_POST['job_id'];
        $js_id = $_SESSION['user'];
        $statement = $_POST['statement'];
        $answers = $_POST['answers'];

        $sql = "INSERT INTO `applications` (job_id,js_id,statement,answers) VALUES ($job_id,$js_id,'$statement','$answers')";
        $result = mysqli_query($conn,$sql);
        if($result) {
            echo "Successfully Applied For Job";
            header('Location:index.php?apply=success');
        } else {
            echo "Failed to apply.";
            header('Location:index.php?apply=failed');
        }

?>