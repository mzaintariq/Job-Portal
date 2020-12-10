<?php

require('../admin_verify.php');
require('../../connect.php');


$firstnameSet = array("John","Carl","Jake","Amy","Rosa","Raymond","Rachel");
$lastnameSet = array("Geller","Segan","Peralta","Santiago","Diaz","Holt","Green");
$emaildomainSet = array("@yahoo.com","@gmail.com","@hotmail.com");
$professionSet = array("Dentist","Graphics Designer","Doctor","Web Developer","Carpenter","Painter","Translator","Engineer","Architect","Lawyer","Financial Advisor");
$citySet = array("Lahore","Gujranwala","Karachi","Layyah","Skardu","Sahiwal","Peshawar","Quetta","Sheikhupura");
$password =hash('sha256', "mynameisroh");

$sql = "SELECT `email` FROM `jobseekers` WHERE 1";
$result=$conn->query($sql);
$usedEmails = array("John100Carl100@yahoo.com"=>1);
while($row = $result->fetch_assoc()) {
    $usedEmails[$row['email']]=1;
}
//PHP Associative Arrays are implemented as hash tables


function generateValueSet() {
    $values = array("firstname"=>"","lastname"=>"","age"=>0,"gender"=>0,"email"=>"","profession"=>"","address"=>"","password"=>"","experience"=>0,"education"=>0,"employment_status"=>0);

    global $firstnameSet, $lastnameSet, $emaildomainSet, $professionSet, $citySet, $password, $usedEmails;
    //random firstname
    if(is_countable($firstnameSet))
        $values["firstname"] = $firstnameSet[rand(0,count($firstnameSet)-1)];
    $values["firstname"] .= strval(rand(100,99999999)); 

    //random lastname
    if(is_countable($lastnameSet))
        $values["lastname"] = $lastnameSet[rand(0,count($lastnameSet)-1)];
    $values["lastname"] .= strval(rand(100,99999999)); 

    $values['age']=rand(18,100);
    $values['gender']=rand(0,2);

    //email
    //storing email so that there are no duplicate emails
    do {
        if(is_countable($emaildomainSet))
            $values['email']=$values['firstname'] . $values['lastname'] . $emaildomainSet[rand(0,count($emaildomainSet)-1)];
    } while (isset($usedEmails[$values['email']]));
    
    $userEmails[$values['email']]=1;
    
    if(is_countable($professionSet))
        $values['profession']=$professionSet[rand(0,count($professionSet)-1)];
    if(is_countable($citySet))
        $values['address']="Street " . strval(rand(1,99)) . ", House " . strval(rand(1,500)) . ", " . $citySet[rand(0,count($citySet)-1)];
    $values['password']=$password;
    $values['experience']=rand(1,20);
    $values['education']=rand(4,20);

    return $values;
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
</head>

<body>
<div class='container mt-3'>
<table class='table table-striped'>
<?php

$numRows = $_GET['numRows'];




for($i=0;$i<$numRows;$i++) {
    $values = generateValueSet();

    $sql = "INSERT INTO `jobseekers` (`firstname`,`lastname`,`age`,`gender`,`email`,`profession`,`address`,`password`,`experience`,`education`,`employment_status`) 
    VALUES ('" . $values['firstname'] . "','" . $values['lastname'] . "'," . $values['age'] . "," . $values['gender'] . ",'" . $values['email'] . "','" . $values['profession'] . "','" . $values['address'] . "','" . $values['password'] . "'," . $values['experience'] . "," . $values['education'] . "," . $values['employment_status'] . ")";

    $n=$i+1;
    if($conn->query($sql)) {
        echo "<tr><td>" . $n . "</td>
        <td>" . $values['firstname'] . "</td>
        <td>" . $values['lastname'] . "</td>
        <td>" . $values['age'] . "</td>
        <td>" . $values['gender'] . "</td>
        <td>" . $values['email'] . "</td>
        <td>" . $values['profession'] . "</td>
        <td>" . $values['address'] . "</td>
        <td>" . $values['password'] . "</td>
        <td>" . $values['experience'] . "</td>
        <td>" . $values['education'] . "</td>
        </tr>";
    } else {
        echo $sql;
    }
}
?>
</table>
</div>
</body>