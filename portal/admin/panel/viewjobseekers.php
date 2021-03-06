<?php

require('../admin_verify.php');
require('../../connect.php');

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

    <script src='blockJobseeker.js'></script>
    <title>View All Jobseekers - Admin</title>
</head>
<body>



<div class='container mt-4'>

<h1 class='mb-4'><i class="fas fa-users"></i> All Jobseekers</h1>
<small>The rows shown in red are jobseekers that are blocked.</small>
<?php



$sql = "SELECT count(*) AS cnt FROM `jobseekers` WHERE 1";
$result = $conn->query($sql);
$row=$result->fetch_assoc();
$totalRows=$row['cnt'];


if(!isset($_GET['page']))
  $_GET['page']=20;

$upperLimit = $_GET['page'];
$lowerLimit=$upperLimit-20;
//we will display 20 employers per page
$sql = "SELECT * FROM `jobseekers` WHERE 1 ORDER BY `js_id` ASC LIMIT " . $lowerLimit . ", 20";
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
    $n = $lowerLimit+20;
    echo "<p>Displaying " . $lowerLimit . "-" . $n . " of " . $totalRows . "</p>";
      echo "<table class='table table-hover'>";
      echo "<thead><tr>
      <td>Name</td>
      <td>Age</td>
      <td>Gender</td>
      <td>Email</td>
      <td>Profession</td>
      <td>Address</td>
      <td>Status</td>
      <td>Action</td>
      </tr></thead>";
      

      while($row=mysqli_fetch_assoc($result)) {
          $class='';
          $pretext='B';
          $icon='-slash';
          $gender;
          if($row['blocked']==1) {
              $class="table-danger";
              $pretext='Unb';
              $icon='';
          }
          switch($row['gender']) {
              case 0:
                  $gender='Male';
              break;
              
              case 1:
                  $gender='Female';
              break;
              
              case 2:
                  $gender='Other';
              break;

              default:
                  $gender='Unknown';
              break;
          }

          $status='Unemployed';
          if($row['employment_status']==1) {
            $status='Employed';
          }
          echo "<tr class='" . $class . "'><td>" . $row['firstname'] . ' ' . $row['lastname'] . "</td>"
            . "<td>" . $row['age'] . "</td>"
            . "<td>" . $gender . "</td>"
            . "<td>" . $row['email'] . "</td>"
            . "<td>" . $row['profession'] . "</td>"
            . "<td>" . $row['address'] . "</td><td>" . $status . "</td>"
            . "<td><a onClick='blockJobseeker(" . $row['js_id'] . ")' class='btn btn-link'>"
            . "<i class='fas fa-user" . $icon . "'></i> " . $pretext . "lock</a>"
            . "</td></tr>";
      }

      echo "</table>";
  }


?>

<div id='error'></p>
</div>

<ul class="pagination">
<li class="page-item"><a class="page-link" href="index.php">Back</a></li>
  <li class="page-item"><a class="page-link" href="viewjobseekers.php?page=<?php if($upperLimit>20) echo $upperLimit-20; else echo 20;?>">Previous 20 Rows</a></li>
  
  <?php if ($totalRows>20) { ?>
  <li class="page-item"><a class="page-link" href="viewjobseekers.php?page=<?php echo $upperLimit+20; ?>">Next 20 Rows</a></li>
  <?php } ?>
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