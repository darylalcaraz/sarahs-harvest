<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
    header('location:login.php');
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $delete_query = mysqli_query($conn, "DELETE FROM `orders` WHERE id = $delete_id ") or die('Query failed');
    if($delete_query){
        $success_msg[] = 'Order has been deleted';
    }else{
        $warning_msg[] = 'Order could not be deleted';
    };
};

if(isset($_GET['edit'])){
    $delete_id = $_GET['edit'];
    $delete_query = mysqli_query($conn, "DELETE FROM `orders` WHERE id = $delete_id ") or die('Query failed');
    if($delete_query){
        $success_msg[] = 'Order has been completed';
    }else{
        $warning_msg[] = 'Order could not be completed';
    };
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>ADMIN - Sarah's Harvest</title>
   <link rel="shortcut icon" href="img/sharvestfav.png" type="image/x-icon">

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

   <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php

// Notification message for every action in the system
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
                    <a class="nav-link" href="admin_index.php">Home</a>
                    </li>

                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="orders.php">Orders</a>
                    </li>

                    <li class="nav-item">
                    <a class="nav-link" href="about.html">About Us</a>
                    </li>

                </ul>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 icon">
                    <li class="nav-item icons">
                        <a href="admin_account.php"><i class="fas fa-user"></i></a>
                        <a href="cart.php"><i class="fas fa-shopping-bag"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

   <div class="order-container">
    
        <!-- Table that lets admin view, add, edit, or remove a product from the database -->
        <section class="order-table">
                
            <table>
                <thead>
                    <th>Customer Details</th>
                    <th>Orders</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </thead>

                <tbody>
                    <?php

                        $select_product = mysqli_query($conn, "SELECT * FROM `orders`");
                        if(mysqli_num_rows($select_product) > 0){
                            while($row = mysqli_fetch_assoc($select_product)){
                    ?>

                    <tr>
                        <td class="first-data">
                            <br>
                            <p> <span>Name :</span> <?php echo $row['name']; ?></p>
                            <p> <span>Number :</span> <?php echo $row['number']; ?></p>
                            <p> <span>Email :</span> <?php echo $row['email']; ?></p>
                            <p> <span>Address :</span> <?php echo $row['flat']. ' ' .$row['street']. ' ' .$row['city']. ' ' .$row['country']. ' ' .$row['pin_code']; ?></p>
                            <p> <span>Address Type :</span> <?php echo $row['address_type']; ?></p>
                            <p> <span>Payment mode :</span> <?php echo $row['method']; ?></p>
                            <br>
                        </td>
                        <td class="second-data"><?php echo $row['total_products']; ?></td>
                        <td class="third-data">₱<?php echo $row['total_price']; ?></td>
                        <td class="fourth-data">
                            <a href="orders.php?delete=<?php echo $row['id'];?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this order?');"><i class="fas fa-trash"></i> Delete </a>
                            <a href="orders.php?edit=<?php echo $row['id'];?>" class="option-btn" onclick="return confirm('Are you sure the order is complete?')"><i class="fas fa-check"></i>Done</a>
                        </td>
                    </tr>

                    <?php
                            };
                        }else{
                            echo "<div class='empty'>No orders available</div>";
                        }
                    ?>  
                </tbody>

            </table>

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