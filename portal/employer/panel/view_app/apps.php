<?php

    require('../../emp_verify.php');
    //through this file,
    //if user was not logged in, he would be redirected to login page and the following lines of code would not run
    //note that the session_start() command is included in above file

    require('../../../connect.php');
    //load database connection credentials and check if connection was successful. Create $conn variable.
        
    $tableName='employers';
    require('../../../prename.php');  
    //this just figures out whether to write "Mr." with the user's name or "Ms." based on their gender
  
    $error='';
    $errorClass='';
    if(isset($_GET['success']) && $_GET['success']==1) {
        $error="<i class=\"fas fa-check-circle\"></i> Your job invite has successfully been sent to the Job Seeker. You will receive a notification if and when he accepts it.";
        $errorClass='alert-success';
    } else if (isset($_GET['success']) && $_GET['success']!=1 && !isset($_GET['hired'])) {
        $error="<i class=\"fas fa-times-circle\"></i> Job invite could not be sent. Try again.";
        $errorClass='alert-danger';
    } else if (isset($_GET['hired'])){
        $error="<i class=\"fas fa-times-circle\"></i> You have already hired someone on this job. Fire that employee first.";
        $errorClass='alert-warning';
    }
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/13ad6678d8.js"></script>
    <title>Employer Panel</title>
</head>
<!-- <head>
    <title>Employer Panel</title>
</head> -->
<body>
<div class='container pt-5'>
    <div class="jumbotron">
    <h1>Welcome<?php echo $prename . ' ' . $name; ?></h1>
    <h1>ID:<?php echo ' ' . $_SESSION['user']; ?></h1>


    
    <!-- <p>Creators: Rohan, Zain, and Zahab from LUMS</p> -->
    </div>

    <div class="alert <?php echo $errorClass; ?>" role="alert">
        <?php echo $error; ?>   <!--display the error message that came after user applied for job-->
    </div>

    <table class="table">
        <thead>
            <tr>
                <td><b>App ID</b></td>
                <td><b>JS ID</b></td>
                <td><b>Job ID</b></td>
                <td><b>Statement</b></td>
                <td><b>Answers</b></td>
                <td><b>Profile</b></td>
                <!-- <td><b>Apply</b></td> -->
            </tr>
        </thead>
        <?php


        $sql2 = "SELECT * FROM `applications` WHERE job_id = '". $_GET["job_id"]."'";
        $result2 = mysqli_query($conn,$sql2);
        while($row2 = mysqli_fetch_assoc($result2))
        {
            $app_id = $row2['app_id'];
            $js_id = $row2['js_id']; 
            $job_id = $row2['job_id'];
            $statement = $row2['statement'];
            $answers = $row2['answers'];
            $emp_id = $_SESSION["user"];

        print "<tr>";
            print "<td>" . $app_id . "</td>";
            print "<td>" . $js_id . "</td>";
            print "<td>" . $job_id . "</td>";
            print "<td>" . $statement . "</td>";
            print "<td>" . $answers . "</td>";
            print "<td><a href='emp_prof.php?job_id=" . $job_id . "&js_id=" . $js_id . "&emp_id=" . $emp_id . "&app_id=" . $app_id . "'>View</a></td>";
            // $urltitle = urlencode($title);
            // $urlquestions = urlencode($questions);
            // print "<td><a href='apps.php?job_id=" . $job_id . "&title=" . $urltitle . "&questions=" . $urlquestions . "'>Apply</a></td>";
        print "</tr>";
        }
        ?>
    </table>

    

    <div class="btn-group btn-group-lg mt-3">
    <button type="button" onClick="window.location='./index.php';" class="btn btn-success">Back</button>
    <!-- <button type="button" onClick="window.location='./check.php';" class="btn btn-primary">Check</button> -->
    </div>

    <div class="btn-group btn-group-lg mt-3">
    <button type="button" onClick="window.location='../logout.php';" class="btn btn-primary">Logout</button>
    <!-- <button type="button" onClick="window.location='./check.php';" class="btn btn-primary">Check</button> -->
    </div> 
</div>

</body>
</html>