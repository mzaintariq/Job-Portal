<?php
    if(isset($_POST['email']) || isset($_POST['password'])) {
        //connecting to database
        require('../connect.php');
        
        $email=$_POST['email'];


        //check if at least the email is correct
        $sql2 = "SELECT `js_id` FROM `jobseekers` WHERE `email`='$email' LIMIT 0,1";
        $result2 = mysqli_query($conn,$sql2);

        //if email was correct 
        if (mysqli_num_rows($result2)>0) {
            $row2 = mysqli_fetch_assoc($result2);
            
            //checking if the user has exhausted his allowed login attempts
            $sql0 = "SELECT `attempt_no`, TIMESTAMPDIFF(MINUTE,`last_attempt`,NOW()) as timedif FROM `login_attempts_log` WHERE `js_id`=" . $row2['js_id'] . " ORDER BY `js_id` DESC LIMIT 0,1";

            $result0 = mysqli_query($conn,$sql0);

            //if someone did attempt to login before
            if(mysqli_num_rows($result0)>0) {
                $row0=mysqli_fetch_assoc($result0);
                if($row0['attempt_no']>3) {

                    //if he has waited 30 minutes, grant him permission to log in
                    if($row0['timedif']>30) {
                        //let him move on to the password checking phase
                    } else {
                        //he can't try to log in right now
                        header('Location:login.php?invalidcredentials=1&remaining_attempts=0');
                        die();
                    }
                }
            }
        }


        $password=hash('sha256',$_POST['password']);

        $sql = "SELECT `js_id` FROM `jobseekers` WHERE `email`='$email' AND `password`='$password' LIMIT 0,1";
        $result = mysqli_query($conn,$sql);

        if(mysqli_num_rows($result)==0) {


            //password or email was wrong

                //if someone did attempt to login before
                if(mysqli_num_rows($result0)>0) {

                    //check if he is making this new attempt within 30min of the last one
                    if($row0['timedif']<30) {

                        //if yes, then add 1 to his number of attempts, but only if they are less than 4
                        if($row0['attempt_no']<4) {
                            $temp = $row0['attempt_no']+1;
                            $sql5 = "UPDATE `login_attempts_log` SET `attempt_no`=$temp, `last_attempt`=NOW() WHERE `js_id`=" . $row2['js_id'];
                            if(mysqli_query($conn,$sql5)) {
                                $temp=4-($row0['attempt_no']+1);
                                header('Location:login.php?invalidcredentials=1&remaining_attempts=' . $temp);
                                die();
                            } else {
                                echo "Query 5 failed.";
                            }
                        } else {
                            //he has already exhausted his 4 attempts
                            header('Location:login.php?invalidcredentials=1&remaining_attempts=0');
                            die();
                        }
                    } else {
                        //set attempts to 0 as he waited 30 minutes to try again
                        $sql6 = "UPDATE `login_attempts_log` SET `attempt_no`=0, `last_attempt`=NOW() WHERE `js_id`=" . $row2['js_id'] . " ORDER BY `js_id` DESC LIMIT 0,1";
                        if(mysqli_query($conn,$sql6)) {
                            header('Location:login.php?invalidcredentials=1&remaining_attempts=4');
                            die();
                        }
                    }

                //if there hasn't been a login attempt before, store this one
                } else {    
                    $sql4 = "INSERT INTO `login_attempts_log`(`js_id`, `last_attempt`, `attempt_no`) VALUES (" . $row2['js_id'] . ",NOW(),1)";
                    if(mysqli_query($conn,$sql4)) {
                        echo "Login Attempt Logged Successfully.";
                    } else {
                        echo "Login Attempt Log Failed.";
                    }
                }
                    

                    //redirect back to login page with invalid credentials warning


            header('Location:login.php?invalidcredentials=1');
        } else {
            $row=mysqli_fetch_assoc($result);
            $id=$row['js_id'];
            session_start();
            $_SESSION['user']=$id;
            $_SESSION['type']='jobseeker';
            header('Location:./panel');
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
    <title>Log In - Job Seeker</title>

    <?php
    $error='';
    $emailClass='';
    $passwordClass='';
    if (isset($_GET['invalidcredentials']) && $_GET['invalidcredentials']==1) {
        if(isset($_GET['remaining_attempts']) && $_GET['remaining_attempts']==0) {
            $error="<p>You have exhausted your login attempts. You must wait 30 minutes to try to log in again.</p>";
        } else if (isset($_GET['remaining_attempts'])) {
            $error="<p class='bg-danger text-light'>Invalid credentials. You have " . $_GET['remaining_attempts'] . " attempts remaining.</p>";
        } else {
            $error="<p class='bg-danger text-light'>Invalid credentials. Try again.</p>";
        }
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
 Job Seeker Log In</h1>

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