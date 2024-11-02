<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/add.css"> 
    <title>Add Product</title>
</head>
<body>
<?php
session_start(); 

include("user.php");
include("config.php"); 


if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    if (isset($_SESSION['id'])) {
        $userId = $_SESSION['id'];
    } else {
        echo "<p>User ID is not set in the session.</p>";
        exit; 
    }
    

    ?>

    <div class="format">
        <div class="forma1">
            <h1 class="editP">Add Product</h1>
            <form method="post" class="forma" action="?action=add_product&user_id=<?= $userId ?>" enctype="multipart/form-data">
                <label class="labelat" for="product_name">Product Name:</label>
                <input class="inputi" type="text" name="product_name" required>

                <label class="labelat" for="price">Price:</label>
                <input class="inputi" type="number" name="price" step="0.01" required>

                <label class="labelat" for="image">Image:</label>
                <input class="labelat" type="file" name="image" id="fileToUpload" required>

                <label class="labelat" for="reviews">Reviews:</label>
                <input class="inputi" type="number" name="reviews" required>

                <label class="labelat" for="description">Description:</label>
                <textarea class="inputi" name="description" required></textarea>

                <input class="submit" type="submit" name="add_product" value="Add Product">
            </form>
        </div>
    </div>

    <?php
    if (isset($_POST['add_product'])) {
        $productName = $_POST['product_name'];
        $price = $_POST['price'];
        $reviews = $_POST['reviews'];
        $description = $_POST['description'];

        $image = $_FILES['image'];
        $imagePath = 'images/' . basename($image['name']);
        
        if (move_uploaded_file($image['tmp_name'], $imagePath)) {
            $stmt = $conn->prepare("INSERT INTO products (name, price, reviews, img_url, description, user_id) VALUES (?, ?, ?, ?, ?, ?)");
        
            if ($stmt->execute([$productName, $price, $reviews, $imagePath, $description, $userId])) {
                echo "<p>Product added successfully!</p>";
                header('Location: dashboard.php'); 
            } else {
                echo "<p>Error adding product.</p>";
            }
        } else {
            echo "<p>Error uploading image.</p>";
        }
    }
} else {
    echo "<p>You are not logged in.</p>";
}
include("footer.php");
?>
