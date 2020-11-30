<?php

    require('../../js_verify.php');
    //through this file,
    //if user was not logged in, he would be redirected to login page and the following lines of code would not run
    //note that the session_start() command is included in above file

    require('../../../connect.php');
    //load database connection credentials and check if connection was successful. Create $conn variable.
        
    $tableName='jobseekers';
    require('../../../prename.php');  
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
        if(!isset($_GET['title']) || !isset($_GET['questions']) || !isset($_GET['job_id'])) {
            header('Location:index.php');
            die();
        }
    ?>

</head>

<body>

<div class='container'>
<p class='mt-3'>Welcome <?php echo $prename . ' ' . $name; ?></p>
<h3 class="mb-4">
    Apply for <?php echo $_GET['title']; ?>
</h3>

<?php echo $error; ?> 
<form action="insertApplication.php" method="post">

    <!--user gives his statement here-->
    <p>Why should we hire you?</p>
        <div class="input-group mb-3">
            <textarea name="statement" class="form-control" rows="5" placeholder="Please put your statement here"></textarea>
        </div>

    <!--printing the questions so that the user knows that to answer-->
    <p><?php echo $_GET['questions']; ?></p>

        <div class="input-group mb-3">
            <textarea name="answers" class="form-control" rows="5" placeholder="Please answer here"></textarea>
        </div>

    <!--this hidden input field takes the job id to the insertApplication.php file-->
    <input type='hidden' name='job_id' value='<?php echo $_GET["job_id"]; ?>'>

    <button type="submit" class="form-control btn-success"><i class="fas fa-paper-plane"></i> Submit</button>

</form>



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

