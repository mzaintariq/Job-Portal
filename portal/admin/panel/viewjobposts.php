<!DOCTYPE html>
<html>
<head>

    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/13ad6678d8.js"></script>

    <script src='blockJobPost.js'></script>
    <title>View All Job Posts - Admin</title>
</head>
<body>



<div class='container mt-4'>

<h1 class='mb-4'><i class="fas fa-users"></i> All Jobs</h1>
<small>The rows shown in red are jobs that are blocked.</small>
<?php

require('../admin_verify.php');
require('../../connect.php');


  if(!isset($_GET['page']))
      $_GET['page']=1;
  $upperLimit = $_GET['page']*20;
  //we will display 20 employers per page
  $sql = "SELECT * FROM `jobs` WHERE 1 LIMIT 0," . $upperLimit;
  $result = mysqli_query($conn,$sql);
  if($result==false) {
      echo "<div class='card bg-danger text-white'>
                  <div class='card-body'>Query Failed</div>
              </div>";
  }
  else if(mysqli_num_rows($result)==0) {
      echo "<div class='card bg-danger text-white'>
                  <div class='card-body'>No Employer Accounts Exist</div>
              </div>";
  } else {
      echo "<table class='table table-hover'>";
      echo "<thead><tr>
      <td>Title</td>
      <td>Description</td>
      <td>Type</td>
      <td>Mode</td>
      <td>Location</td>
      <td>Salary</td>
      <td>Min Age</td>
      <td>Min Education</td>
      <td>Min Experience</td>
      <td>Questions</td>
      </tr></thead>";
      

      while($row=mysqli_fetch_assoc($result)) {
          $class='';
          $pretext='B';
          $icon='-slash';
          $type;

          if($row['blocked']==1) {
              $class="table-danger";
              $pretext='Unb';
              $icon='';
          }

          if($row['type']=='pt') {
            $type='Part Time';
          }
          else {
            $type='Full Time';
          }

          echo "<tr class='" . $class . "'><td>" . $row['title'] . "</td>"
            . "<td>" . $row['description'] . "</td>"
            . "<td>" . $type . "</td>"
            . "<td>" . $row['mode'] . "</td>"
            . "<td>" . $row['location'] . "</td>"
            . "<td>" . $row['salary'] . "</td>"
            . "<td>" . $row['min_age_req'] . "</td>"
            . "<td>" . $row['min_edu_req'] . "</td>"
            . "<td>" . $row['min_exp_req'] . "</td>"
            . "<td>" . $row['questions'] . "</td>"
            . "<td><a onClick='blockJobPost(" . $row['job_id'] . ")' class='btn btn-link'>"
            . "<i class='fas fa-user" . $icon . "'></i> " . $pretext . "lock</a>"
            . "</td></tr>";
      }

      echo "</table>";
  }


?>

<div id='error'></p>
</div>

<ul class="pagination">
    <li class="page-item"><a class="page-link" href="index.php"><i class="fas fa-angle-left"></i> Go Back</a></li>
</ul>

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
          Jobseeker blocked. Refresh this page to review the table.
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal" id='closeModal'>Close</button>
        </div>
        
      </div>
    </div>
  </div>

</body>
</html>