<?php
include_once('config.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $card_number = $_POST['card_number'];
    $expiry_date = $_POST['expiry_date'];
    $cvv = $_POST['cvv'];

    $payment_success = true; 

    if ($payment_success) {
     
        echo "<div class='payment-success'>";
        echo "<h1>Payment Completed Successfully!</h1>";
        echo "<p>Your payment has been successfully processed. Thank you for your purchase!</p>";
        echo "</div>";

        echo "<script>
                setTimeout(function() {
                    window.location.href = 'shop.php'; // Ridrejto në faqen shop.php pas 3 sekondash
                }, 3000); // 3000 milisekonda = 3 sekonda
              </script>";
    } else {
        
        echo "<div class='payment-failed'>";
        echo "<h1>Payment Failed</h1>";
        echo "<p>Sorry, there was an issue processing your payment. Please try again later.</p>";
        echo "</div>";
    }
}
?>


<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        color: #333;
        margin: 0;
        padding: 0;
    }

    .payment-success, .payment-failed {
        width: 80%;
        max-width: 600px;
        margin: 20px auto;
        padding: 20px;
        border-radius: 5px;
        text-align: center;
    }

    .payment-success {
        background-color: #4CAF50; 
        color: white;
        border: 2px solid #388E3C;
    }

    .payment-failed {
        background-color: #F44336;
        color: white;
        border: 2px solid #D32F2F;
    }

    .payment-success h1, .payment-failed h1 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .payment-success p, .payment-failed p {
        font-size: 18px;
        margin-top: 0;
    }
</style>
