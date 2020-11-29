<?php
    require('../../js_verify.php');
    //this will make sure the user is logged in to access this page
    //put this require statement in the start of all PHP files
        
    require('../../../connect.php');
        
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
        
        //$sql2 = "SELECT `title` FROM `jobs`";
/*$sql2 = "SELECT * FROM `jobs`";
        $result2 = mysqli_query($conn,$sql2);
        while($row2 = mysqli_fetch_assoc($result2))
        {
            $job_id = $row2['job_id'];
            $emp_id = $row2['emp_id']; 
            $title = $row2['title'];
            $description = $row2['description'];
            $type = $row2['type'];
            $mode = $row2['mode'];
            $location = $row2['location'];
            $salary = $row2['salary'];
            $min_age_req = $row2['min_age_req'];
            $min_edu_req = $row2['min_edu_req'];
            $min_exp_req = $row2['min_exp_req'];
            $questions = $row2['questions'];
            $blocked = $row2['blocked'];
            $js_id = $row2['js_id'];
        }*/
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

    <div class="jumbotron">

    <table class="table">
        <tr>
            <td><b>Title</b></td>
            <td><b>Description</b></td>
            <td><b>Type</b></td>
            <td><b>Mode</b></td>
            <td><b>Location</b></td>
            <td><b>Salary</b></td>
            <td><b>Minimum Age</b></td>
            <td><b>Minimum Eductation</b></td>
            <td><b>Minimum Experience</b></td>
            <td><b>Questions</b></td>
            <td><b>Apply</b></td>
        </tr>
        <?php

        $sql2 = "SELECT * FROM `jobs`";
        $result2 = mysqli_query($conn,$sql2);
        while($row2 = mysqli_fetch_assoc($result2))
        {
            $job_id = $row2['job_id'];
            $emp_id = $row2['emp_id']; 
            $title = $row2['title'];
            $description = $row2['description'];
            $type = $row2['type'];
            $mode = $row2['mode'];
            $location = $row2['location'];
            $salary = $row2['salary'];
            $min_age_req = $row2['min_age_req'];
            $min_edu_req = $row2['min_edu_req'];
            $min_exp_req = $row2['min_exp_req'];
            $questions = $row2['questions'];
            $blocked = $row2['blocked'];
            $js_id = $row2['js_id'];

        print "<tr>";
            print "<td>" . $title . "</td>";
            print "<td>" . $description . "</td>";
            print "<td>" . $type . "</td>";
            print "<td>" . $mode . "</td>";
            print "<td>" . $location . "</td>";
            print "<td>" . $salary . "</td>";
            print "<td>" . $min_age_req. "</td>";
            print "<td>" . $min_edu_req . "</td>";
            print "<td>" . $min_exp_req . "</td>";
            print "<td>" . $questions . "</td>";
            print "<form action='apply.php' method='post'>";
            //print "<input type=\"submit\" name='title' value"
            print "<input type='hidden' name='questions' value='" . $questions . "'></input>";
            print "<td> <button type=\"submit\" name='title' value=\"" . $title . "\" class=\"btn btn-success\">Apply</button></td>";
            print "</form";
        print "</tr>";
        }
        ?>
    </table>

    </div>

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