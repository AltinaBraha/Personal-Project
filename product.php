<?php

include("config.php");
class Product
{
    private $conn;

 
    public function __construct($dbConn) {
        $this->conn = $dbConn;
    }

    public function getAllProducts()
    {
        $sql = "SELECT * FROM products";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array();
        }
    }

    public function getProductById($productId)
    {
        $sql = "SELECT * FROM products WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $productId);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                return $result->fetch_assoc();
            }
        }
        return null;
    }

      // Add product method
      public function addProduct($productName, $price, $imagePath, $userId) {
        $sql = "INSERT INTO products (product_name, price, image_path, user_id) VALUES (:product_name, :price, :image_path, :user_id)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':product_name', $productName);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':image_path', $imagePath);
        $stmt->bindParam(':user_id', $userId);
        return $stmt->execute();
    }
    

    public function updateProduct($productid, $name, $description, $price, $reviews, $img_url)
    {
        $sql = "UPDATE products SET name = ?, description = ?, price = ?, reviews = ?,  img_url = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sdssi", $name, $description, $price, $reviews, $img_url, $productid);

        return $stmt->execute();
    }

    public function deleteProduct($productId)
    {
        $sql = "DELETE FROM products WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $productId);

        if ($stmt->execute()) {
            header("Location: dashboard.php"); 
        } else {
            echo "Error deleting product: " . $stmt->error;
        }
    }

    public function getProductsByUserId($userId)
    {
        $sql = "SELECT * FROM products WHERE addedbyuser = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array();
        }
    }

    public function getProductsByCategory($category)
    {
        $sql = "SELECT * FROM products WHERE category = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $category);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return array();
        }
    }
}

?>
