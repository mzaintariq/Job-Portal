<!DOCTYPE html>
<html>
<head>

    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/13ad6678d8.js"></script>

    <script src='blockEmployer.js'></script>
    <title>View All Employees - Admin</title>
</head>
<body>



<div class='container mt-4'>

<h1 class='mb-4'>All Employers</h1>
<small>The rows shown in red are employees that are blocked.</small>
<?php

require('../admin_verify.php');
require('../../connect.php');

// Create connection
$conn = new mysqli($servername, $username, $pwd, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    if(!isset($_GET['page']))
        $_GET['page']=1;
    $upperLimit = $_GET['page']*20;
    //we will display 20 employers per page
    $sql = "SELECT * FROM `employers` WHERE 1 LIMIT 0," . $upperLimit;
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
        echo "<table class='table'>";
        echo "<thead><tr>
        <td>Name</td>
        <td>Age</td>
        <td>Gender</td>
        <td>Email</td>
        <td>Company</td>
        <td>Address</td>
        <td>Action</td>
        </tr></thead>";
        

        while($row=mysqli_fetch_assoc($result)) {
            $class='';
            $pretext='B';
            $gender;
            if($row['blocked']==1) {
                $class="table-danger";
                $pretext='Unb';
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

            echo "<tr class='" . $class . "'><td>" . $row['firstname'] . ' ' . $row['lastname'] . "</td>"
             . "<td>" . $row['age'] . "</td>"
             . "<td>" . $gender . "</td>"
             . "<td>" . $row['email'] . "</td>"
             . "<td>" . $row['companyname'] . "</td>"
             . "<td>" . $row['address'] . "</td>"
             . "<td><a onClick='blockEmployer(" . $row['emp_id'] . ")' class='btn btn-link'>" . $pretext . "lock</a></td></tr>";
        }

        echo "</table>";
    }
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
          Employer blocked. Refresh this page to review the table.
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