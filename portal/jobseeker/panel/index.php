<?php
    require('../js_verify.php');
    //this will make sure the user is logged in to access this page
    //put this require statement in the start of all PHP files
        
    require('../../connect.php');
        
    $tableName='jobseekers';
    require('../../prename.php');  
    //this just figures out whether to write "Mr." with the user's name or "Ms." based on their gender

    //getting number of notifications
    $sqlNotif = "SELECT count(`notif_id`) as numNotif FROM `notifications` WHERE `js_id`=" . $_SESSION['user'];
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
    <title>Jobseeker Panel</title>
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
        <!--Browse Jobs-->
        <div class="card bg-primary ptr" onClick="window.location='view_job/index.php';">
            <div class="card-body text-center">
                <p class="card-text text-light">Browse & Apply for Jobs</p>
            </div>
        </div>

        <!--View My Jobs-->
        <div class="card bg-warning ptr" onClick="window.location='my_jobs/index.php';">
            <div class="card-body text-center">
                <p class="card-text text-light">View My Jobs</p>
            </div>
        </div>

        <!--View Employers-->
        <div class="card bg-primary ptr"  onClick="window.location='view_employer/index.php';">
            <div class="card-body text-center">
                <p class="card-text text-light">View Employers</p>
            </div>
        </div>

        <!--Logout-->
        <div class="card bg-danger ptr" onClick="window.location='logout.php';">
            <div class="card-body text-center">
                <p class="card-text text-light">Logout</p>
            </div>
        </div>

        <!--View Notifications-->
        <div class="card bg-info ptr" onClick="window.location='notifications/index.php';">
            <div class="card-body text-center">
                <p class="card-text text-light">View Notifications <span class="badge badge-pill badge-light">
                <?php echo $numNotifications; ?>
                </span></p>
            </div>
        </div>

        

    </div>

    
</div>

</body>
</html>