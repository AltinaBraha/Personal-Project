<?php
include("header.php");
include("config.php");
include("contactform.php");

$contactForm = new ContactForm($conn);
$contactForm->handleFormSubmission();
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link rel="stylesheet" href="contactus.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
</head>
<body>
    <div class="all">
        <div class="part1">
            <div class="part1_tx">
                <h1>ℂ𝕆ℕ𝕋𝔸ℂ𝕋 𝕌𝕊</h1>
                <h2>Contact Information</h2>
            </div>
        </div>
        <div class="part2">
            <div class="part2_box">
                <div class="part2_box_tx">
                    <i class="fa-solid fa-phone"></i>
                    <h2>+383 49 400 711</h2>
                    <p>Contact us at our number.</p>
                </div>
            </div>
            <div class="part2_box">
                <div class="part2_box_tx">
                    <i class="fa-solid fa-envelope"></i>
                    <h2>ecommerce@gmail.com</h2>
                    <p>Contact us at our email.</p>
                </div>
            </div>
            <div class="part2_box3">
                <div class="part2_box_tx">
                    <i class="fa-solid fa-location-dot"></i>
                    <h2>Kosova, Prishtine</h2>
                    <p>The location where we are located.</p>
                </div>
            </div>
        </div>

        <div class="part3">
            <div class="part3_left">
                <div class="part3_left_tx">
                    <h1>𝔽𝕆ℝ𝕄</h1>
                    <h2>Get in Touch!!</h2>
                    <p>We are dedicated to helping you discover the best beauty products that enhance your natural beauty. If you have any questions about our products, need assistance with an order, or want to learn more about our brand, we are here to help!</p>
                </div>
            </div>
            <div class="part3_right">
                <form method="POST" action=""> <!-- Shtojmë method dhe action -->
                    <input type="text" name="name" id="name" placeholder="Name" required> <br><br>
                    <input type="email" name="email" id="email" size="40" placeholder="Email" required> <br><br>
                    <textarea name="message" cols="20" rows="10" maxlength="500" placeholder="Message" required></textarea> <br><br>
                    <button type="submit">Submit</button> <!-- Shtojmë type="submit" -->
                </form>
            </div>
        </div>
    </div>
</body>
<?php include_once("footer.php"); ?>
</html>
