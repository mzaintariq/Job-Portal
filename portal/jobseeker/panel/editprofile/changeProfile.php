<?php

    require('../../js_verify.php');
    require('../../../connect.php');

    if(!isset($_POST['firstname']) && !isset($_POST['lastname']) && !isset($_POST['age']) && !isset($_POST['profession']) && !isset($_POST['address']) && !isset($_POST['gender'])) {
        header('Location:index.php?invalid=1');
        die('Error occured. Code 1.');
    }
    else {
        $sql = 'UPDATE `jobseekers` SET ';
        if (isset($_POST['firstname']) && $_POST['firstname']!='') {
            $sql .= "`firstname`='" . $_POST['firstname'] . "'";
        } else if (isset($_POST['lastname']) && $_POST['lastname']!='') {
            $sql .= "`lastname`='" . $_POST['lastname'] . "'";
        } else if (isset($_POST['profession']) && $_POST['profession']!='') {
            $sql .= "`profession`='" . $_POST['profession'] . "'";
        } else if (isset($_POST['address']) && $_POST['address']!='') {
            $sql .= "`address`='" . $_POST['address'] . "'";
        } else if (isset($_POST['age']) && $_POST['age']>0 && $_POST['age']<120) {
            $sql .= "`age`=" . $_POST['age'];
        } else if (isset($_POST['gender']) && $_POST['gender']>-1 && $_POST['gender']<3) {
            $sql .= "`gender`=" . $_POST['gender'];
        } else {
            header('Location:index.php?invalid=1');
            die('Error occured. Code 2.');
        }

        $sql .= " WHERE `js_id`=" . $_SESSION['user'];

        if ($conn->query($sql)) {
            header('Location:index.php?success=1');
            die();
        } else {
            header('Location:index.php?failure=1');
            die();
        }
    }
?>