<?php
include_once('config.php'); 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $productId = intval($_POST['product_id']);
    $size = $_POST['size'];


    $sql = "INSERT INTO cart (product_id,size) VALUES (:product_id,:size)";
    $stmt = $conn->prepare($sql);
    
    
    $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
    $stmt->bindParam(':size', $size, PDO::PARAM_STR);

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
