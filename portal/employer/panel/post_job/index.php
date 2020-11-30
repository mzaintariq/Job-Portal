<?php

    require('../../emp_verify.php');
    //through this file,
    //if user was not logged in, he would be redirected to login page and the following lines of code would not run
    //note that the session_start() command is included in above file

    require('../../../connect.php');
    //load database connection credentials
        
        
    $tableName='employers';
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
    ?>

</head>

<body>
<div class='container'>
<p class='mt-3'>Welcome <?php echo $prename . ' ' . $name; ?></p>
<h1 class="mb-4">
    Post a Job
</h1>

<?php echo $error; ?> 
<form action="job_post.php" method="post">
    <div class='form-group'>
    <!--Employer ID-->
        <input type="hidden" value="<?php echo $_SESSION['user']; ?>" name="emp_id" />
    <!--Job Title-->
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Title</span>
            </div>
            <input type="text" name="title" class="form-control" placeholder="Job Title" required>
        </div>
    <!--Job Description-->
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Description</span>
            </div>
            <input type="text" name="description" class="form-control" placeholder="Job Description" required>
        </div>
    <!--Job Type and Mode-->
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Job Type</span>
            </div>
            <select name="type" class="form-control" id="sel1" required>
                <option value="" selected>--Select a Type--</option>
                <option value="pt">Part Time</option>
                <option value="ft">Full Time</option>
            </select>
        
            <div class="input-group-prepend">
                <span class="input-group-text">Job Mode</span>
            </div>
            <select name="mode" class="form-control" id="sel1" required>
                <option value="" selected>--Select a Mode--</option>
                <option value="online">Online</option>
                <option value="offline">Offline</option>
                <option value="hybrid">Hybrid</option>
            </select>
        </div>

    <!--Location and Salary-->
        <div class="input-group mb-3">
            <input type="text" name="location" class="form-control" placeholder="Location" required>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Salary (PKR)</span>
            </div>
            <input type="number" name="salary" class="form-control" placeholder="Salary" required>
            <!-- <div class="input-group-append">
                <span class="input-group-text"> Rs </span>
            </div> -->
            <div class="input-group-prepend">
                <span class="input-group-text">Age (Years)</span>
            </div>
            <input type="number" name="min_age_req" class="form-control" placeholder="Minimum Age Required" required>
            <!-- <div class="input-group-append">
                <span class="input-group-text"> Years </span>
            </div> -->
        </div>
        <div class="input-group mb-3">
            <!-- <input type="number" name="min_age_req" class="form-control" placeholder="Minimum Age Required" required> -->
            <div class="input-group-prepend">
                <span class="input-group-text">Education (Years)</span>
            </div>
            <input type="number" name="min_edu_req" class="form-control" placeholder="Minimum Education Required" required>
            <div class="input-group-prepend">
                <span class="input-group-text">Experience (Years)</span>
            </div>
            <input type="number" name="min_exp_req" class="form-control" placeholder="Minimum Experience Required" required>
            <!-- <div class="input-group-append">
                <span class="input-group-text"> ______ Years </span>
            </div> -->
        </div>

    <!--Questions-->
        <!-- <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Additional Questions</span>
            </div>
            <input type="text" name="questions" class="form-control" placeholder="Questions">
        </div> -->
        <div class="input-group mb-3">
            <!-- <label for="questions">Questions:</label> -->
            <textarea name="questions" class="form-control" rows="5" placeholder="Questions for Applicant"></textarea>
        </div>

        <button type="submit" class="form-control btn-success"><i class="fas fa-paper-plane"></i> Post</button>
        <button type="button" onClick="window.location='../index.php';" class="btn btn-primary">Back</button>
    </div>
    
</form>

