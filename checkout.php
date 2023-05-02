<?php

// establishes connection between this file and the config.php file
@include 'config.php';

// receive and reflect the information submitted by a user to the checkout form
if(isset($_POST['place_order'])){

    // containers for the submitted information
    $name = $_POST['name'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $method = $_POST['method'];
    $address_type = $_POST['address_type'];
    $flat = $_POST['flat'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $pin_code = $_POST['pin_code'];

    $cart_query = mysqli_query($conn, "SELECT * FROM `cart`");
    $product_total = 0;

    // statement to insert the submitted information into the orders database
    if(mysqli_num_rows($cart_query) > 0){
        while($product_item = mysqli_fetch_assoc($cart_query)){
            $product_name[] = $product_item['name'] .' ('. $product_item['quantity'] .') ';
            $product_price = number_format($product_item['price'] * $product_item['quantity']);
            $price_total += $product_price;
        };
    };

    $total_product = implode(', ', $product_name);
    $detail_query = mysqli_query($conn, "INSERT INTO `orders` (name, number, email, method, address_type, flat, street, city, country, pin_code, total_products, total_price) VALUES('$name','$number','$email','$method', '$address_type', '$flat','$street','$city','$country','$pin_code','$total_product','$price_total')") or die('Query failed');

    // statement to display the orders information of the user that was queried from the database
    if($cart_query && $detail_query){
        echo "
        <div class='order-message-container'>
        <div class='message-container'>
           <h3>Thank You!</h3>
           <h4>Your order has been placed.</h4>
           <div class='order-detail'>
              <span>".$total_product."</span>
              <span class='total'> Total : ₱".$price_total."  </span>
           </div>
           <div class='customer-details'>
              <p> Name : <span>".$name."</span> </p>
              <p> Number : <span>".$number."</span> </p>
              <p> Email : <span>".$email."</span> </p>
              <p> Address : <span>".$flat.", ".$street.", ".$city.", ".$country." - ".$pin_code."</span> </p>
              <p> Address Type: <span>".$address_type."</span> </p>
              <p> Your payment mode : <span>".$method."</span> </p>
              <p>(*Please ready payment for your COD order*)</p>
           </div>
              <a href='menu.php' class='btn'>Continue shopping</a>
           </div>
        </div>
        ";
     }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Checkout - Sarah's Harvest</title>
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
                    <a class="nav-link" href="about.php">About Us</a>
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

    <section class="checkout">

    <h1 class="heading">checkout summary</h1>

    <div class="row">

        <form action="" method="POST">
            <h3 style="color:#386641;">Billing Details</h3>
            <div class="flex">
                <div class="box">
                <p>Your name <span>*</span></p>
                <input type="text" name="name" required maxlength="50" placeholder="Enter your name" class="input">
                <p>Your number <span>*</span></p>
                <input type="number" name="number" required maxlength="10" placeholder="Enter your number" class="input" min="0" max="9999999999">
                <p>Your email <span>*</span></p>
                <input type="email" name="email" required maxlength="50" placeholder="Enter your email" class="input">
                <p>Payment method <span>*</span></p>
                <select name="method" class="input" required>
                    <option value="Cash on delivery">Cash on delivery</option>
                </select>
                <p>Address type <span>*</span></p>
                <select name="address_type" class="input" required> 
                    <option value="Home">Home</option>
                    <option value="Office">Office</option>
                </select>
                </div>
                <div class="box">
                <p>Address line 01 <span>*</span></p>
                <input type="text" name="flat" required maxlength="50" placeholder="e.g. Flat & building number" class="input">
                <p>Address line 02 <span>*</span></p>
                <input type="text" name="street" required maxlength="50" placeholder="e.g. Street name & locality" class="input">
                <p>City name <span>*</span></p>
                <input type="text" name="city" required maxlength="50" placeholder="Enter your city name" class="input">
                <p>Country name <span>*</span></p>
                <input type="text" name="country" required maxlength="50" placeholder="Enter your country name" class="input">
                <p>Pin code <span>*</span></p>
                <input type="number" name="pin_code" required maxlength="6" placeholder="e.g. 1440" class="input" min="0" max="999999">
                </div>
            </div>
            <input type="submit" value="Place order" name="place_order" class="btn">
        </form>

        <div class="summary">

        <p class="title">Total Items :</p>

        <?php
            $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
            $total = 0;
            $grand_total = 0;
            if(mysqli_num_rows($select_cart) > 0){
                while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                $total_price = number_format($fetch_cart['price'] * $fetch_cart['quantity']);
                $grand_total = $total += $total_price;
        ?>
            <div class="flex">
                <img src="uploaded_img/<?= $fetch_cart['image'];?>" alt="">
                <div>
                    <h3 class="name"><?= $fetch_cart['name'];?></h3>
                    <p class="price">₱<?= $fetch_cart['price']?> (<?= $fetch_cart['quantity']; ?>)</p>
                </div>
            </div>
            <!-- <span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span> -->
        <?php
            }
        }else{
            echo "<div class='display-order'><span>Your cart is empty</span></div>";
        }
        ?>
            <div class="grand-total"><span>Grand total : </span>₱<?= $grand_total; ?> </div>
        </div>

    </div>  
    </section>


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