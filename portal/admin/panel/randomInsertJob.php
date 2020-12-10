<?php

require('../admin_verify.php');
require('../../connect.php');


$titleSet = array("Graphics Designed Required","Web Developer Required","Carpenter Required","Painter Required","Translator Required","Engineer Required","Lawyer Required");
$typeSet=array("pt","ft");
$modeSet=array("online","offline");
$citySet = array("Lahore","Gujranwala","Karachi","Layyah","Skardu","Sahiwal","Peshawar","Quetta","Sheikhupura");
$password =hash('sha256', "mynameisroh");
$employerSet = array();
$jobseekerSet = array();

//getting all employer IDs
$sql = "SELECT `emp_id` FROM `employers` WHERE `emp_id`>20"; 
$result=$conn->query($sql);
while($row=$result->fetch_assoc()) {
    array_push($employerSet,$row['emp_id']);
}

//getting all jobseeker IDs
$sql = "SELECT `js_id` FROM `jobseekers` WHERE `js_id`>23"; 
$result=$conn->query($sql);
while($row=$result->fetch_assoc()) {
    array_push($jobseekerSet,$row['js_id']);
}


function generateValueSet() {
    $values = array("description"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sit amet blandit est. Fusce rhoncus dignissim enim et placerat. Donec elit mi, dictum sit amet risus tempor, sagittis dignissim mi.");

    global $titleSet, $employerSet, $jobseekerSet, $typeSet, $modeSet, $citySet, $password, $usedEmails;

    if(count($employerSet)>0)
        $values['emp_id']=array_pop($employerSet);

    if(count($jobseekerSet)>0)
        $values['js_id']=array_pop($jobseekerSet);

    //random title
    if(is_countable($titleSet))
        $values["title"] = $titleSet[rand(0,count($titleSet)-1)];
    $values["title"] .= strval(rand(100,99999999)); 

    $values['type']=$typeSet[rand(0,1)];
    $values['mode']=$modeSet[rand(0,1)];
    $values['location']=$citySet[rand(0,count($citySet)-1)];

    //salary calculation in whole numbers
    $values['salary']=rand(1000,1000000);
    $n=$values['salary']%1000;
    $values['salary']=$values['salary']-$n;

    $values['min_age_req']=0;
    $values['min_edu_req']=0;
    $values['min_exp_req']=0;

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


for($i=0;$i<9990;$i++) {
    $values = generateValueSet();

    $sql = "INSERT INTO `jobs` (`emp_id`,`js_id`,`title`,`description`,`type`,`mode`,`location`,`salary`,`min_age_req`,`min_edu_req`,`min_exp_req`) 
    VALUES (" . $values['emp_id'] . "," . $values['js_id'] . ",'" . $values['title'] . "','" . $values['description'] . "','" . $values['type'] . "','" . $values['mode'] . "','" . $values['location'] . "'," . $values['salary'] . "," . $values['min_age_req'] . "," . $values['min_edu_req'] . "," . $values['min_exp_req'] . ")";

    $n=$i+1;
    if($conn->query($sql)) {
        echo "<tr><td>" . $n . "</td>
        <td>" . $values['emp_id'] . "</td>
        <td>" . $values['js_id'] . "</td>
        <td>" . $values['title'] . "</td>
        <td>" . $values['type'] . "</td>
        <td>" . $values['mode'] . "</td>
        <td>" . $values['location'] . "</td>
        <td>" . $values['salary'] . "</td>
        <td>" . $values['min_age_req'] . "</td>
        <td>" . $values['min_edu_req'] . "</td>
        <td>" . $values['min_exp_req'] . "</td>
        </tr>";
    } else {
        echo $sql;
    }
    //echo $n . ' ';
}
?>
</table>
</div>
</body>