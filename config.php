<?php

$user = "root";
$pass ="";
$server="localhost";
$dbname = "ecommerce";


try{
    $conn= new PDO("mysql:host=$server; dbname=$dbname", $user, $pass);
    echo "me sukses";
}catch(PDOException $e){
    echo "error:" . $e->getMessage();
}

?>
