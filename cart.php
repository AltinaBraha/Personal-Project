<?php
include_once('config.php');
include("header.php");

$sql = "SELECT c.id as cart_id, c.color, c.size, p.name, p.price, p.img_url 
        FROM cart c
        JOIN products p ON c.product_id = p.id";
$stmt = $conn->query($sql);
$cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);


$subtotal = 0;
foreach ($cartItems as $item) {
    $subtotal += $item['price'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>
    <link rel="stylesheet" href="style/cart.css">
</head>
<body>
    <div class="cart-container">
                <div class="cart">
                    <h1>My Bag</h1>
                    <div class="cart-items">
                        <?php if (!empty($cartItems)): ?>
                            <?php foreach ($cartItems as $item): ?>
                                <div class="cart-item">
                                    <img src="<?php echo htmlspecialchars($item['img_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="cart-item-image">

                                    <div class="cart-item-details">
                                        <h2><?php echo htmlspecialchars($item['name']); ?></h2>
                                        <p>Size: <?php echo htmlspecialchars($item['size']); ?></p>
                                        <p>Color: <?php echo htmlspecialchars($item['color']); ?></p>
                                    </div>

                                    <div class="cart-item-price">
                                        <p>£<?php echo number_format($item['price'], 2); ?></p>
                                        <a href="remove_from_cart.php?id=<?php echo $item['cart_id']; ?>" class="cart-item-remove">Remove</a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Your cart is empty!</p>
                        <?php endif; ?>
                    </div>
                    <div class="total">
                        <p>Sub-total: £<?php echo number_format($subtotal, 2); ?></p>
                    </div>
                </div>

                <div class="payment-section">
            <h2>Total</h2>
            <p>Sub-total: £<?php echo number_format($subtotal, 2); ?></p>
            <p>Delivery: Free</p>
            <hr>
            <p class="total-price">Total: £<?php echo number_format($subtotal, 2); ?></p>

            <form action="process_payment.php" method="POST" class="payment-form">
                <h3>Payment Details</h3>
                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>

                <label for="card-number">Card Number:</label>
                <input type="text" id="card-number" name="card_number" placeholder="XXXX XXXX XXXX XXXX" required maxlength="19">

                <div class="expiry-cvv">
                    <div>
                        <label for="expiry-date">Expiry Date:</label>
                        <input type="date" id="expiry-date" name="expiry_date" placeholder="MM/YY" required maxlength="5">
                    </div>
                    <div>
                        <label for="cvv">CVV:</label>
                        <input type="text" id="cvv" name="cvv" placeholder="123" required maxlength="3">
                    </div>
                </div>
                <button type="submit" class="checkout-btn">Pay Now</button>
               
            </form>

            <script>
        // Përdorimi i JavaScript për të trajtuar klikimin e butonit "Pay Now"
        document.getElementById("payment-form").addEventListener("submit", function(event) {
            event.preventDefault(); // Parandalon rifreskimin e faqes
            
            // Shfaq alert për suksesin e pagesës
            alert("Payment completed successfully! Thank you for your purchase.");

            // Pasi të shfaqet mesazhi, mund të bëni një redirect në një faqe tjetër (nëse dëshironi)
            // window.location.href = "thank_you.php";
        });
    </script>

            <div class="payment-methods">
            <p>We Accept:</p>
            <img src="images/paypal.png" alt="Payment Methods" style="max-width: 100%; height: auto; width: 300px;">
        </div>

        </div>

    </div>
</body>
</html>
<?php
    include("footer.php");
?>