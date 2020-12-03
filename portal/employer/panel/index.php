<?php
    
    require('../emp_verify.php');
    //if user was not logged in, he would be redirected to login page and the following lines of code would not run
    //note that the session_start() command is included in above file
    
    require('../../connect.php');
        
    $tableName='employers';
    require('../../prename.php');  
    //this just figures out whether to write "Mr." with the user's name or "Ms." based on their gender


    //getting number of notifications
    $sqlNotif = "SELECT count(`notif_id`) as numNotif FROM `notifications` WHERE `emp_id`=" . $_SESSION['user'];
    $result = mysqli_query($conn,$sqlNotif);
    $numNotifications='';
    if($result==false) {
        $numNotifications='N/A';
    } else {
        $row=mysqli_fetch_assoc($result);
        $numNotifications=$row['numNotif'];
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
    <style>.ptr{cursor:pointer;}</style>
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

    <div class="card-columns">
        <!--Post Job-->
        <div class="card bg-warning ptr"  onClick="window.location='post_job/index.php';">
            <div class="card-body text-center">
                <p class="card-text text-light">Post Job</p>
            </div>
        </div>

        <!--View Job Posts-->
        <div class="card bg-primary ptr"  onClick="window.location='view_app/index.php';">
            <div class="card-body text-center">
                <p class="card-text text-light">View Job Posts</p>
            </div>
        </div>

        <!--View Job Seekers-->
        <div class="card bg-primary ptr"  onClick="window.location='view_js/index.php';">
            <div class="card-body text-center">
                <p class="card-text text-light">View Job Seekers</p>
            </div>
        </div>

        <!--View Employees-->
        <div class="card bg-primary ptr"  onClick="window.location='view_employees/index.php';">
            <div class="card-body text-center">
                <p class="card-text text-light">View My Employees</p>
            </div>
        </div>

        <!--View Notifications-->
        <div class="card bg-info ptr"  onClick="window.location='notifications/index.php';">
            <div class="card-body text-center">
                <p class="card-text text-light">View Notifications <span class="badge badge-pill badge-light">
                <?php echo $numNotifications; ?>
                </span></p>
            </div>
        </div>

        <!--Logout-->
        <div class="card bg-danger ptr" onClick="window.location='logout.php';">
            <div class="card-body text-center">
            <p class="card-text text-light">Logout</p>
            </div>
        </div>
    </div>

    <!--<div class="btn-group btn-group-lg mt-3">
    <button type="button" onClick="window.location='logout.php';" class="btn btn-primary">Logout</button>
    <button type="button" onClick="window.location='post_job/index.php';" class="btn btn-primary">Post Job</button>
    <button type="button" onClick="window.location='view_app/index.php';" class="btn btn-primary">View Posts</button>
    <button type="button" onClick="window.location='view_js/index.php';" class="btn btn-primary">Job Seekers</button>
    <button type="button" onClick="window.location='view_employees/index.php';" class="btn btn-primary">View My Employees</button>
    </div> -->

    <!-- <div class="btn-group btn-group-lg mt-3">
    <button type="button" onClick="window.location='view_app/index.php';" class="btn btn-success">View Posts</button>
    </div>  -->

    <!-- <button type="button" onClick="window.location='./check.php';" class="btn btn-primary">Check</button> -->
    
</div>

</body>
</html>

