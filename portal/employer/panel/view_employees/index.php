<?php
    require('../../emp_verify.php');
    //this will make sure the user is logged in to access this page
    //put this require statement in the start of all PHP files
        
    require('../../../connect.php');

    $tableName='employers';
    require('../../../prename.php');  
    //this just figures out whether to write "Mr." with the user's name or "Ms." based on their gender


    function returnGender($genderNumber) {
        $gender='';
        switch($genderNumber) {
            case 0:
                $gender='Male';
            break;
            
            case 1:
                $gender='Female';
            break;
            
            case 2:
                $gender='Other';
            break;

            default:
                $gender='Unknown';
            break;
        }
        return $gender;
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
    <title>View My Employees</title>
</head>

<body>
<div class='container pt-5'>
    <div class="jumbotron">
        <h1>Welcome<?php echo $prename . ' ' . $name; ?></h1>
        <h2>ID:<?php echo ' ' . $_SESSION['user']; ?></h1>
    </div>


    <h1>Employees:</h1>
    
    <?php
        $sql = "SELECT `firstname`,`lastname`,`email`,`age`,`gender` FROM `jobseekers` WHERE `js_id` IN
        (SELECT `js_id` FROM `jobs` WHERE `emp_id`=" . $_SESSION['user'] . ")";

        $result = mysqli_query($conn,$sql);
        if($result==false) {
            die("Query failed.");
        }

        echo "<table class='table table-striped'>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Age</th>
            <th>Gender</th>
        </tr>";
        while($row=mysqli_fetch_assoc($result)) {
            $gender=returnGender($row['gender']);
            echo "<tr><td>" . $row['firstname'] . " " . $row['lastname'] . "</td>
            <td>" . $row['email'] . "</td><td>" . $row['age'] . "</td><td>" . $gender . "</td>
            </tr>";
        }
        echo "</table>"

    ?>
    <ul class="pagination">
       <li class="page-item"><a class="page-link" href="../index.php">Go Back</a></li>
    </ul>

</body>
</html>