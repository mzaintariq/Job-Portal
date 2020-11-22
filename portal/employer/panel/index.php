<?php
    session_start();
    if(!isset($_SESSION['user']) || !isset($_COOKIE['user'])) {
        header("Location:./index.php");
        die();
    } else if ($_SESSION['type']=='jobseeker') {
        echo "You have no access here. Please leave.";
        die();
    } else {
        $servername = "localhost:3306";
        $username = "root";
        $pwd = "root";
        $dbname = "portal";
        
        // Create connection
        $conn = new mysqli($servername, $username, $pwd, $dbname);
        // Check connection
        if ($conn->connect_error) {
            header('Location:login.php?connectionfailed=1');
            die("Connection failed: " . $conn->connect_error);
        } else {
            $sql = "SELECT `firstname`,`gender` FROM `employers` WHERE `emp_id`=" . $_SESSION['user'] . " LIMIT 0,1";
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
    <a href="logout.php">Click here to logout</a>

</body>
</html>

<?php
    }
?>