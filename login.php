<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pw = md5($_POST['password']);
    $confirmpw = md5($_POST['confirmpassword']);
    $user_type = $_POST['user_type'];

    $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pw'";

    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0) {
        
        $row = mysqli_fetch_array($result);

        if($row['user_type'] == 'admin'){

            $_SESSION['admin_name'] = $row['name'];
            header('location:admin_index.php');

        }elseif($row['user_type'] == 'user'){

            $_SESSION['user_name'] = $row['name'];
            header('location:user_index.php');

        }

        
    }else{
        $error[] = 'Incorrect Email or Password';
    }
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In - Sarah's Harvest</title>
    <link rel="shortcut icon" href="img/sharvestfav.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
<div class="form-container">
    <form action="" method="post">
        <img src="img/sharvest.png" alt="logo">
        <h3>Log In</h3>
        <?php
        if(isset($error)){
            foreach($error as $error){
                echo '<span class="error-msg">'.$error.'</span';
            }
        }
         ?>
        <input type="email" name="email" required placeholder="Enter Email">
        <input type="password" name="password" required placeholder="Enter Password">
        <input type="submit" name="submit" value="Log In" class="form-btn">
        <p>Don't have an account yet? <a href="index.php">Sign Up</a></p>
    </form>
</div>

</body>
</html>