<?php

    require('../admin_verify.php');
    require('../../connect.php');
    $referralCode='';

    $conn = new mysqli($servername, $username, $pwd, $dbname);
    // Check connection
    if ($conn->connect_error) {
        header('Location:../login.php?connectionfailed=1');
        die("Connection failed: " . $conn->connect_error);
    } else {

        function generateRandomString($length) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        $referralCode=generateRandomString(10);
        $sql = "UPDATE `admins` SET `referral_code`='$referralCode' WHERE `admin_id`=" . $_SESSION['user'];
        
        if(mysqli_query($conn,$sql)) {
            echo $referralCode;
        } else {
            echo "Error. Try Again.";
        }
    
    }
?>