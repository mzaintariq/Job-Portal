<?php
    require('../../js_verify.php');
    //this will make sure the user is logged in to access this page
    //put this require statement in the start of all PHP files
        
    require('../../../connect.php');

    $tableName='jobseekers';
    require('../../../prename.php');  
    //this just figures out whether to write "Mr." with the user's name or "Ms." based on their gender
    $error='';
    $errorClass='';
    $errorVisibility='none';


    function jobTypeFormat($jobType) {
        if($jobType=='pt') {
            return 'Part Time';
        } else {
            return 'Full Time';
        }
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
    <title>View My Jobs</title>
</head>

<body>
<div class='container pt-5'>
    <div class="jumbotron">
        <h1>Welcome<?php echo $prename . ' ' . $name; ?></h1>
        <h2>ID:<?php echo ' ' . $_SESSION['user']; ?></h1>
    </div>


    <h3>Your Jobs:</h3>
    <div class="alert alert-<?php echo $errorClass; ?>" role="alert" style="display:<?php echo $errorVisibility; ?>">
        <?php echo $error; ?>
    </div>
    
    <?php
        //see if jobseeker is even hired
        $sql0 = "SELECT `employment_status` FROM `jobseekers` WHERE `js_id`=" . $_SESSION['user'] . " LIMIT 1";
        $result0 = mysqli_query($conn,$sql0);
        $row = mysqli_fetch_assoc($result0);
        if($row['employment_status']==0) {
            echo "<div class=\"alert alert-warning\" role=\"alert\"><i class=\"fas fa-exclamation-circle\"></i> You are unemployed.</div>";
            die();
        }

        $sql = "SELECT * FROM `jobs` WHERE `job_id` IN 
        (SELECT `job_id` FROM `employments` WHERE `js_id`=" . $_SESSION['user'] . ")";

        $result = mysqli_query($conn,$sql);
        if($result==false) {
            die("Query failed.");
        }
        if(mysqli_num_rows($result)==0) {
            echo "<div class=\"alert alert-warning\" role=\"alert\"><i class=\"fas fa-exclamation-circle\"></i> You have no jobs.</div>";
        } else {
            $totalSalary=0;
            echo "<table class='table table-striped'>
            <tr>
                <th>Job Title</th>
                <th>Description</th>
                <th>Job Type</th>
                <th>Job Mode</th>
                <th>Location</th>
                <th>Salary</th>
                <th>Action</th>
            </tr>";
            while($row=mysqli_fetch_assoc($result)) {
                $jobType=jobTypeFormat($row['type']);
                $totalSalary+=$row['salary'];
                
                echo "<tr><td>" . $row['title'] . "</td><td> " . $row['description'] . "</td>
                <td>" . $jobType . "</td><td>" . $row['mode'] . "</td><td>" . $row['location'] . "</td>
                <td>" . $row['salary'] . "</td><td>Resign</td>
                </tr>";

            }

            echo "<tr><td></td><td></td><td></td><td></td><td style='color:green;'>Total Salary:</td><td style='color:green;'>" . $totalSalary . "</td><td></td>";
            echo "</table>";
        }

    ?>
    <ul class="pagination">
       <li class="page-item"><a class="page-link" href="../index.php"><i class="fas fa-angle-left"></i> Go Back</a></li>
       <li class="page-item"><a class="page-link" href="../logout.php"><i class="fas fa-power-off"></i> Logout</a></li>
    </ul>

</body>
</html>