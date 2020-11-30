<?php
    
    require('../emp_verify.php');
    //if user was not logged in, he would be redirected to login page and the following lines of code would not run
    //note that the session_start() command is included in above file
    
    require('../../connect.php');
        
    $tableName='employers';
    require('../../prename.php');  
    //this just figures out whether to write "Mr." with the user's name or "Ms." based on their gender

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

    <div class="btn-group btn-group-lg mt-3">
    <button type="button" onClick="window.location='logout.php';" class="btn btn-primary">Logout</button>
    <button type="button" onClick="window.location='post_job/index.php';" class="btn btn-primary">Post Job</button>
    <button type="button" onClick="window.location='view_app/index.php';" class="btn btn-primary">View Posts</button>
    <button type="button" onClick="window.location='view_js/index.php';" class="btn btn-primary">Job Seekers</button>
    <button type="button" onClick="window.location='view_employees/index.php';" class="btn btn-primary">View My Employees</button>


    <!-- <div class="btn-group btn-group-lg mt-3">
    <button type="button" onClick="window.location='view_app/index.php';" class="btn btn-success">View Posts</button>
    </div>  -->

    <!-- <button type="button" onClick="window.location='./check.php';" class="btn btn-primary">Check</button> -->
    </div> 
</div>

</body>
</html>

