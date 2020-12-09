<?php
    require('../../js_verify.php');
    //this will make sure the user is logged in to access this page
    //put this require statement in the start of all PHP files
        
    require('../../../connect.php');

    $tableName='jobseekers';
    require('../../../prename.php');  
    //this just figures out whether to write "Mr." with the user's name or "Ms." based on their gender
        

    //once the user has applied for the job in apply.php, the success/failure message
    //is returned to this file through the URL. This following code handles the display of
    //that message.
    $error='';
    $errorClass='';
    if(isset($_GET['apply'])) {//this checks if a message exists in a URL
        if($_GET['apply']=='success') {//is the message SUCCESS?
            $error='Successfully applied for job.'; //if yes, then set $error to a happy message
            $errorClass='alert-success';
        } else {//if the message is one of failure
            $error='Failed to apply for job. Try again or contact developers.'; //set $error to a message of doom
            $errorClass='alert-danger';
        }
    }

    $sortBy='';
    $sortType='';
    $sortOrNot=false;
    $selected=array("job_id"=>"selected","salary"=>"","min_age_req"=>"","min_edu_req"=>"","min_exp_req"=>"","DESC"=>"selected","ASC"=>"");


    if(isset($_GET['sortBy']) && isset($_GET['sortType']) ) {
        if($_GET['sortBy']!='' && $_GET['sortType']!='' && ($_GET['sortBy']=='job_id' || $_GET['sortBy']=='salary' || $_GET['sortBy']=='min_age_req' || $_GET['sortBy']=='min_edu_req' || $_GET['sortBy']=='min_exp_req')) {
            $sortBy=$_GET['sortBy'];
            $sortType=$_GET['sortType'];
            $sortOrNot=true;
            $selected['job_id']="";$selected['DESC']="";
            $selected[$sortBy]="selected";
            $selected[$sortType]="selected";
        } else {
            $error='Invalid sorting criteria.'; //set $error to a message of doom
            $errorClass='alert-danger';
        }
    }


    $selected2 = array("selected","","","selected","","","selected","","");
    $whereClause='';
    if (isset($_GET['filterBy']) && $_GET['filterBy']!='') {
        $selected2[0]="";
        if($_GET['filterBy']=='type') {
            $selected2[1]="selected";
            $selected[3]="";
            if($_GET['typeDetails']=='pt') {
                $selected2[5]="selected";
                $whereClause="AND `type`='pt'";
            } else if ($_GET['typeDetails']=='ft') {
                $selected2[4]="selected";
                $whereClause="AND `type`='ft'";
            } else {
                $error='Invalid filter criteria.'; //set $error to a message of doom
                $errorClass='alert-danger';
            }
        } else if ($_GET['filterBy']=='mode') {
            $selected2[2]="selected";
            $selected2[6]="";
            if($_GET['modeDetails']=='online') {
                $selected2[7]="selected";
                $whereClause="AND `mode`='online'";
            } else if ($_GET['modeDetails']=='offline') {
                $selected2[8]="selected";
                $whereClause="AND `mode`='offline'";
            } else {
                $error='Invalid filter criteria.'; //set $error to a message of doom
                $errorClass='alert-danger';
            }
        }
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
    <script src="https://kit.fontawesome.com/13ad6678d8.js"></script>
    <title>Employer Panel</title>
    <style>.hidden{display:none;}</style>
</head>


<body>
<div class='container pt-5'>
    <div class="jumbotron">
    <h1>Welcome<?php echo $prename . ' ' . $name; ?></h1>
    <h1>ID:<?php echo ' ' . $_SESSION['user']; ?></h1>

    
    <!-- <p>Creators: Rohan, Zain, and Zahab from LUMS</p> -->
    </div>

    <div class="alert <?php echo $errorClass; ?>" role="alert">
        <?php echo $error; ?>   <!--display the error message that came after user applied for job-->
    </div>


    <!--SORTING-->
    <form name='form1' class='form-inline' action='index.php' method='get'>
            <label for='sortBy'>Sort By: </label>
            <select id='sortBy' name='sortBy' class='form-control'>
                <option value='job_id' <?php echo $selected['job_id']; ?>>Time Posted</option>
                <option value='salary' <?php echo $selected['salary']; ?>>Salary</option>
                <option value='min_age_req' <?php echo $selected['min_age_req']; ?>>Minimum Age Requirement</option>
                <option value='min_edu_req' <?php echo $selected['min_edu_req']; ?>>Minimum Education Requirement</option>
                <option value='min_exp_req' <?php echo $selected['min_exp_req']; ?>>Minimum Experience Requirement</option>
            </select>
            <div style='width:20px;'></div>
            <label for='sortType'>Sort Type: </label>
            <select id='sortType' name='sortType' class='form-control'>
                <option value='DESC'  <?php echo $selected['DESC']; ?>>Descending</option>
                <option value='ASC' <?php echo $selected['ASC']; ?>>Ascending</option>
            </select>
            <div style='width:20px;'></div>
           
    <br>
    <!--SORTING ENDS-->

    <!--FILTERS-->
   
            <label for='filterBy'>Filter By: </label>
            <select id='filterBy' name='filterBy' class='form-control'>
                <option value='' <?php echo $selected2[0]; ?>>--</option>
                <option value='type' <?php echo $selected2[1]; ?>>Type</option>
                <option value='mode' <?php echo $selected2[2]; ?>>Mode</option>
            </select>
            <div style='width:20px;'></div>

            <div id='typeDetails' 
            <?php if ($selected2[1]!="selected") echo " class='hidden'"; ?>
                ><label for='typeDetails'>Job Type: </label>
                <select id='typeDetailSelect' name='typeDetails' class='form-control'>
                    <option value=''  <?php echo $selected2[3]; ?>>--</option>
                    <option value='ft' <?php echo $selected2[4]; ?>>Full Time</option>
                    <option value='pt' <?php echo $selected2[5]; ?>>Part Time</option>
                </select>
            </div>

            <div id='modeDetails' <?php if ($selected2[2]!="selected") echo " class='hidden'"; ?>>
                <label for='modeDetails'>Job Mode: </label>
                <select id='modeDetailSelect' name='modeDetails' class='form-control'>
                    <option value=''  <?php echo $selected2[6]; ?>>--</option>
                    <option value='online' <?php echo $selected2[7]; ?>>Online</option>
                    <option value='offline' <?php echo $selected2[8]; ?>>Offline</option>
                </select>
            </div>
            <div style='width:20px;'></div>
            <input type='submit' class='btn btn-primary' value='Sort/Filter'>
    </form>
    <br>
    <!--FILTERS END-->
    <table class="table">
        <thead>
            <tr>
                <td><b>Title</b></td>
                <td><b>Description</b></td>
                <td><b>Type</b></td>
                <td><b>Mode</b></td>
                <td><b>Location</b></td>
                <td><b>Salary</b></td>
                <td><b>Minimum Age</b></td>
                <td><b>Minimum Eductation</b></td>
                <td><b>Minimum Experience</b></td>
                <td><b>Questions</b></td>
                <td><b>Apply</b></td>
            </tr>
        </thead>
        <?php

        $sql2='';
        if(!$sortOrNot)
            $sql2 = "SELECT * FROM `jobs` WHERE `status`=1 $whereClause ORDER BY `job_id` DESC";

        else
            $sql2 = "SELECT * FROM `jobs` WHERE `status`=1 $whereClause ORDER BY `$sortBy` $sortType";
        $result2 = mysqli_query($conn,$sql2);
        while($row2 = mysqli_fetch_assoc($result2))
        {
            $job_id = $row2['job_id'];
            $emp_id = $row2['emp_id']; 
            $title = $row2['title'];
            $description = $row2['description'];
            $type = $row2['type'];
            $mode = $row2['mode'];
            $location = $row2['location'];
            $salary = $row2['salary'];
            $min_age_req = $row2['min_age_req'];
            $min_edu_req = $row2['min_edu_req'];
            $min_exp_req = $row2['min_exp_req'];
            $questions = $row2['questions'];
            $blocked = $row2['blocked'];
            $js_id = $row2['js_id'];
            if($type=='ft') $type='Full Time';
            else    $type='Part Time';

        print "<tr>";
            print "<td>" . $title . "</td>";
            print "<td>" . $description . "</td>";
            print "<td>" . $type . "</td>";
            print "<td>" . $mode . "</td>";
            print "<td>" . $location . "</td>";
            print "<td>" . $salary . "</td>";
            print "<td>" . $min_age_req. "</td>";
            print "<td>" . $min_edu_req . "</td>";
            print "<td>" . $min_exp_req . "</td>";
            print "<td>" . $questions . "</td>";
            $urltitle = urlencode($title);
            $urlquestions = urlencode($questions);
            print "<td><a href='apply.php?job_id=" . $job_id . "&title=" . $urltitle . "&questions=" . $urlquestions . "'>Apply</a></td>";
        print "</tr>";
        }
        ?>
    </table>

    

    <div class="btn-group btn-group-lg mt-3">
    <button type="button" onClick="window.location='../index.php';" class="btn btn-success">Back</button>
    <!-- <button type="button" onClick="window.location='./check.php';" class="btn btn-primary">Check</button> -->
    </div>

    <div class="btn-group btn-group-lg mt-3">
    <button type="button" onClick="window.location='../logout.php';" class="btn btn-primary">Logout</button>
    <!-- <button type="button" onClick="window.location='./check.php';" class="btn btn-primary">Check</button> -->
    </div> 
</div>


<script>
    $(document).ready(function(){
        $('#filterBy').change(function(){
            if($(this).val()=='type') {
                $('#modeDetails').fadeOut();
                $('#typeDetails').fadeIn();
            } else if ($(this).val()=='mode') {
                $('#typeDetails').fadeOut();
                $('#modeDetails').fadeIn();
            }
        });
    });
</script>

</body>
</html>