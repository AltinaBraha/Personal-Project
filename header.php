<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beauty & Wellness</title>
    <link rel="stylesheet" href="homepage.css">
</head>
<body>

<nav class="navbar">
    <div class="container">
        <div class="logo">
            <a href="#">Ecommerce</a>
        </div>
        <ul class="nav-links">
            <?php
            session_start(); // Start the session

            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
                // Assuming you have a role stored in the session
                $is_admin = $_SESSION['is_admin']; // Example: 'admin' or 'user'

                echo '<li><a href="homepage.php">Home</a></li>';
                echo '<li><a href="shop.php">Shop</a></li>';
                echo '<li><a href="contactus.php">Contact</a></li>';

                // Show Dashboard link only for admin users
                if ($is_admin === "true") {
                    echo '<li><a href="dashboard.php">Dashboard</a></li>';
                }

                echo '<li><a href="logout.php">Logout</a></li>';
            } else {
                echo '<li><a href="login.php">Sign In</a></li>';
            }
            ?>
        </ul>
    </div>
</nav>
