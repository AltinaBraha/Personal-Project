<?php
include_once('config.php'); 


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 
    $productId = intval($_POST['product_id']);
    $selectedSize = htmlspecialchars($_POST['size']);
    $selectedColor = htmlspecialchars($_POST['color']);
    
    
    $sql = "INSERT INTO cart (product_id, size, color) VALUES (:product_id, :size, :color)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
    $stmt->bindParam(':size', $selectedSize, PDO::PARAM_STR);
    $stmt->bindParam(':color', $selectedColor, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo '<script>alert("added to cart successfully!");</script>';
        header('Location: shop.php?success=1'); 
        exit();
    } else {
        echo "Error adding item to cart.";
    }
} else {
    header('Location: product.php'); 
    exit();
}


?>
