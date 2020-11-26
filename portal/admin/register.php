<?php


$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$age=$_POST['age'];
$email=$_POST['email'];
$referral=$_POST['referralcode'];
$password=$_POST['password1'];
$password2 = $_POST['password2'];


if($password!=$password2) {
  //throw error
  header("Location:index.php?passwordmismatch=1");
  die();
} else if ($referral=='') {
  header("Location:index.php?referralEmpty=1");
  die();
} else {

    //connecting to database
    require('../connect.php');
    
    // Create connection
    $conn = new mysqli($servername, $username, $pwd, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    //checking if referral code is valid
    $referralValid=false;
    $sqlRef = "SELECT `referral_code`,`admin_id` FROM `admins` WHERE `referral_code` IS NOT NULL";
    $referralResult = mysqli_query($conn,$sqlRef);
    while($row=mysqli_fetch_assoc($referralResult)) {
      if($row['referral_code']==$referral) {
        //matching referral code found

        //remove this referral code from database so it cannot be reused
        $deleteReferral = "UPDATE `admins` SET `referral_code`=NULL WHERE `admin_id`=" . $row['admin_id'];
        if(mysqli_query($conn,$deleteReferral)) {
          $referralValid=true;
        } else {
          echo "Failed to remove referral code from database.";
        }
      break;
      }
    }


    if($referralValid) {
      //checking if email already exists
      $sql0 = "SELECT count(`admin_id`) AS numAdmins FROM `admins` WHERE `email`='$email' LIMIT 1";
      $result=$conn->query($sql0);
      $row=mysqli_fetch_assoc($result);

        if($row['numAdmins']>0) {
          header("Location:index.php?emailexists=1");
          die();
        } 
        
        else {
            //if email doesn't already exist, register the guy

            //hashing the password
            $password=hash('sha256', $password);

            $sql = "INSERT INTO `admins` (firstname, lastname, age, email, password)
            VALUES ('$firstname', '$lastname', $age, '$email','$password')";
            
            if ($conn->query($sql) === TRUE) {
                echo "New admin created successfully";
                $sql="SELECT `admin_id` FROM `admins` WHERE `email`='$email' AND `firstname`='$firstname' AND `lastname`='$lastname'";
                $result=$conn->query($sql);

                if(mysqli_num_rows($result)==1) {
                    $row=mysqli_fetch_assoc($result);
                    $userid=$row['admin_id'];
                    session_start();
                    $_SESSION['user']=$userid;
                    $_SESSION['type']='admin';
                } else {
                  header("Location:index.php?unknownerror=1");
                  die();
                }
                
                header("Location:./panel/index.php?success=true");
                die();
            } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    } else {
      header("Location:index.php?referralEmpty=1");
      die();
    }
    
    $conn->close();
}
?>