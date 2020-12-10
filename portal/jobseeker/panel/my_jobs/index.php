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

    <!--local script-->
    <script src='myjobs.js'></script>
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
        }
        else {
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
                    <th>Employer</th>
                    <th>Employer Email</th>
                    <th>Job Title</th>
                    <th>Description</th>
                    <th>Job Type</th>
                    <th>Job Mode</th>
                    <th>Location</th>
                    <th>Salary</th>
                    <th>Action</th>
                </tr>";
                while($row=mysqli_fetch_assoc($result)) {
                    $sql0 = "SELECT `firstname`,`lastname`,`email` FROM `employers` WHERE `emp_id`=" . $row['emp_id'];
                    $result0=$conn->query($sql0);
                    $row0=$result0->fetch_assoc();


                    $jobType=jobTypeFormat($row['type']);
                    $totalSalary+=$row['salary'];
                    
                    echo "<tr><td>" . $row0['firstname'] . ' ' . $row0['lastname'] . "</td><td>" . $row0['email'] . "</td><td>" . $row['title'] . "</td><td> " . $row['description'] . "</td>
                    <td>" . $jobType . "</td><td>" . $row['mode'] . "</td><td>" . $row['location'] . "</td>
                    <td>" . $row['salary'] . "</td>
                    <td><button type='button' class='btn btn-link' onClick='resign(" . $row['job_id'] . ")'>Resign</button></td>
                    </tr>";

                }

                echo "<tr><td></td><td></td><td></td><td></td><td style='color:green;'>Total Salary:</td><td style='color:green;'>" . $totalSalary . "</td><td></td>";
                echo "</table>";
            }
        }

    ?>



    <div class="btn-group btn-group-lg mt-3">
    <button type="button" onClick="window.location='../index.php';" class="btn btn-success">Back</button>
    <!-- <button type="button" onClick="window.location='./check.php';" class="btn btn-primary">Check</button> -->
    </div>

    <div class="btn-group btn-group-lg mt-3">
    <button type="button" onClick="window.location='../logout.php';" class="btn btn-primary">Logout</button>
    <!-- <button type="button" onClick="window.location='./check.php';" class="btn btn-primary">Check</button> -->
    </div> 





    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
        <div class="modal-content">
        
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title" id='modelTitle'>Success</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body" id='modalBody'>
            
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal" id='closeModal'>Close</button>
            </div>
            
        </div>
        </div>
    </div>

    <button id='modalButton' type="button" class="btn btn-info btn-lg" style='display:none;' data-toggle="modal" data-target="#myModal">Open Modal</button>


</body>
</html>