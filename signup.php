<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce Sign-up</title>
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
            clip-path: polygon(0 0, 95% 0, 70% 100%, 0% 100%);
        }

        .left-side h1 {
            font-size: 2.0rem;
            margin-bottom: 20px;
            margin-right: 70px;
        }

        .left-side p {
            margin-bottom: 20px;
            margin-right: 70px;
        }

        .right-side {
            margin-right: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-container {
            width: 90%;
            max-width: 350px;
            padding: 30px;
            border-radius: 8px;
            background-color: #f9f9f9;
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
                <h1>Ecommerce Platform</h1>
                <p>Welcome to our eCommerce platform, where you can easily browse, shop, and manage your purchases online.</p>
            </div>
        </div>
        <div class="right-side">
            <div class="form-container">
                <form id="signupForm" action="register.php" method="POST">
                    <div class="error-message" id="errorMessage"></div>
                    <input type="text" name="emri" id="name" placeholder="Enter name" required>
                    <input type="text" name="username" id="username" placeholder="Enter username" required>
                    <input type="email" name="email" id="email" placeholder="Enter email" required>
                    <input type="password" name="password" id="password" placeholder="Enter password" required>
                    <input type="password" name="confirm_password" id="confirmPassword" placeholder="Confirm password" required>
                    <button type="submit" name="submit">Sign Up</button>
                </form>
                <div class="login-link">
                    <p>Already have an account? <a href="login.php">Sign In</a></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('signupForm').addEventListener('submit', function (e) {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

 
            const passwordRegex = /^(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{6,}$/;

            let errorMessage = '';

            if (!emailRegex.test(email)) {
                errorMessage += 'The email is not valid. It must contain "@" and ".".<br>';
            }

            if (!passwordRegex.test(password)) {
                errorMessage += 'The password must be at least 6 characters long, contain an uppercase letter, and a number.<br>';
            }

            if (password !== confirmPassword) {
                errorMessage += 'The password and confirmation do not match.<br>';
            }

            if (errorMessage) {
                e.preventDefault(); 
                document.getElementById('errorMessage').innerHTML = errorMessage;
                document.getElementById('errorMessage').style.display = 'block';
            }
        });
    </script>
</body>
</html>
