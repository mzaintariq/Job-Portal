<?php
    require('../../emp_verify.php');
    //this will make sure the user is logged in to access this page
    //put this require statement in the start of all PHP files
        
    require('../../../connect.php');

    $sql = "UPDATE `jobs` SET `js_id`=NULL WHERE `emp_id`=" . $_SESSION['user'] . " AND `js_id`=" . $_GET['js_id'];
    $result = mysqli_query($conn,$sql);
    if($result) {
        header('Location:index.php?firesuccess=1');
    } else {
        header('Location:index.php?firesuccess=1');
    }

?>