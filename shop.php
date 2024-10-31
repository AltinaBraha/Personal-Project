<?php

include_once('config.php'); 
include("product.php");
include_once("header.php");


$sql = "SELECT * FROM products";
$selectProducts = $conn->prepare($sql);
$selectProducts->execute();

$products_data = $selectProducts->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Display</title>
    <link rel="stylesheet" href="shop.css">
    
</head>
<body>

    

    <div class="product-container">
        <?php

        foreach ($products_data as $product) {
            echo '<div class="product-card">';
            echo '<img src="' . $product['img_url'] . '" alt="' . $product['name'] . '">'; 
            echo '<h3>' . $product['name'] . '</h3>'; 
            echo '<p class="price">$' . number_format($product['price'], 2) . ' </p>';  
            echo '<div class="rating">';
            echo '<span>★★★★★</span>';
            echo '<span>(' . $product['reviews'] . ' Reviews)</span>';  
            echo '</div>';
            echo '<a href="details.php?id=' . $product['id'] . '" class="add-to-cart">Details</a>';
            echo '</div>';
        }
        ?>
    </div>

</body>
</html>
