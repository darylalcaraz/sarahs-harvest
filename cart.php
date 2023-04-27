<?php

session_start();

@include 'config.php';

if(isset($_POST['edit_update_btn'])){
    $update_value = $_POST['update_quantity'];
    $update_id = $_POST['update_quantity_id'];
    $update_quantity_query = mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_value' WHERE id = '$update_id'");
    if($update_quantity_query){
        $success_msg[] = 'Product updated succesfully';
    };
};

if(isset($_GET['remove'])){
    $remove_id = $_GET['remove'];
    mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'");
    header('location:cart.php');
 };
 
if(isset($_GET['delete_all'])){
    mysqli_query($conn, "DELETE FROM `cart`");
    header('location:cart.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Cart - Sarah's Harvest</title>
   <link rel="shortcut icon" href="img/sharvestfav.png" type="image/x-icon">

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

   <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<!-- // Notification message for every action in this page -->
<?php

    if(isset($message)){
        foreach($message as $message){
            echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
        };
    };
?>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-white bg-light py-3 fixed-top">
        <div class="container-fluid">
            <a href="user_index.php"><img class="img-responsive" src="img/sharvest.png"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                    <a class="nav-link" href="user_index.php">Home</a>
                    </li>

                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="menu.php">Menu</a>
                    </li>

                    <li class="nav-item">
                    <a class="nav-link" href="about.html">About Us</a>
                    </li>

                </ul>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 icon">
                    <li class="nav-item icons">
                        <a href="account.php"><i class="fas fa-user"></i></a>
                        <?php
                        
                            $select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('Query failed');
                            $row_count = mysqli_num_rows($select_rows);


                        ?>
                        <a href="cart.php"><i class="fas fa-shopping-bag"> <span><?php echo $row_count; ?></span></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="cart-container">
        <section class="food-cart">

            <h1 class="heading">Shopping Cart</h1>

            <table>

                <thead>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </thead>

                <tbody>

                    <?php 
                    
                    $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
                    $grand_total = 0;
                    if(mysqli_num_rows($select_cart) > 0){
                        while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                    ?>

                    <tr>
                        <td class="one"><img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" height="100" alt=""></td>
                        <td class="two"><?php echo $fetch_cart['name']; ?></td>
                        <td class="three">₱<?php echo ($fetch_cart['price']); ?></td>
                        <td class="four">
                            <form action="" method="post">
                                <input type="hidden" name="update_quantity_id"  value="<?php echo $fetch_cart['id']; ?>" >
                                <input type="number" name="update_quantity" min="1"  value="<?php echo $fetch_cart['quantity']; ?>" >
                                <input type="submit" value="Update" name="edit_update_btn">
                            </form>   
                        </td>
                        <td class="five">₱<?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?></td>
                        <td class="six"><a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('Remove item from cart?')" class="delete-btn"> <i class="fas fa-trash"></i> Remove</a></td>
                    </tr>

                    <?php
                        $grand_total += $sub_total;
                        };
                    };
                    ?>
                    <tr class="tbot">
                        <td><a href="menu.php" class="btn" style="margin-top: 0;">Continue shopping</a></td>
                        <td colspan="3">Grand total</td>
                        <td>₱<?php echo $grand_total; ?></td>
                        <td><a href="cart.php?delete_all" onclick="return confirm('Are you sure you want to delete all items?');" class="delete-btn"> <i class="fas fa-trash"></i> Delete all </a></td>
                    </tr>

                </tbody>

            </table>

            <div class="checkout-btn">
                <a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">Proceed to checkout</a>
            </div>

        </section>
    </div>

    <!-- Footer -->
    <footer>
            <div class="row">
                <div class="col-lg-3 col-sm-6 first">
                    <div class="single-box">
                    <p>Philippines' pre-packed fresh vegetable salads and healthy food options perfect for any occasion!</p>
                    <img src="img/sharvestwhite.png" style="max-height: 100%; max-width: 100%; margin-top:5%;">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 second">
                    <div class="single-box">
                        <h2>Products</h2>
                    <ul>
                        <li><a href="menu.php">Salads</a></li>
                        <li><a href="menu.php">Sandwiches</a></li>
                        <li><a href="menu.php">Salads + Sandwiches Combo</a></li>
                        <li><a href="menu.php">Rice Meals</a></li>
                    </ul>
                    </div>                    
                </div>
                <div class="col-lg-3 col-sm-6 third">
                    <div class="single-box">
                        <h2>Contact</h2>
                    <ul>
                        <li><i class="fas fa-home mr-3" style="color:white;"><a href="#" style="padding: 5px;"> Valenzuela City, Philippines</a></i></li>
                        <li><i class="fas fa-envelope mr-3" style="color:white;"><a href="#" style="padding: 5px;"> sarahsharvest@gmail.com</a></i></li>
                        <li><i class="fas fa-mobile mr-3" style="color:white;"><a href="#" style="padding: 5px;"> +63 9952367205</a></i></li>
                        <li><i class="fas fa-phone mr-3" style="color:white;"><a href="#" style="padding: 5px;"> 02 3587011</a></i></li>
                    </ul>
                    </div>                    
                </div>
                <div class="col-lg-3 col-sm-6 fourth">
                    <div class="single-box">
                        <h2>Follow us on</h2>
                        <p class="socials">
                            <a href="https://www.facebook.com/SarahsHarvestPh"><i class="fab fa-facebook-square fb"></i></a>
                            <a href="#"><i class="fab fa-twitter-square twt"></i></a>
                            <a href="#"><i class="fab fa-instagram-square ig"></i></a>
                            <a href="#"><i class="fab fa-youtube-square yt"></i></a>
                        </p>
                    </div>
                </div>
            </div>
    </footer>

    <script src="js/app.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <?php include 'alert.php'; ?>
</body>
</html>