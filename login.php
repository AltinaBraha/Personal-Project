<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ECOMMERCE Login</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .container {
            display: flex;
            height: 100vh;
        }
        .left-side {
            background-color: rgba(106, 20, 64, 0.8);
            color: white;
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .left-side h1 {
            font-size: 28px;
        }
        .right-side {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #fff;
        }
        .form-container {
            width: 350px;
            padding: 20px;
            border-radius: 8px;
            background-color: ;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: rgba(106, 20, 64, 0.8);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .login-link {
            margin-top: 10px;
            text-align: center;
        }
        .login-link a {
            text-decoration: none;
            color: rgba(106, 20, 64, 0.8);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left-side">
            <div>
                <h1>Welcome to ECommerce</h1>
                <p>Welcome to our eCommerce platform, where you can easily browse, shop, and manage your purchases online. Explore a wide range of products, enjoy secure payment options, and track your orders with just a few clicks. We are committed to providing you with the best shopping experience.</p>
            </div>
        </div>
        <div class="right-side">
            <div class="form-container">
                <form action="loginLogic.php" method="POST">
                    <div class="form-floating">
                        <label for="floatingInput">Username</label>
                        <input type="text" class="form-control" id="floatingInput" placeholder="Username" name="username" required>
                    </div>
                    <div class="form-floating">
                        <label for="floatingPassword">Password</label>
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" required>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit">Sign in</button>
                    <div class="login-link">
                        <p>Don't have an account? <a href="signup.php">Sign up</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
