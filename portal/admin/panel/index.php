<?php
    
    require('../admin_verify.php');
    //if user was not logged in, he would be redirected to login page and the following lines of code would not run
    //note that the session_start() command is included in above file
    
    require('../../connect.php');  
        
    $sql = "SELECT `firstname` FROM `admins` WHERE `admin_id`=" . $_SESSION['user'] . " LIMIT 0,1";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)<1) {
        header('Location:../login.php?connectionfailed=1');
        die();
    }
    $row=mysqli_fetch_assoc($result);

    $name=$row['firstname'];
        
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

    <script src="referralCode.js"></script>
    <style>.ptr{cursor:pointer;}</style>
    <title>Employer Panel</title>
</head>

<body>
<div class='container pt-5'>
    <div class="jumbotron">
    <h1>Welcome <?php echo $name; ?></h1>

    
    <!-- <p>Creators: Rohan, Zain, and Zahab from LUMS</p> -->
    </div>



    <div class="card-columns">
        <div class="card bg-primary ptr" onClick="generateReferralCode()">
            <div class="card-body text-center">
            <p class="card-text text-light">Generate Referral Code</p>
            <div id="refDiv" style='display:none;'>
                <label for="referralCode">Referral Code:</label>
                <input name="referralCode" class='form-control' id='referralCode'>
            </div>
            </div>
        </div>
        <div class="card bg-warning ptr" onClick="window.location='viewemployers.php';">
            <div class="card-body text-center">
            <p class="card-text">View All Employers</p>
            </div>
        </div>
        <div class="card bg-danger ptr" onClick="window.location='logout.php';">
            <div class="card-body text-center">
            <p class="card-text text-light">Logout</p>
            </div>
        </div>
        
    </div>


    
</div>

</body>

</html>

