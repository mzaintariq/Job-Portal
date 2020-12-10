<?php

require('../admin_verify.php');
require('../../connect.php');


$firstnameSet = array("John","Carl","Jake","Amy","Rosa","Raymond","Rachel");
$lastnameSet = array("Geller","Segan","Peralta","Santiago","Diaz","Holt","Green");
$emaildomainSet = array("@yahoo.com","@gmail.com","@hotmail.com");
$companySet = array("Tesla","Microsoft","Google","Alibaba","Nishat","Gourmet","Dell","Geo","FMH");
$companyTypeSet = array("Technology","Healthcare","Charity","Sports","News","Transportation");
$citySet = array("Lahore","Gujranwala","Karachi","Layyah","Skardu","Sahiwal","Peshawar","Quetta","Sheikhupura");
$password =hash('sha256', "mynameisroh");

$sql = "SELECT `email` FROM `employers` WHERE 1";
$result=$conn->query($sql);
$usedEmails = array("John100Carl100@yahoo.com"=>1);
while($row = $result->fetch_assoc()) {
    $usedEmails[$row['email']]=1;
}
//PHP Associative Arrays are implemented as hash tables


function generateValueSet() {
    $values = array("firstname"=>"","lastname"=>"","age"=>0,"gender"=>0,"email"=>"","companyname"=>"","companytype"=>"","password"=>"");

    global $firstnameSet, $lastnameSet, $emaildomainSet, $companySet,$companyTypeSet, $citySet, $password, $usedEmails;
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

    if(is_countable($companyTypeSet))
        $values['companytype']=$companyTypeSet[rand(0,count($companyTypeSet)-1)];

    //email
    //storing email so that there are no duplicate emails
    do {
        if(is_countable($emaildomainSet))
            $values['email']=$values['firstname'] . $values['lastname'] . $emaildomainSet[rand(0,count($emaildomainSet)-1)];
    } while (isset($usedEmails[$values['email']]));
    
    $userEmails[$values['email']]=1;
    
    if(is_countable($companySet))
        $values['companyname']=$companySet[rand(0,count($companySet)-1)];
    if(is_countable($citySet))
        $values['address']="Street " . strval(rand(1,99)) . ", House " . strval(rand(1,500)) . ", " . $citySet[rand(0,count($citySet)-1)];
    $values['password']=$password;

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

    $sql = "INSERT INTO `employers` (`firstname`,`lastname`,`age`,`gender`,`email`,`companyname`,`companytype`,`address`,`password`) 
    VALUES ('" . $values['firstname'] . "','" . $values['lastname'] . "'," . $values['age'] . "," . $values['gender'] . ",'" . $values['email'] . "','" . $values['companyname'] . "','" . $values['companytype'] . "','" . $values['address'] . "','" . $values['password'] . "')";

    $n=$i+1;
    if($conn->query($sql)) {
        echo "<tr><td>" . $n . "</td>
        <td>" . $values['firstname'] . "</td>
        <td>" . $values['lastname'] . "</td>
        <td>" . $values['age'] . "</td>
        <td>" . $values['gender'] . "</td>
        <td>" . $values['email'] . "</td>
        <td>" . $values['companyname'] . "</td>
        <td>" . $values['companytype'] . "</td>
        <td>" . $values['address'] . "</td>
        <td>" . $values['password'] . "</td>
        </tr>";
    } else {
        echo $sql;
    }
}
?>
</table>
</div>
</body>