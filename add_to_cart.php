<?php
include_once('config.php'); 


session_start();
if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to add items to the cart.";
    exit(); 
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $productId = intval($_POST['product_id']);
    $selectedSize = htmlspecialchars($_POST['size']);
    $selectedColor = htmlspecialchars($_POST['color']);
    
  
    $userId = $_SESSION['user_id']; 


    if (empty($productId) || empty($selectedSize) || empty($selectedColor)) {
        echo "Missing required fields.";
        exit();
    }


    $sql = "INSERT INTO cart (product_id, size, color, user_id) VALUES (:product_id, :size, :color, :user_id)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
    $stmt->bindParam(':size', $selectedSize, PDO::PARAM_STR);
    $stmt->bindParam(':color', $selectedColor, PDO::PARAM_STR);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);

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
