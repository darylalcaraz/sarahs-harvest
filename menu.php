<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['user_name'])){
    header('location:login.php');
}

// Lets users add items to cart
if(isset($_POST['add_cart'])){

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = 1;

    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name'");

    if(mysqli_num_rows($select_cart) > 0){
        $warning_msg[] = 'Item is already in cart';
     }else{
        $insert_product = mysqli_query($conn, "INSERT INTO `cart`(name, price, image, quantity) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity')");
        $success_msg[] = 'Item has been added to cart';
     }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Sarah's Harvest</title>
    <link rel="shortcut icon" href="img/sharvestfav.png" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

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


    <div class="menu-container">

        <section class="products">

            <h1 class="heading">All Products</h1>

            <div class="box-container">

                <?php 
                
                $select_products = mysqli_query($conn, "SELECT * FROM `products`");
                if(mysqli_num_rows($select_products) > 0){
                    while($fetch_product = mysqli_fetch_assoc($select_products)){
                ?>

                <!-- Displays every product that is in the database -->
                <form action="" method="post">
                    <div class="box">   
                        <img src="uploaded_img/<?php echo $fetch_product['image']; ?>" alt="">
                        <h3><?php echo $fetch_product['name']; ?></h3>
                        <div class="price">₱<?php echo $fetch_product['price']; ?></div>
                        <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                        <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                    </div>
                    <div class="btnz">
                    <input type="submit" class="btn" value="Add to cart" name="add_cart">
                    </div>
                    
                </form>

                <?php
                    };
                };
                ?>

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