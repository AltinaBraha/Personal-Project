<?php
session_start(); 
include_once('config.php');
include("header.php");


if (!isset($_SESSION['user_id'])) {
    
    header("Location: login.php");
    exit();
}


$userId = $_SESSION['user_id'];


$sql = "SELECT c.id as cart_id, c.color, c.size, p.name, p.price, p.img_url 
        FROM cart c
        JOIN products p ON c.product_id = p.id
        WHERE c.user_id = :user_id"; 
        
$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
$stmt->execute();

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
            <h1 id='my'>My Bag</h1>
            <div class="cart-items">
                <?php if (!empty($cartItems)): ?>
                    <?php foreach ($cartItems as $item): ?>
                        <div class="cart-item">
                            <img src="<?php echo htmlspecialchars($item['img_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="cart-item-image">

                            <div class="cart-item-details">
                                <h2 id='h2'><?php echo htmlspecialchars($item['name']); ?></h2>
                                <p>Size: <?php echo htmlspecialchars($item['size']); ?></p>
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
            <h2 id='h2'>Total</h2>
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

            <script>
                const cardInput = document.getElementById('card-number');

                cardInput.addEventListener('input', function (e) {
                    let value = e.target.value.replace(/\s+/g, '');
                    if (/[^0-9]/.test(value)) {
                        value = value.replace(/[^0-9]/g, '');
                    }
                    e.target.value = value.match(/.{1,4}/g)?.join(' ') || value; 
                });

                cardInput.addEventListener('keydown', function (e) {
                    if (e.key === 'Backspace' && cardInput.value.endsWith(' ')) {
                        cardInput.value = cardInput.value.slice(0, -1); 
                    }
                });
            </script>


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
                <label for="card">Card Type:</label>
                    <select id="card" name="card" required>
                        <option value="" disabled selected>Choose your card type</option>
                        <option value="visa">Visa</option>
                        <option value="mastercard">MasterCard</option>
                        <option value="paypal">PayPal</option>
                        <option value="american-express">American Express</option>
                    </select>
                <button type="submit" class="checkout-btn">Pay Now</button>
            </form>

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
