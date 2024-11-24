<?php
session_start();
include_once('config.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];

//kontrollojme a eshte e zbraset shporta
$sql = "SELECT COUNT(*) AS item_count FROM cart WHERE user_id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result['item_count'] == 0) {
    echo "<div class='cart-empty'>";
    echo "<h1>Your cart is empty</h1>";
    echo "<p>You have not added any products to your cart. Please add products and try again.</p>";
    echo "<a href='shop.php' class='btn'>Return to Shop</a>";    
    echo "</div>";
    exit(); 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $card_number = $_POST['card_number'];
    $expiry_date = $_POST['expiry_date'];
    $cvv = $_POST['cvv'];

    $payment_success = true; 

    if ($payment_success) {
        try {
         
            $sql = "SELECT p.name, p.price, p.img_url, c.size
                    FROM cart c
                    JOIN products p ON c.product_id = p.id
                    WHERE c.user_id = :user_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            $purchasedItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

        
            $sql = "DELETE FROM cart WHERE user_id = :user_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();

            
            echo "<div class='payment-success'>";
            echo "<h1>Payment Successful!</h1>";
            echo "<p>Thank you for your purchase! Product details:</p>";


            echo "<div class='product-list'>";
            foreach ($purchasedItems as $item) {
                echo "<div class='product-item'>";
                echo "<img src='" . htmlspecialchars($item['img_url']) . "' alt='Photo' class='product-image'>";
                echo "<h2>" . htmlspecialchars($item['name']) . "</h2>";
                echo "<p>Price: £" . number_format($item['price'], 2) . "</p>";
                echo "<p>Size: " . htmlspecialchars($item['size']) . "</p>";
                echo "</div>";
            }
            echo "</div>";

            echo "<p>You will be redirected to our store in 10 seconds.</p>";
            echo "</div>";

            echo "<script>
                    setTimeout(function() {
                        window.location.href = 'shop.php'; 
                    }, 10000); // 10000 milisekonda = 10 sekonda
                  </script>";
        } catch (Exception $e) {
            echo "<div class='payment-failed'>";
            echo "<h1>Gabim</h1>";
            echo "<p>Failed: " . htmlspecialchars($e->getMessage()) . "</p>";
            echo "</div>";
        }
    } else {
        echo "<div class='payment-failed'>";
        echo "<h1>Payment Failed</h1>";
        echo "<p>We're sorry, there was a problem processing the payment. Please try again later.</p>";
        echo "</div>";
        
    }
}
?>

<style>

body {
    font-family: 'Poppins', Arial, sans-serif;
    background-color: #f9f9f9;
    color: #333;
    margin: 0;
    padding: 0;
    display: flex;
    align-items: flex-start; 
    justify-content: center;
    min-height: 100vh; 
    overflow-x: hidden;
    flex-direction: column; 
}

.container {
    width: 100%;
    max-width: 1200px; 
    padding: 20px;
    box-sizing: border-box;
    text-align: center;
}



.payment-success, .payment-failed, .cart-empty {
    width: 90%;
    max-width: 600px;
    margin: 20px auto;
    padding: 30px;
    border-radius: 15px;
    text-align: center;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    animation: fadeIn 0.8s ease;
}


.payment-success {
    background-color: #e8f5e9;
    color: #2e7d32;
    border: 2px solid #388e3c;
}


.payment-failed, .cart-empty {
    background-color: #ffebee;
    color: #c62828;
    border: 2px solid #d32f2f;
}


.payment-success h1, .payment-failed h1, .cart-empty h1 {
    font-size: 28px;
    margin-bottom: 20px;
    color: #444;
}

.payment-success p, .payment-failed p, .cart-empty p {
    font-size: 18px;
    margin: 15px 0;
    color: #666;
}


.cart-empty img.empty-cart-image {
    width: 150px;
    margin-bottom: 20px;
    opacity: 0.9;
}

.cart-empty .btn {
    display: inline-block;
    text-decoration: none;
    color: #fff;
    background-color: #1976d2;
    padding: 12px 30px;
    font-size: 16px;
    border-radius: 5px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.cart-empty .btn:hover {
    background-color: #1565c0;
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
    transform: translateY(-2px);
}


.product-list {
    margin: 20px 0;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 15px;
}

.product-item {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 10px;
    width: calc(33.33% - 20px);
    max-width: 200px;
    padding: 15px;
    text-align: center;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.product-item img.product-image {
    max-width: 100%;
    height: auto;
    margin-bottom: 10px;
    border-radius: 5px;
}


@media (max-width: 768px) {
    .product-item {
        width: calc(50% - 20px);
    }
}

@media (max-width: 480px) {
    .product-item {
        width: 100%;
    }
}


@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

</style>
