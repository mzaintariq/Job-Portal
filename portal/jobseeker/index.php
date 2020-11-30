<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/13ad6678d8.js"></script>
    <title>Sign Up - Job Seeker</title>

    <?php
    $error='';
    $emailClass='';
    $genderClass='';
        if (isset($_GET['emailexists']) && $_GET['emailexists']==1) {
            $error="<p class='bg-danger text-light'>This email address already exists. Either use a different email, or <a href='login.php'>log in</a> using this one.</p>";
            $emailClass='is-invalid';
        } else if (isset($_GET['passwordmismatch']) && $_GET['passwordmismatch']==1) {
            $error="<p class='bg-danger text-light'>The password and re-typed password don't match.</p>";
        } else if (isset($_GET['genderEmpty']) && $_GET['genderEmpty']==1) {
            $error="<p class='bg-danger text-light'>Please pick a gender.</p>";
        } else if (isset($_GET['login'])) {
            $error="<p class='bg-danger text-light'>Please log in first.</p>";
        }
    ?>

</head>

<body>
<div class='container'>
<h1 class="mb-4"><i class="fa fa-user-circle" aria-hidden="true"></i>
 Job Seeker Sign Up</h1>

<?php echo $error; ?> 
<form action="register.php" method="post">
    <div class='form-group'>
    <!--First name and Last name-->
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Name</span>
            </div>
            <input type="text" name="firstname" class="form-control" placeholder="First Name" required>
            <input type="text" name="lastname" class="form-control" placeholder="Last Name" required>
        </div>
    <!--Email Address and  Age-->
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control <?php echo $emailClass; ?>" placeholder="Email Address" required>
            <div class="input-group-append">
                <span class="input-group-text">someone@example.com</span>
            </div>
        </div>
        <div class="input-group mb-3">
        <input type="number" name="age" class="form-control" placeholder="Age" required>
        <select name="gender" class="form-control  <?php echo $genderClass; ?>" required>
                <option value="-1" selected>--Gender--</option>
                <option value="0">Male</option>
                <option value="1">Female</option>
                <option value="2">Other</option>
            </select>
        
        </div>
    <!--Company Name and Type-->
    <div class="input-group mb-3">
        <input type="text" name="address" class="form-control" placeholder="Address" required>
        <input type="text" name="profession" class="form-control" placeholder="Professional Title" required>
            <div class="input-group-append">
                <span class="input-group-text">e.g. Graphics Designer</span>
            </div>
    </div>

        <div class="input-group mb-3">
            <input type="password" name="password1" class="form-control" placeholder="Password" required>
            <input type="password" name="password2" class="form-control" placeholder="Re-Type Password" required>
        </div>

        <button type="submit" class="form-control btn-success"><i class="fas fa-paper-plane"></i> Sign Up</button>
    </div>
    
</form>

<div style='text-align:center;width:100%;'>
    <p>OR</p>
    <a href='login.php'>Login</a>
</div>
</div>
</body>