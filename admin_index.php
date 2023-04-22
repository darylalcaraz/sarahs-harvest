<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
    header('location:login.php');
}

if(isset($_POST['add_product'])){
    $p_name = $_POST['p_name'];
    $p_price = $_POST['p_price'];
    $p_image = $_FILES['p_image']['name'];
    $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
    $p_image_folder = 'uploaded_img/'.$p_image;

    $insert_query = mysqli_query($conn, "INSERT INTO `products` (name, price, image) VALUES('$p_name', '$p_price', '$p_image')") or die('Query Failed');

    if($insert_query){
        move_uploaded_file($p_image_tmp_name, $p_image_folder);
        $message[] = 'Product added succesfully';
        header('location:admin_index.php');
    }else{
        $message[] = 'Could not add the product';
        header('location:admin_index.php');
    };
};

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $delete_query = mysqli_query($conn, "DELETE FROM `products` WHERE id = $delete_id ") or die('Query failed');
    if($delete_query){
        $message[] = 'Product has been deleted';
        header('location:admin_index.php');
    }else{
        $message[] = 'Product could not be deleted';
        header('location:admin_index.php');
    };
};

if(isset($_POST['update_product'])){
    $update_p_id = $_POST['update_p_id'];
    $update_p_name = $_POST['update_p_name'];
    $update_p_price = $_POST['update_p_price'];
    $update_p_image = $_FILES['update_p_image']['name'];
    $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
    $update_p_image_folder = 'uploaded_img/'.$update_p_image;

    $update_query = mysqli_query($conn, "UPDATE `products` SET name = '$update_p_name', price = '$update_p_price', image = '$update_p_image' WHERE id = '$update_p_id'");

    if($update_query){
        move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
        $message[] = 'Product updated succesfully';
        header('location:admin_index.php');
    }else{
        $message[] = 'Product could not be updated';
        header('location:admin_index.php');
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>ADMIN - Sarah's Harvest</title>

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
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
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
                        <a href="#"><i class="fas fa-user"></i></a>
                        <a href="cart.php"><i class="fas fa-shopping-bag"> <span>0</span></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container">
        
        <!-- Form for adding new product to the system -->
        <section>
            <form action="" method="post" class="add-product-form" enctype="multipart/form-data">
                <h3>Add a New Product</h3>
                <input type="text" name="p_name" placeholder="Enter product name" class="box" required>
                <input type="number" name="p_price" min="0" placeholder="Enter price" class="box" required>
                <input type="file" name="p_image" min="0" accept="image/png, image/jpg, image/jpeg" class="box" required>
                <input type="submit" value="Add Product" name="add_product" class="btn">
            </form>
        </section>

        
    </div>

    <div class="product-container">
    
        <!-- Table that lets admin view, add, edit, or remove a product from the database -->
        <section class="product-table">
                
                <table>
                    <thead>
                        <th>Product Image</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Action</th>
                    </thead>

                    <tbody>
                        <?php

                            $select_product = mysqli_query($conn, "SELECT * FROM `products`");
                            if(mysqli_num_rows($select_product) > 0){
                                while($row = mysqli_fetch_assoc($select_product)){
                        ?>

                        <tr>
                            <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
                            <td><?php echo $row['name']; ?></td>
                            <td>₱<?php echo $row['price']; ?>/-</td>
                            <td>
                                <a href="admin_index.php?delete=<?php echo $row['id'];?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fas fa-trash"></i> Delete </a>
                                <a href="admin_index.php?edit=<?php echo $row['id'];?>" class="option-btn"><i class="fas fa-edit"></i> Update </a>
                            </td>
                        </tr>

                        <?php
                                };
                            }else{
                                echo "<div class='empty'>No Product Added</div>";
                            }
                        ?>  
                    </tbody>

                </table>

            </section>

            <!-- A separate form that contains all the information you can edit in a specific product -->
            <section class="edit-form-container">
                <?php
                
                if(isset($_GET['edit'])){
                    $edit_id = $_GET['edit'];
                    $edit_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = $edit_id");
                    if(mysqli_num_rows($edit_query) > 0){
                        while($fetch_edit = mysqli_fetch_assoc($edit_query)){   
                ?>

                <form action="" method="post" enctype="multipart/form-data">
                    <img src="uploaded_img/<?php echo $fetch_edit['image']; ?>" height="200" alt="">
                    <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['id']; ?>">
                    <input type="text" class="box" required name="update_p_name" value="<?php echo $fetch_edit['name']; ?>">
                    <input type="number" min="0" class="box" required name="update_p_price" value="<?php echo $fetch_edit['price']; ?>">
                    <input type="file" class="box" required name="update_p_image" accept="image/png, image/jpg, image/jpeg">
                    <input type="submit" value="Update product" name="update_product" class="btn">
                    <input type="reset" value="Cancel" id="close-edit" class="option-btn">
                </form>

                <?php
                        };
                    };
                    echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
                };
                ?>
            </section>

        </div>

    <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col-lg-3 col-sm-6 first">
                <div class="single-box">
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quam repellendus sunt praesentium aspernatur iure molestias.</p>
                <img src="img/sharvestwhite.png" style="max-height: 100%; max-width: 100%; margin-top:10%;">
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 second">
                <div class="single-box">
                    <h2>Products</h2>
                <ul>
                    <li><a href="#">Salads</a></li>
                    <li><a href="#">Sandwiches</a></li>
                    <li><a href="#">Salads + Sandwiches Combo</a></li>
                    <li><a href="#">Rice Meals</a></li>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>
</html>