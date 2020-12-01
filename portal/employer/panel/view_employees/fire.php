<?php
    require('../../emp_verify.php');
    //this will make sure the user is logged in to access this page
    //put this require statement in the start of all PHP files
        
    require('../../../connect.php');
    $success=true;

    //check if jobseeker had more than one jobs
    $sql0 = "SELECT `job_id`,`emp_id` FROM `employments` WHERE `js_id`=" . $_GET['js_id'];
    $result0 = mysqli_query($conn,$sql0);
    $num_jobs=0;
    $job_id=-1;

    if($result0==false) {
        $success=false;
    } else {
        $num_jobs = mysqli_num_rows($result0);
        while($row=mysqli_fetch_assoc($result0)) {
            if($row['emp_id']==$_SESSION['user']) {
                $job_id=$row['job_id'];
            }
        }
    }

    
    //removing job seeker's id from job table entry
    $sql = "UPDATE `jobs` SET `js_id`=NULL WHERE `emp_id`=" . $_SESSION['user'] . " AND `js_id`=" . $_GET['js_id'];
    $result = mysqli_query($conn,$sql);

    if($result==false) {
        $success=false;
    }

    //updating employments table
    if($job_id!=-1) {
        $sql3 = "DELETE FROM `employments` WHERE `job_id`=" . $job_id;
        if(!mysqli_query($conn,$sql3)) {
            $success=false;
        }
    }
   

    if($num_jobs==1) {
        //if user had only one job, then it was this one and he has been fired now
        //so we set his employment_status to 0.

        $sql2 = "UPDATE `jobseekers` SET `employment_status`=0 WHERE `js_id`=" . $_GET['js_id'];
        if(!mysqli_query($conn,$sql2)) {
            $success=false;
        }
    }

    //returning success/failure message
    if($success) {
        header('Location:index.php?firesuccess=1');
    } else {
        header('Location:index.php?firesuccess=1');
    }
    mysqli_close($conn);

?>