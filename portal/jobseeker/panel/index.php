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
    <title>Employer Panel</title>
</head>
<body>
    <h1>Welcome<?php echo $prename . ' ' . $name; ?></h1>

    <a href='logout.php'>Click here to logout</a>
</body>
</html>

<?php
    }
?>