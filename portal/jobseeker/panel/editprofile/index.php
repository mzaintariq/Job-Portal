<?php
    require('../../js_verify.php');
    require('../../../connect.php');

    $tableName='jobseekers';
    require('../../../prename.php');


    $errorVisibility='none';
    $errorClass='';
    $error='';
    if(isset($_GET['invalid']) || isset($_GET['success']) || isset($_GET['failure'])) {
        $errorVisibility='block';
        if(isset($_GET['invalid']) && $_GET['invalid']==1) {
            $errorClass='warning';
            $error='<i class="fas fa-exclamation-triangle"></i> Invalid input. Please input valid information.';
        } else if (isset($_GET['success']) && $_GET['success']==1) {
            $errorClass='success';
            $error='<i class="fas fa-check-circle"></i> Successfully updated information.';
        } else if (isset($_GET['failure']) && $_GET['failure']==1) {
            $errorClass='danger';
            $error='<i class="fas fa-exclamation-triangle"></i> Failed to update information in the database. There was an unknown error.';
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
    <title>Edit Profile - Jobseeker Panel</title>

    <!--local script-->
    <script src='editProfile.js'></script>
</head>

<body>
    <div class='container pt-5'>
        <div class="jumbotron">
        <h3>Welcome<?php echo $prename . ' ' . $name; ?></h3>
        <h1>Edit Profile</h1>
    </div>

    <div class="alert alert-<?php echo $errorClass; ?>" role="alert" style="display:<?php echo $errorVisibility; ?>">
        <?php echo $error; ?>
    </div>

    <table class='table table-striped'>
    <thead>
        <tr>
            <th>ATTRIBUTE</th>
            <th>VALUE</th>
            <th>ACTION</th>
        </tr>
    </thead>
    <?php

    $sql = "SELECT * FROM `jobseekers` WHERE `js_id`=" . $_SESSION['user'] . " LIMIT 0,1";
    $result = $conn->query($sql);

    if($result!=false && $result->num_rows==1) {
        while($row=$result->fetch_assoc()) {

            switch($row['gender']) {
                case 0:
                    $gender='Male';
                break;
                
                case 1:
                    $gender='Female';
                break;
    
                default:
                    $gender='Other';
                break;
            }

            echo "<tr><td>ID</td><td>" . $row['js_id'] . "</td>
                <td>Fixed</td></tr>";
            echo "<tr><td>FIRSTNAME</td><td id='firstname'>" . $row['firstname'] . "</td>
                <td><button type='button' class='btn btn-link' onClick=\"editProfile('firstname'," . $row['js_id'] . ",'" . $row['firstname'] . "')\">Edit</button></td></tr>";
            echo "<tr><td>LASTNAME</td><td id='lastname'>" . $row['lastname'] . "</td>
                <td><button type='button' class='btn btn-link' onClick=\"editProfile('lastname'," . $row['js_id'] . ",'" . $row['lastname'] . "')\">Edit</button></td></tr>";
            echo "<tr><td>AGE</td><td id='age'>" . $row['age'] . "</td>
                <td><button type='button' class='btn btn-link' onClick=\"editProfile('age'," . $row['js_id'] . "," . $row['age'] . ")\"'>Edit</button></td></tr>";
            echo "<tr><td>GENDER</td><td id='gender'>" . $gender . "</td>
                <td><button type='button' class='btn btn-link' onClick=\"editProfile('gender'," . $row['js_id'] . ",'" . $gender . "')\">Edit</button></td></tr>";
            echo "<tr><td>PROFESSION</td><td id='profession'>" . $row['profession'] . "</td>
                <td><button type='button' class='btn btn-link' onClick=\"editProfile('profession'," . $row['js_id'] . ",'" . $row['profession'] . "')\">Edit</button></td></tr>";
            echo "<tr><td>ADDRESS</td><td id='address'>" . $row['address'] . "</td>
                <td><button type='button' class='btn btn-link' onClick=\"editProfile('address'," . $row['js_id'] . ",'" . $row['address'] . "')\">Edit</button></td></tr>";
            echo "<tr><td>EMAIL</td><td id='email'>" . $row['email'] . "</td>
                <td>Fixed</td></tr>";
        }
    }
    ?>
    </table>

    <div class="btn-group btn-group-lg mt-3">
    <button type="button" onClick="window.location='../index.php';" class="btn btn-success">Back</button>
    <!-- <button type="button" onClick="window.location='./check.php';" class="btn btn-primary">Check</button> -->
    </div>

    <div class="btn-group btn-group-lg mt-3">
    <button type="button" onClick="window.location='../logout.php';" class="btn btn-primary">Logout</button>
    <!-- <button type="button" onClick="window.location='./check.php';" class="btn btn-primary">Check</button> -->
    </div> 

</body>