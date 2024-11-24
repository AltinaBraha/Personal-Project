<?php
session_start();
include_once('config.php');

$error_message = ''; 

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $error_message = "Please fill in all fields";
    } else {
        $sql = "SELECT id, emri, username, email, password, is_admin FROM users WHERE username = :username";
        $selectUser = $conn->prepare($sql);
        $selectUser->bindParam(":username", $username);
        $selectUser->execute();

        $data = $selectUser->fetch();

        if ($data == false) {
            $error_message = "The user does not exist";
        } else {
            if (password_verify($password, $data['password'])) {
                $_SESSION['user_id'] = $data['id'];
                $_SESSION['username'] = $data['username'];
                $_SESSION['email'] = $data['email'];
                $_SESSION['emri'] = $data['emri'];
                $_SESSION['is_admin'] = $data['is_admin'];
                $_SESSION['logged_in'] = true;

                header('Location: shop.php');
                exit();
            } else {
                $error_message = "The password is not valid";
               
            }
        }
    }
}
?>

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
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 80%;
            height: 80vh;
            display: flex;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .left-side {
            position: relative;
            flex: 1;
            background-color: rgba(106, 20, 64, 0.8);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 30px;
            clip-path: polygon(0 0, 97% 0, 73% 100%, 0% 100%);
        }

        .left-side h1 {
            font-size: 2.0rem;
            margin-bottom: 20px;
            margin-right: 70px;
        }

        .left-side p {
            font-size: 15px;
            margin-bottom: 20px;
            margin-right: 70px;
        }

        .right-side {
            margin-right: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-container {
            width: 90%;
            max-width: 400px;
            padding: 55px;
            border-radius: 8px;
            background-color: #f9f9f9;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input {
            width: 100%;
            padding: 12px;
           margin-right: 30px;
           margin-bottom:20px;
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
            background-color: #333;
        }

        .login-link {
            margin-top: 10px;
            text-align: center;
        }

        .login-link a {
            text-decoration: none;
            color: rgba(106, 20, 64, 0.8);
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left-side">
            <div>
                <h1>Welcome to ECommerce</h1>
                <p>Welcome to our eCommerce platform, where you can easily browse, shop, and manage your purchases online.</p>
            </div>
        </div>
        <div class="right-side">
            <div class="form-container">
                <form action="login.php" method="POST">

                    <div class="form-floating">
                        <label for="floatingInput">Username</label>
                        <input type="text" class="form-control" id="floatingInput" placeholder="Username" name="username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" required>
                    </div>

                    <div class="form-floating">
                        <label for="floatingPassword">Password</label>
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" value="<?php echo isset($_POST['password']) ? htmlspecialchars($_POST['password']) : ''; ?>" required>
                        <?php if (!empty($error_message) && strpos($error_message, 'password') !== false): ?>
                            <div class="error-message"><?php echo $error_message; ?></div>
                        <?php endif; ?>
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
