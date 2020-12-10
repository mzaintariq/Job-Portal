<?php
    require('../../emp_verify.php');
    //this will make sure the user is logged in to access this page
    //put this require statement in the start of all PHP files
        
    require('../../../connect.php');

    $tableName='employers';
    require('../../../prename.php');  
    //this just figures out whether to write "Mr." with the user's name or "Ms." based on their gender
        

    // //once the user has applied for the job in apply.php, the success/failure message
    // //is returned to this file through the URL. This following code handles the display of
    // //that message.
    // $error='';
    // $errorClass='';
    // if(isset($_GET['apply'])) {//this checks if a message exists in a URL
    //     if($_GET['apply']=='success') {//is the message SUCCESS?
    //         $error='Successfully applied for job.'; //if yes, then set $error to a happy message
    //         $errorClass='alert-success';
    //     } else {//if the message is one of failure
    //         $error='Failed to apply for job. Try again or contact developers.'; //set $error to a message of doom
    //         $errorClass='alert-danger';
    //     }
    // }
       
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

    <script src='changeStatus.js'></script>
    <title>View All Posts - Employee</title>

    <?php
        if (isset($_GET['success']) && $_GET['success']==TRUE) {
            $error="Invite sent successfully";
        } else if (isset($_GET['success']) && $_GET['success']==FALSE && isset($_GET['hired'])) {
          $error="You have already hired someone for this job. Please fire that employee first.";
        }
    ?>

</head>
<body>



<div class='container mt-4'>
<h1>Welcome<?php echo $prename . ' ' . $name; ?></h1>
<h1 class='mb-4'><i class="fas fa-users"></i> All Job Posts</h1>
<small>The rows shown in red are jobs that are inactive.</small>
<?php


  if(!isset($_GET['page']))
      $_GET['page']=1;
  $upperLimit = $_GET['page']*20;
  //we will display 20 employers per page
  $sql = "SELECT * FROM `jobs` WHERE emp_id = '". $_SESSION["user"]."'";
  $result = mysqli_query($conn,$sql);
  if($result==false) {
      echo "<div class='card bg-danger text-white'>
                  <div class='card-body'>Query Failed</div>
              </div>";
  }
  else if(mysqli_num_rows($result)==0) {
      echo "<div class='card bg-danger text-white'>
                  <div class='card-body'>No Job Posts Exist</div>
              </div>";
  } else {
      echo "<table class='table table-hover'>";
      echo "<thead><tr>
      <td><b>Title</b></td>
      <td><b>Description</b></b></td>
      <td><b>Type</b></td>
      <td><b>Mode</b></td>
      <td><b>Location</b></td>
      <td><b>Salary</b></td>
      <td><b>Minimum Age</b></td>
      <td><b>Minimum Experience</b></td>
      <td><b>Questions</b></td>
      <td><b>Employee</b></td>
      <td><b>Applications</b></td>
      <td><b>Status</b></td>
      </tr></thead>";
      

      while($row=mysqli_fetch_assoc($result)) {
          $class='';
          $pretext='Active';
          $icon='-slash';
          $gender;
          if($row['status']==0) {
              $class="table-danger";
              $pretext='Inactive';
              $icon='';
          }
          $job_id = $row['job_id'];
          $emp_id = $row['emp_id'];
          $title = $row['title'];
          $description = $row['description'];
          $mode = $row['mode'];
          $location = $row['location'];
          $salary = $row['salary'];
          $min_age_req = $row['min_age_req'];
          $min_edu_req = $row['min_edu_req'];
          $min_exp_req = $row['min_exp_req'];
          $questions = $row['questions'];
          $status = $row['status'];

          $urltitle=urlencode($title);
          $urlquestions=urlencode($questions);
          // $js_id = $row['js_id'];
          switch($row['type']) {
              case 'ft':
                  $type='Full Time';
              break;
              
              case 'pt':
                  $type='Part Time';
              break;

              default:
                  $type='Unknown';
              break;
          }
          if ($row['js_id'] == NULL) {
            $js_id='None';
          }
          else {
            $js_id = $row['js_id'];
          }

          echo "<tr class='" . $class . "'><td>" . $title . "</td>"
            . "<td>" . $description . "</td>"
            . "<td>" . $type . "</td>"
            . "<td>" . $mode . "</td>"
            . "<td>" . $location . "</td>"
            . "<td>" . $salary . "</td>"
            . "<td>" . $min_age_req . "</td>"
            . "<td>" . $min_exp_req . "</td>"
            . "<td>" . $questions . "</td>"
            . "<td>" . $js_id . "</td>"
            . "<td><a href='apps.php?job_id=" . $job_id . "&emp_id=" . $emp_id . "'>View</a></td>"
            // . "<td>" . $min_age_req . "</td>"

            . "<td><a onClick='changeStatus(" . $row['job_id'] . ")' class='btn btn-link'>"
            . "<i></i> " . $pretext . "</a>"
            // . "<i class='fas fa-user" . $icon . "'></i> " . $pretext . "</a>"
            . "</td></tr>";
      }

      echo "</table>";
  }


?>

<div id='error'></p>
</div>


<!--MODAL CODE STARTING-->
<!-- Button to Open the Modal -->
<button type="button" id="modalButton" class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="display:none;">
    Open modal
  </button>

  <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title" id='modelTitle'>Success</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body" id='modalBody'>
          Job Status Changed. Refresh this page to review the table.
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal" id='closeModal'>Close</button>
        </div>
        
      </div>
    </div>
  </div>
  
  <div class="btn-group btn-group-lg mt-3">
    <button type="button" onClick="window.location='../index.php';" class="btn btn-success">Back</button>
    <!-- <button type="button" onClick="window.location='./check.php';" class="btn btn-primary">Check</button> -->
    </div>

    <div class="btn-group btn-group-lg mt-3">
    <button type="button" onClick="window.location='../logout.php';" class="btn btn-primary">Logout</button>
    <!-- <button type="button" onClick="window.location='./check.php';" class="btn btn-primary">Check</button> -->
    </div> 

</body>
</html>