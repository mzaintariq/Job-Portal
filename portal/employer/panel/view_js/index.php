<?php
    require('../../emp_verify.php');
    //this will make sure the user is logged in to access this page
    //put this require statement in the start of all PHP files
        
    require('../../../connect.php');

    $tableName='employers';
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
    <h1>Job Seekers:</h1>    
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
                <td><b>Profession</b></td>
                <!-- <td><b>Experience</b></td>
                <td><b>Education</b></td> -->
            </tr>
        </thead>
        <?php

        // $sql2 = "SELECT * FROM `jobseekers` WHERE emp_id = '". $_SESSION["user"]."'";
        $sql2 = "SELECT * FROM `jobseekers` WHERE firstname LIKE '%{$name}%' OR lastname LIKE '%{$name}%'";
        // $sql2 = "SELECT * FROM `jobseekers`";
        $result2 = mysqli_query($conn,$sql2);
        while($row2 = mysqli_fetch_assoc($result2))
        {
            $js_id = $row2['js_id'];
            $firstname = $row2['firstname']; 
            $lastname = $row2['lastname'];
            $age = $row2['age'];
            $gender = $row2['gender'];
            $email = $row2['email'];
            $profession = $row2['profession'];
            $experience_months = $row2['experience'];
            $education_months = $row2['education'];

        print "<tr>";
            print "<td>" . $js_id . "</td>";
            print "<td>" . $firstname . "</td>";
            print "<td>" . $lastname . "</td>";
            print "<td>" . $age . "</td>";
            print "<td>" . $gender . "</td>";
            print "<td>" . $email . "</td>";
            print "<td>" . $profession. "</td>";
            // print "<td>" . $experience_months . "</td>";
            // print "<td>" . $education_months . "</td>";
            // $urltitle = urlencode($title);
            // $urlquestions = urlencode($questions);
            // print "<td><a href='apps.php?job_id=" . $job_id . "&title=" . $urltitle . "&questions=" . $urlquestions . "'>View</a></td>";
        print "</tr>";
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