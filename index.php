<?php

@include 'config.php';

if(isset($_POST['submit'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pw = md5($_POST['password']);
    $confirmpw = md5($_POST['confirmpassword']);
    $user_type = $_POST['user_type'];

    $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pw'";

    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0) {
        
        $error[] = 'User already exist';
    }else{

        if($pw != $confirmpw){
            $error[] = 'Password does not match';
        }else{
            $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name', '$email', '$pw', '$user_type')";
            mysqli_query($conn, $insert);
            header('location:login.php');
        }
    }
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Sarah's Harvest</title>
    <link rel="shortcut icon" href="img/sharvestfav.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
<div class="form-container">
    <form action="" method="post">
        <img src="img/sharvest.png" alt="logo">
        <h3>Sign Up</h3>
         <?php
        if(isset($error)){
            foreach($error as $error){
                echo '<span class="error-msg">'.$error.'</span';
            }
        }
         ?>
        <input type="text" name="name" required placeholder="Enter Full Name">
        <input type="email" name="email" required placeholder="Enter Email">
        <input type="password" name="password" required placeholder="Enter Password">
        <input type="password" name="confirmpassword" required placeholder="Confirm Password">
        <select name="user_type">
            <option value="user">user</option>
            <option value="admin">admin</option>
        </select>
        <input type="submit" name="submit" value="Sign Up Now" class="form-btn">
        <p>Already have an account? <a href="login.php">Log In</a></p>
    </form>
</div>

</body>
</html>