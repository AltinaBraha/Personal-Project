<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beauty & Wellness</title>
    <link rel="stylesheet" href="style/homepage.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<nav class="navbar">
    <div class="container">
        <div class="logo">
            <a href="#">Ecommerce</a>
        </div>
        <ul class="nav-links">
            <?php
            
            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
                $is_admin = $_SESSION['is_admin'];

                echo '<li><a href="homepage.php">Home</a></li>';
                echo '<li><a href="shop.php">Shop</a></li>';
                echo '<li><a href="contactus.php">Contact</a></li>';

                if ($is_admin === "true") {
                    echo '<li><a href="dashboard.php">Dashboard</a></li>';
                }
                echo '<li><a href="cart.php"><i class="bx bx-cart"></i></a></li>';
                echo '<li><a href="logout.php">Logout</a></li>';
            } else {
                echo '<li><a href="login.php">Sign In</a></li>';
            }
            ?>
        </ul>
   
        <div class="menu-toggle">&#9776;</div>
    </div>
</nav>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const menuToggle = document.querySelector('.menu-toggle');
    const navLinks = document.querySelector('.nav-links');

    menuToggle.addEventListener('click', function () {
        navLinks.classList.toggle('active');
    });
});

</script>
</body>
</html>
