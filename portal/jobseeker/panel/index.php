<?php
    require('../js_verify.php');
    //this will make sure the user is logged in to access this page
    //put this require statement in the start of all PHP files
        
    require('../../connect.php');
        
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
    <button type="button" onClick="window.location='view_job/index.php';" class="btn btn-success">View Jobs</button>
    </div> 

    <div class="btn-group btn-group-lg mt-3">
    <button type="button" onClick="window.location='logout.php';" class="btn btn-primary">Logout</button>
    <!-- <button type="button" onClick="window.location='./check.php';" class="btn btn-primary">Check</button> -->
    </div> 
</div>

</body>
</html>