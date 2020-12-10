<?php

require('../admin_verify.php');
require('../../connect.php');

$jobSet=array();
$jobseekerSet=array();

//getting all employer IDs
$sql = "SELECT `job_id` FROM `jobs` WHERE `job_id`>2"; 
$result=$conn->query($sql);
while($row=$result->fetch_assoc()) {
    array_push($jobSet,$row['job_id']);
}

//getting all jobseeker IDs
$sql = "SELECT `js_id` FROM `jobseekers` WHERE `js_id`>23"; 
$result=$conn->query($sql);
while($row=$result->fetch_assoc()) {
    array_push($jobseekerSet,$row['js_id']);
}

while(count($jobSet)>0 && count($jobseekerSet)>0) {
    $values=array();
    $values['job_id']=array_pop($jobSet);
    $values['js_id']=array_pop($jobseekerSet);
    $values['statement']="This is a sample statement.";

    $sql = "INSERT INTO `applications` (`job_id`,`js_id`,`statement`) VALUES (" . $values['job_id'] . "," . $values['js_id'] . ",'" . $values['statement'] . "')";
    if ($conn->query($sql))
        echo "done";
    else
        echo $sql;
}

?>