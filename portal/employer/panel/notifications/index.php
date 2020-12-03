<?php

    require('../../emp_verify.php');
    //through this file,
    //if user was not logged in, he would be redirected to login page and the following lines of code would not run
    //note that the session_start() command is included in above file

    require('../../../connect.php');
    //load database connection credentials and check if connection was successful. Create $conn variable.
        
    $tableName='employers';
    require('../../../prename.php');  
    //this just figures out whether to write "Mr." with the user's name or "Ms." based on their gender
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

    <!--local script-->
    <script src='notifications.js'></script>

    <title>View Notifications - Employer</title>
</head>

<body>
<div class='container pt-5'>
    <div class="jumbotron">
    <h3>Welcome<?php echo $prename . ' ' . $name; ?></h3>
    <h1>View Notifications</h1>
</div>

    <button type='button' class='btn btn-warning' onClick='deleteNotification(1,0)'>Delete All Notifications</button>
    <table class='table table-dark'>
        <thead>
            <tr>
                <td>Notification Type</td>
                <td>Content</td>
                <td>Additional Info</td>
                <td>Action</td>
            </tr>
        </thead>
        <?php
            //reading notifications from database
            //this is a natural join
            $sqlNotif = "SELECT * FROM `notifications` WHERE `emp_id`=" . $_SESSION['user'];
            $result = mysqli_query($conn,$sqlNotif);

            if(!$result) {
                echo "<div class=\"alert alert-danger\" role=\"alert\">
                       Query Failed.
                    </div>";
            } else if (mysqli_num_rows($result)==0) {
                echo "<div class=\"alert alert-danger\" role=\"alert\">
                       No notifications to be shown.
                    </div>";
            } else {
                while($row=mysqli_fetch_assoc($result)) {
                    echo "<tr>
                    <td>" . $row['type'] . "</td>
                    <td>" . $row['content'] . "</td>
                    <td></td>
                    <td><button type='button' class='btn btn-link' onClick='deleteNotification(0," . $row['notif_id'] . ")'>Delete</button></td>
                    </tr>";
                }
            }
        ?>
    </table>





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
            Job Invite Accepted. The notification has been removed now.
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal" id='closeModal'>Close</button>
            </div>
            
        </div>
        </div>
    </div>

    <button id='modalButton' type="button" class="btn btn-info btn-lg" style='display:none;' data-toggle="modal" data-target="#myModal">Open Modal</button>


    <!--Navigation Buttons-->
    <div class="btn-group btn-group-lg mt-3">
    <button type="button" onClick="window.location='../index.php';" class="btn btn-success">Back</button>
    </div>

    <div class="btn-group btn-group-lg mt-3">
    <button type="button" onClick="window.location='../logout.php';" class="btn btn-primary">Logout</button>
    </div> 
</div>

</body>
</html>