<?php

$servername = "localhost:3306";
$username = "root";
$pwd = "";
$dbname = "portal";

// Create connection
$conn = new mysqli($servername, $username, $pwd, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>