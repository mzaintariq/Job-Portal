<?php
    require('../../js_verify.php');
    //this will make sure the user is logged in to access this page
    //put this require statement in the start of all PHP files
        
    require('../../../connect.php');

    $tableName='jobseekers';
    require('../../../prename.php');  
    //this just figures out whether to write "Mr." with the user's name or "Ms." based on their gender
    $error='';
    $errorClass='';
    $errorVisibility='none';

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
    <title>View My Jobs</title>
</head>

<body>
<div class='container pt-5'>
    <div class="jumbotron">
        <h1>Welcome<?php echo $prename . ' ' . $name; ?></h1>
        <h2>ID:<?php echo ' ' . $_SESSION['user']; ?></h1>
    </div>


    <h1>Your Jobs:</h1>
    <div class="alert alert-<?php echo $errorClass; ?>" role="alert" style="display:<?php echo $errorVisibility; ?>">
        <?php echo $error; ?>
    </div>
    
    <?php
        $sql = "SELECT `job_id`,`title`,`emp_id`,`type`,`mode`,`salary` FROM `jobseekers` WHERE `js_id` IN
        (SELECT `js_id` FROM `jobs` WHERE `emp_id`=" . $_SESSION['user'] . ")";

        $result = mysqli_query($conn,$sql);
        if($result==false) {
            die("Query failed.");
        }
        if(mysqli_num_rows($result)==0) {
            echo "<div class=\"alert alert-warning\" role=\"alert\"><i class=\"fas fa-exclamation-circle\"></i> You have no employees.</div>";
        } else {

            echo "<table class='table table-striped'>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Fire</th>
            </tr>";
            while($row=mysqli_fetch_assoc($result)) {
                $gender=returnGender($row['gender']);
                echo "<tr><td>" . $row['firstname'] . " " . $row['lastname'] . "</td>
                <td>" . $row['email'] . "</td><td>" . $row['age'] . "</td><td>" . $gender . "</td>
                <td><a class='btn btn-link' href='fire.php?js_id=" . $row['js_id'] . "'>Fire Employee</a></td>
                </tr>";
            }
            echo "</table>";
        }

    ?>
    <ul class="pagination">
       <li class="page-item"><a class="page-link" href="../index.php"><i class="fas fa-angle-left"></i> Go Back</a></li>
    </ul>

</body>
</html>