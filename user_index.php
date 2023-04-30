<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['user_name'])){
    header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sarah's Harvest</title>
    <link rel="shortcut icon" href="img/sharvestfav.png" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
   <nav class="navbar navbar-expand-lg navbar-white bg-light py-3 fixed-top">
   <div class="container-fluid">
      <a href="user_index.php"><img class="img-responsive" src="img/sharvest.png"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">

         <ul class="navbar-nav me-auto mb-2 mb-lg-0">

            <li class="nav-item">
               <a class="nav-link active" aria-current="page" href="user_index.php">Home</a>
            </li>

            <li class="nav-item">
               <a class="nav-link" href="menu.php">Menu</a>
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


    <!-- advert 1 -->
    <div class="container1">
        <section class="ad_section">
            <div class="row">
            <div class="col-12 col-md-6">
                <div class="detail-box">
                <h1>
                Sarah's Harvest
                </h1>
                <p>
                Philippines' freshest sandwiches and salads for every occasion. Our dishes are made daily with the finest ingredients, perfect for your office lunch, family gatherings, and more!
                </p>
                    <div class="btn-box">
                    <a href= "menu.php">
                        Order Now
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="img-box">
                    <img src="img/adsalad.png">
                </div>
            </div>
            </div>
        </section>
    </div>

    <!-- end advert 1 -->

    <!-- advert 2 -->

    <div class="container2">
        <section class="ad_section2">
            <div class="row">
                <div class="col-12 col-md-6" style="background-color: #386641">
                    <div class="img-box">
                    <img src="img/adsandwich.jpg">
                    </div>
                </div>
                <div class="col-12 col-md-6" style="background-color: #386641">
                    <div class="detail-box">
                    <h1>
                        About Us
                    </h1>
                    <p>Since 2018, we've been crafting delicious and healthy salads and sandwiches that nourish your body and satisfy your taste buds. Our mission is to make healthy eating a delight, one flavorful bite at a time.</p>
                    <p class="line2">Healthy, fresh, and delicious - bite into happiness!</p>
                    <div class="btn-box">
                        <a href="about.html">
                            Learn More
                        </a>
                    </div>
                    </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- end advert 2 -->

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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>