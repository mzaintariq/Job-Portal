<?php

    require('../../emp_verify.php');
    //through this file,
    //if user was not logged in, he would be redirected to login page and the following lines of code would not run
    //note that the session_start() command is included in above file

    require('../../../connect.php');
    //load database connection credentials and check if connection was successful. Create $conn variable.
        
    $tableName='employers';
    require('../../../prename.php');  
    //this just figures out whether to write "Mr." with the user's name or "Ms." based on their gender
    
    $error='';
    $errorClass='';
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
        <h1>Job: <?php echo $_GET["job_id"]; ?></h1>
        <h2>Application # <?php echo $_GET["app_id"]; ?></h2>
        <h3>Details Below</h3>
    </div>

    <div class="alert <?php echo $errorClass; ?>" role="alert">
        <?php echo $error; ?>   <!--display the error message that came after user applied for job-->
    </div>


    <?php
        $sql2 = "SELECT * FROM `jobseekers` WHERE js_id = '". $_GET["js_id"]."'";
        $result2 = mysqli_query($conn,$sql2);
        $row2 = mysqli_fetch_assoc($result2);

        $firstname = $row2['firstname'];
        $lastname = $row2['lastname'];
        $age = $row2['age'];
        switch($row['gender']) {
            case 0:
                $gender='Male';
            break;
            
            case 1:
                $gender='Female';
            break;

            default:
                $gender='Unknown';
            break;
        }
        $email = $row2['email'];
        $profession = $row2['profession'];
        $experience = $row2['experience'];
        $education = $row2['education'];
    ?>

    <div>
        <h2>Name: <b><?php echo $firstname . ' ' . $lastname; ?></b></h2>
        <h2>Age: <b><?php echo $age; ?></b></h2>
        <h2>Gender: <b><?php echo $gender; ?></b></h2>
        <h2>Email: <b><?php echo $email; ?></b></h2>
        <h2>Profession: <b><?php echo $profession; ?></b></h2>
        <h2>Experience: <b><?php echo $experience; ?></b></h2>
        <h2>Education: <b><?php echo $education; ?></b></h2>
    </div>

    <?php
        $sql2 = "SELECT * FROM `applications` WHERE app_id = '". $_GET["app_id"]."'";
        $result2 = mysqli_query($conn,$sql2);
        $row2 = mysqli_fetch_assoc($result2);

        $statement = $row2['statement'];
        $answers = $row2['answers'];

    ?>

    <div>
        <!-- <h2>Questions: <b><?php echo $title . ' ' . $lastname; ?></b></h2> -->
        <h2>Statement: <b><?php echo $statement; ?></b></h2>
        <h2>Answers: <b><?php echo $answers; ?></b></h2>
    </div>

    <form action="accept_app.php" method="post">
    <div class='form-group'>
    <!--Values-->
        <input type="hidden" value="<?php echo $_GET["js_id"]; ?>" name="js_id" />
        <input type="hidden" value="<?php echo $_GET["job_id"]; ?>" name="job_id" />
        <input type="hidden" value="<?php echo $_GET["app_id"]; ?>" name="app_id" />

        <button type="submit" class="form-control btn-success"><i class="fas fa-paper-plane"></i> Accept</button>
    </div>
    
</form>

    <div class="btn-group btn-group-lg mt-3">
        <!-- <td><a href='apps.php?job_id= . $job_id ."'>Back</a></td> -->
        <!-- <button type="button" onClick="window.location='./apps.php';" value="<?php echo $_GET["job_id"]; ?>" name="job_id" class="btn btn-success">Back</button> -->
        <button type="button" onClick="window.location='./index.php';" class="btn btn-success">Back</button>
    </div>


    <div class="btn-group btn-group-lg mt-3">
        <button type="button" onClick="window.location='../logout.php';" class="btn btn-primary">Logout</button>
    </div> 
</div>

</body>
</html>