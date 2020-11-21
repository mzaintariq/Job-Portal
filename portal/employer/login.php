<?php
    if(isset($_POST['email']) || isset($_POST['password'])) {
        //connecting to database
        $servername = "localhost:3306";
        $username = "root";
        $pwd = "";
        $dbname = "portal";
        
        // Create connection
        $conn = new mysqli($servername, $username, $pwd, $dbname);
        // Check connection
        if ($conn->connect_error) {
            header('Location:login.php?connectionfailed=1');
            die("Connection failed: " . $conn->connect_error);
        } else {

            $email=$_POST['email'];
            $password=hash('sha256',$_POST['password']);

            $sql = "SELECT `emp_id` FROM `employers` WHERE `email`='$email' AND `password`='$password' LIMIT 0,1";
            $result = mysqli_query($conn,$sql);

            if(mysqli_num_rows($result)==0) {
                header('Location:login.php?invalidcredentials=1');
            } else {
                $row=mysqli_fetch_assoc($result);
                $id=$row['emp_id'];
                session_start();
                $_SESSION['user']=$id;
                $_SESSION['type']='employer';
                header('Location:./panel');
            }
        }

    } else {
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
    <title>Log In - Employer</title>

    <?php
    $error='';
    $emailClass='';
    $passwordClass='';
        if (isset($_GET['invalidcredentials']) && $_GET['invalidcredentials']==1) {
            $error="<p class='bg-danger text-light'>Invalid credentials. Try again.</p>";
            $passwordClass='is-invalid';
            $emailClass='is-invalid';
        } else if (isset($_GET['connectionfailed'])) {
            $error="<p class='bg-danger text-light'>Database connection failed.</p>";
        }
    ?>

</head>

<body>
<div class='container'>
<h1 class="mb-4"><i class="fa fa-user-circle" aria-hidden="true"></i>
 Employer Log In</h1>

<?php echo $error; ?> 
<form action="login.php" method="post">
    <div class='form-group'>

        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control <?php echo $emailClass; ?>" placeholder="Email Address" required>
            <div class="input-group-append">
                <span class="input-group-text">someone@example.com</span>
            </div>
        </div>

        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control <?php echo $passwordClass; ?>" placeholder="Password" required>
        </div>

        <button type="submit" class="form-control btn-success"><i class="fas fa-paper-plane"></i> Log In</button>
    </div>
    
</form>

</div>
</body>

<?php
    }
?>