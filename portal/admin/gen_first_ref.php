<?php

require('../connect.php');
$referralCode='';

function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$conn = new mysqli($servername, $username, $pwd, $dbname);
    // Check connection
    if ($conn->connect_error) {
        header('Location:../login.php?connectionfailed=1');
        die("Connection failed: " . $conn->connect_error);
    } else {
        $referralCode=generateRandomString(10);
        echo "Copy This Referral Code: <input type='text' value='". $referralCode . "'>";
    }


$password=hash('sha256', 'example');


$sql = "INSERT INTO `admins` (firstname, lastname, age, email, password,referral_code)
VALUES ('Rohan', 'Hussain', 21, 'rohanhussain1@yahoo.com','$password','$referralCode')";

if(mysqli_query($conn,$sql)) {
    echo "<br><br>All Successful.";
} else {
    echo "Error Occured.";
}


?>