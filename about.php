<?php

@include 'config.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>About Us - Sarah's Harvest</title>
   <link rel="shortcut icon" href="img/sharvestfav.png" type="image/x-icon">

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
               <a class="nav-link" href="user_index.php">Home</a>
            </li>

            <li class="nav-item">
               <a class="nav-link" href="menu.php">Menu</a>
            </li>

            <li class="nav-item">
               <a class="nav-link active" aria-current="page" href="about.php">About Us</a>
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


    <!-- about us -->
       <div class="about-container">
           <div class="group">
               <div class="box">
                   <h2>01</h2>
                   <h3>CodeCorner</h3>
                   <p>Sarah's Harvest partners with CodeCorner, a cutting-edge technology company with a mission to provide information systems for small businesses. Founded in March 2023 by Daryl, Hannah, and Leann, friends who met while pursuing their BA in Multimedia Studies at the University of the Philippines, embodies their shared passion for technology and innovation.</p>
               </div>
               <div class="box">
                   <h2>02</h2>
                   <h3>Vision</h3>
                   <p>To become a leading provider of Information Systems solutions, known for our creativity, excellence, and commitment to customer satisfaction. We strive to be a trusted partner for small businesses, helping them harness the potential of technology to optimize their processes, enhance their competitiveness, and achieve sustainable growth. We aspire to continuously innovate, evolve, and expand our offerings to deliver exceptional value to our clients and make a positive impact on their success.</p>
               </div>
               <div class="box">
                   <h2>03</h2>
                   <h3>Mission</h3>
                   <p>To provide innovative and reliable Information Systems solutions to small businesses, enabling them to streamline their operations, enhance their productivity, and ultimately, achieve their business goals. We aim to deliver cutting-edge software solutions that leverage the power of technology to solve real-world problems, improve efficiency, and empower businesses to thrive in the digital age.</p>
               </div>
           </div>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>