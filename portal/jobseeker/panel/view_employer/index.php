<?php
    require('../../js_verify.php');
    //this will make sure the user is logged in to access this page
    //put this require statement in the start of all PHP files
        
    require('../../../connect.php');

    $tableName='jobseekers';
    require('../../../prename.php');  
    //this just figures out whether to write "Mr." with the user's name or "Ms." based on their gender
        

    // //once the user has applied for the job in apply.php, the success/failure message
    // //is returned to this file through the URL. This following code handles the display of
    // //that message.
    // $error='';
    // $errorClass='';
    // if(isset($_GET['apply'])) {//this checks if a message exists in a URL
    //     if($_GET['apply']=='success') {//is the message SUCCESS?
    //         $error='Successfully applied for job.'; //if yes, then set $error to a happy message
    //         $errorClass='alert-success';
    //     } else {//if the message is one of failure
    //         $error='Failed to apply for job. Try again or contact developers.'; //set $error to a message of doom
    //         $errorClass='alert-danger';
    //     }
    // }
    if(isset($_POST['search']))
        $name = $_POST['search'];

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
    <title>Job Seeker Panel</title>
</head>
<!-- <head>
    <title>Employer Panel</title>
</head> -->
<body>
<div class='container pt-5'>
    <div class="jumbotron">
    <h1>Welcome<?php echo $prename . ' ' . $name; ?></h1>
    <h1>ID:<?php echo ' ' . $_SESSION['user']; ?></h1>
    <h1>Employers:</h1>    
    <!-- <p>Creators: Rohan, Zain, and Zahab from LUMS</p> -->
    </div>

    <form method="post" action="index.php">
        <div class="input-group mb-3">
                <input class="form-control" type="text" name="search" placeholder="Search"/>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                    <!-- <input type="submit" value="Search"/> -->
                </div>
        </div>
    </form>
    <form method="post" action="index.php">
        <button class="btn btn-outline-secondary" type="submit">Reset Search</button>
        <!-- <input type="submit" value="Reset"/> -->
    </form>


    <table class="table">
        <thead>
            <tr>
                <td><b>ID</b></td>
                <td><b>First Name</b></td>
                <td><b>Last Name</b></td>
                <td><b>Age</b></td>
                <td><b>Gender</b></td>
                <td><b>Email</b></td>
                <td><b>Company Name</b></td>
                <td><b>Company Type</b></td>
                <td><b>Actions</b></td>
                <!-- <td><b>Experience</b></td>
                <td><b>Education</b></td> -->
            </tr>
        </thead>
        <?php

        // $sql2 = "SELECT * FROM `jobseekers` WHERE emp_id = '". $_SESSION["user"]."'";
        $sql2='';
        if(isset($_POST['search']))
            $sql2 = "SELECT * FROM `employers` WHERE firstname LIKE '%{$name}%' OR lastname LIKE '%{$name}%'";
        else
            $sql2 = "SELECT * FROM `employers` WHERE 1";
        // $sql2 = "SELECT * FROM `jobseekers`";
        $result2 = mysqli_query($conn,$sql2);
        while($row2 = mysqli_fetch_assoc($result2))
        {
            $emp_id = $row2['emp_id'];
            $firstname = $row2['firstname']; 
            $lastname = $row2['lastname'];
            $age = $row2['age'];
            // $gender = $row2['gender'];
            switch($row2['gender']) {
                case 0:
                    $gender='Male';
                break;
                
                case 1:
                    $gender='Female';
                break;
    
                default:
                    $gender='Unknown';
                break;
            }
            $email = $row2['email'];
            $companyname = $row2['companyname'];
            $companytype = $row2['companytype'];
            // $employment_status = $row2['employment_status'];
            switch($row2['employment_status']) {
                case 0:
                    $employment_status='Not Employed';
                break;
                
                case 1:
                    $employment_status='Employed';
                break;
    
                default:
                    $employment_status='Unknown';
                break;
            }

        echo "<tr>";
            echo "<td>" . $emp_id . "</td>";
            echo "<td>" . $firstname . "</td>";
            echo "<td>" . $lastname . "</td>";
            echo "<td>" . $age . "</td>";
            echo "<td>" . $gender . "</td>";
            echo "<td>" . $email . "</td>";
            echo "<td>" . $companyname. "</td>";
            echo "<td>" . $companytype. "</td>";
            echo "<td><button type='button' class='btn btn-link' onClick=\"window.location='viewprofile.php?emp_id=" . $emp_id . "'\">View Profile</button></td>";
            // echo "<td>" . $experience_months . "</td>";
            // echo "<td>" . $education_months . "</td>";
            // $urltitle = urlencode($title);
            // $urlquestions = urlencode($questions);
            // echo "<td><a href='apps.php?job_id=" . $job_id . "&title=" . $urltitle . "&questions=" . $urlquestions . "'>View</a></td>";
        echo "</tr>";
        }
        ?>
    </table>

    

    <div class="btn-group btn-group-lg mt-3">
    <button type="button" onClick="window.location='../index.php';" class="btn btn-success">Back</button>
    <!-- <button type="button" onClick="window.location='./check.php';" class="btn btn-primary">Check</button> -->
    </div>

    <div class="btn-group btn-group-lg mt-3">
    <button type="button" onClick="window.location='../logout.php';" class="btn btn-primary">Logout</button>
    <!-- <button type="button" onClick="window.location='./check.php';" class="btn btn-primary">Check</button> -->
    </div> 
</div>

</body>
</html>