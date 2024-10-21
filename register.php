<?php
include_once('config.php');

if(isset($_POST['submit'])) {
    $emri = $_POST['emri'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $tempPass = $_POST['password'];
    $tempConfirm = $_POST['confirm_password'];

    // Check if any field is empty
    if(empty($emri) || empty($username) || empty($email) || empty($tempPass) || empty($tempConfirm)) {
        echo "You have not filled all fields.";
    } 
    // Check if passwords match before hashing
    elseif($tempPass !== $tempConfirm) {
        echo "Passwords do not match.";
    } else {
        // Hash the password after validation
        $password = password_hash($tempPass, PASSWORD_DEFAULT);

        // SQL Insert query
        $sql = "INSERT INTO users (emri, username, email, password) 
                VALUES (:emri, :username, :email, :password)";

        // Prepare and bind parameters
        $insertSQL = $conn->prepare($sql);
        $insertSQL->bindParam(':emri', $emri);
        $insertSQL->bindParam(':username', $username);
        $insertSQL->bindParam(':email', $email);
        $insertSQL->bindParam(':password', $password);

        // Execute the statement
        if ($insertSQL->execute()) {
            header("Location: login.php");
        } else {
            echo "Error: Could not execute the query.";
        }
    }
}
?>
