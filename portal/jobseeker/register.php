<?php


$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$age=$_POST['age'];
$gender=$_POST['gender'];
$email=$_POST['email'];
$profession=$_POST['profession'];
$address=$_POST['address'];
$password=$_POST['password1'];
$password2 = $_POST['password2'];


if($password!=$password2) {
  //throw error
  header("Location:index.php?passwordmismatch=1");
  die();
} else if ($gender==-1) {
  header("Location:index.php?genderEmpty=1");
} else {

    //connecting to database
    $servername = "localhost:3306";
    $username = "root";
    $pwd = "root";
    $dbname = "portal";
    
    // Create connection
    $conn = new mysqli($servername, $username, $pwd, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    //checking if email already exists
    $sql0 = "SELECT count(`js_id`) AS numEmployees FROM `jobseekers` WHERE `email`='$email' LIMIT 1";
    $result=$conn->query($sql0);
    $row=mysqli_fetch_assoc($result);

      if($row['numEmployees']>0) {
        header("Location:index.php?emailexists=1");
        die();
      } 
      
      else {
          //if email doesn't already exist, register the guy

          //hashing the password
          $password=hash('sha256', $password);

          $sql = "INSERT INTO `jobseekers` (firstname, lastname, age, gender, email, profession, address, password)
          VALUES ('$firstname', '$lastname', $age, $gender, '$email', '$profession','$address','$password')";
          
          if ($conn->query($sql) === TRUE) {
              echo "New record created successfully";
              $sql="SELECT `js_id` FROM `jobseekers` WHERE `email`='$email' AND `firstname`='$firstname' AND `lastname`='$lastname'";
              $result=$conn->query($sql);

              if(mysqli_num_rows($result)==1) {
                  $row=mysqli_fetch_assoc($result);
                  $userid=$row['js_id'];
                  setcookie("user", $userid, time() + (86400 * 30), "/");
                  session_start();
                  $_SESSION['user']=$userid;
                  $_SESSION['type']='jobseeker';
              }

              header("Location:./panel/index.php");
              die();
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
      }
    
    $conn->close();
}
?>