<?php


$emp_id=$_POST['emp_id'];
// $emp_id=21;
$title=$_POST['title'];
$description=$_POST['description'];
$type=$_POST['type'];
$mode=$_POST['mode'];
$location=$_POST['location'];
$salary=$_POST['salary'];
$min_age_req=$_POST['min_age_req'];
$min_edu_req=$_POST['min_edu_req'];
$min_exp_req=$_POST['min_exp_req'];
$questions = $_POST['questions'];
$js_id=1;




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

$sql = "INSERT INTO `jobs` (emp_id, title, description, type, mode, location, salary, min_age_req, min_edu_req, min_exp_req, questions)
VALUES ('$emp_id', '$title', '$description', '$type', '$mode', '$location', $salary,'$min_age_req','$min_edu_req','$min_exp_req','$questions')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    header("Location:./index.php?success=true");
    die();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>