<?php
include_once('config.php'); 
include("header.php");


if (isset($_GET['id'])) {
    $productId = intval($_GET['id']); 
    $userId = intval($_GET['id']); 

  
    $sql = "SELECT * FROM products WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $productId, PDO::PARAM_INT);
    $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
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
    <link rel="stylesheet" href="style/details.css">
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
                <form method="post" action="add_to_cart.php"> 
                <div class="colors">
                    <p>Color:</p>
                    <?php foreach ($defaultColors as $color): ?>
                        <label>
                            <button type="button" class="color-btn" style="background-color: <?php echo htmlspecialchars($color); ?>;" onclick="selectColor(this, '<?php echo htmlspecialchars($color); ?>')"></button>
                        </label>
                    <?php endforeach; ?>
                    <input type="hidden" name="color" id="selectedColor" required>
                </div>
                <div class="sizes">
                    <div>
                        <p class="nr">Number:</p>
                    </div>
                    <?php foreach ($defaultSizes as $size): ?>
                        <label>
                            <input type="radio" name="size" value="<?php echo htmlspecialchars($size); ?>" required>
                            <span class="size-btn"><?php echo htmlspecialchars($size); ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>

                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
                <button type="submit" class="add-to-cart" onclick="showAddToCartAlert()">Add to Cart</button>
            </form>
    </div>
<script>
    let selectedColor = '';

    function selectColor(element, color) {
   
        selectedColor = color;
        
        document.getElementById('selectedColor').value = color;

     
        const buttons = document.querySelectorAll('.color-btn');
        buttons.forEach(btn => btn.style.border = 'none'); 
        element.style.border = '2px solid #000'; 
    }

    function showAddToCartAlert() {
        alert("Product has been added to your cart!");
    }
</script>
</body>
</html>
