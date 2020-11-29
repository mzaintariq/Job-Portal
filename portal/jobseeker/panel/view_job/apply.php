<?php

    require('../../js_verify.php');
    //through this file,
    //if user was not logged in, he would be redirected to login page and the following lines of code would not run
    //note that the session_start() command is included in above file

    require('../../../connect.php');
    //load database connection credentials
        
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
    <title>Post Job - Employer</title>

    <?php
    $error='';
    $emailClass='';
    $genderClass='';
        // if (isset($_GET['success']) && $_GET['emailexists']==1) {
        //     $error="New record created successfully";
        // }
        if (isset($_GET['success']) && $_GET['success']==TRUE) {
            $error="New record created successfully";
        }
    ?>

</head>

<body>

<div class='container'>
<p class='mt-3'>Welcome <?php echo $prename . ' ' . $name; ?></p>
<h1 class="mb-4">
    Apply for Job
</h1>

<?php echo $error; ?> 
<form action="job_post.php" method="post">
    <h3>Statement</h3>
    <div class="input-group mb-3">
        <!-- <label for="questions">Questions:</label> -->
        <textarea name="questions" class="form-control" rows="5" placeholder="Why should we hire you?"></textarea>
    </div>

    <div class="input-group mb-3">
        <!-- <label for="questions">Questions:</label> -->
        <textarea name="questions" class="form-control" rows="5" placeholder="Questions for Applicant"></textarea>
    </div>

</form>

<button type="submit" class="form-control btn-success"><i class="fas fa-paper-plane"></i> Submit</button>

<div class='container pt-5'>
    <div class="btn-group btn-group-lg mt-3">
    <button type="button" onClick="window.location='index.php';" class="btn btn-success">Back</button>
    </div> 

    <div class="btn-group btn-group-lg mt-3">
    <button type="button" onClick="window.location='../logout.php';" class="btn btn-primary">Logout</button>
    <!-- <button type="button" onClick="window.location='./check.php';" class="btn btn-primary">Check</button> -->
    </div> 
</div>
</div>

</body>
    
</form>

