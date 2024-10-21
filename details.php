<?php
include_once('config.php'); 


if (isset($_GET['id'])) {
    $productId = intval($_GET['id']); 

  
    $sql = "SELECT * FROM products WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $productId, PDO::PARAM_INT);
    $stmt->execute();

    $product = $stmt->fetch(PDO::FETCH_ASSOC);
} else {

    header('Location: products.php');
    exit();
}

if (!$product) {

    echo "Product not found.";
    exit();
}


$defaultColors = ['#f57c00', '#00bcd4', '#8d6e63']; 
$defaultSizes = ['37', '38', '39', '40', '41', '42'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details - <?php echo htmlspecialchars($product['name']); ?></title>
    <link rel="stylesheet" href="details.css">
</head>
<body>

    <div class="container">

        <!-- Product Section -->
        <section class="product-details">
            <div class="product-images">
                <img src="<?php echo htmlspecialchars($product['img_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="main-image">
            </div>

            <div class="product-info">
                <h1><?php echo htmlspecialchars($product['name']); ?></h1>
                <p class="product-description">
                    <?php echo htmlspecialchars($product['description']); ?>
                </p>
                <p class="product-price">$<?php echo number_format($product['price'], 2); ?></p>
                <div class="product-rating">
                    Review: ★★★★☆ (<?php echo htmlspecialchars($product['reviews']); ?> Reviews)
                </div>

                <div class="product-options">
                    <div class="colors">
                        <p>Color:</p>
                        <?php foreach ($defaultColors as $color): ?>
                            <button class="color-btn" style="background-color: <?php echo htmlspecialchars($color); ?>;"></button>
                        <?php endforeach; ?>
                    </div>
                    <div class="sizes">
                        <p>Size:</p>
                        <?php foreach ($defaultSizes as $size): ?>
                            <button class="size-btn"><?php echo htmlspecialchars($size); ?></button>
                        <?php endforeach; ?>
                    </div>
                </div>

                <button class="add-to-cart">Add to Cart</button>
            </div>
        </section>
    </div>

</body>
</html>
