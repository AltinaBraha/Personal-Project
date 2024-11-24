<?php
include_once('config.php');

if (isset($_GET['id'])) {
    $cartId = intval($_GET['id']);

    // Fshi produktin nga tabela 'cart'
    $sql = "DELETE FROM cart WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $cartId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header('Location: cart.php?removed=1');
        exit();
    } else {
        echo "Error removing item.";
    }
} else {
    header('Location: cart.php');
    exit();
}
?>
