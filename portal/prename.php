<?php
        if($tableName=='jobseekers')
            $idType='js_id';
        else
            $idType='emp_id';
        $sql = "SELECT `firstname`,`lastname`,`gender` FROM `$tableName` WHERE `$idType`=" . $_SESSION['user'] . " LIMIT 0,1";
        $result = mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);

        if($row['gender']==0) {
            $prename=' Mr.';
        } else if ($row['gender']==1) {
            $prename=' Ms.';
        } else {
            $prename='';
        }

        $name=$row['firstname'];
        $lastname=$row['lastname'];

?>