<?php

    include('header.php');
    include_once('config.php');
    include("product.php");
    include("contactform.php");
    include('user.php');
    $user = new User($conn); 

    $_SESSION['is_admin'] = "true";

    $sql = "SELECT * FROM products";
    $selectProducts = $conn->prepare($sql);
    $selectProducts->execute();
    $contacts = new ContactForm($conn);

    $contact_entries = $contacts->getAllContacts();



    if (isset($_GET['action']) && $_GET['action'] === 'delete_contact' && isset($_GET['contact_id'])) {
        $contactId = $_GET['contact_id'];
        $contacts->deleteContact($contactId);
    }


    $products_data = $selectProducts->fetchAll();

    if ($_SESSION['is_admin'] === "true") {
        if (isset($_GET['action']) && isset($_GET['user_id'])) {
            $action = $_GET['action'];
            $userId = $_GET['user_id'];

            if ($action === 'edit') {
                $userToEdit = $user->getUserById($userId);
                ?>
                <h1 class="titulli">Edit User</h1>
                <form method="post" action="?action=update&user_id=<?= $userId ?>" class="forma-editi">
                    <label for="new_username">New Username:</label>
                    <input type="text" name="new_username" value="<?= $userToEdit["username"] ?>">
                    <label for="new_email">New Email:</label>
                    <input type="email" name="new_email" value="<?= $userToEdit["email"] ?>">
                    <input type="submit" name="update_user" value="Update User">
                </form>
                <?php
            } elseif ($action === 'delete') {
                $user->deleteUser($userId);
            }
        }

        if (isset($_POST['update_user'])) {
            $newUsername = $_POST['new_username'];
            $newEmail = $_POST['new_email'];
            $user->updateUser($userId, $newUsername, $newEmail);
        }

        $allUsers = $user->getAllUsers();

        echo '<h1 class="titulli">User Dashboard</h1>';
        echo '<div class="all-users">';
        foreach ($allUsers as $currentUser):
            ?>
            <div class="permbajtja-dashboard">
                <h1 class="emri">
                    <?= $currentUser["username"] ?>
                </h1>
                <p class="permbajtja">
                    <?= $currentUser["email"] ?>
                </p>
                <div class="user-delete">
                <a href="?action=edit&user_id=<?= $currentUser['id'] ?>" class="editi">Edit</a>
                <a href="?action=delete&user_id=<?= $currentUser['id'] ?>" class="delete">Delete</a>
                </div>
            </div>
            <hr class="hr" />
            <?php
        endforeach;
        echo'</div>';
    }



    if ($_SESSION['is_admin'] === "true") {
            // Delete Product
            if (isset($_GET['action']) && $_GET['action'] === 'delete_product' && isset($_GET['product_id'])) {
                $productId = $_GET['product_id'];
                
                $deleteCartItems = $conn->prepare("DELETE FROM cart WHERE product_id = :product_id");
                $deleteCartItems->bindParam(':product_id', $productId);
                $deleteCartItems->execute();
                
                
                $sql = "DELETE FROM products WHERE id = :product_id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':product_id', $productId);
                $stmt->execute();
                
                header("Location: dashboard.php");
                exit();
            }
        
        

        // Update Product
        if (isset($_POST['update_product'])) {
            $productId = $_POST['product_id'];
            $productName = $_POST['editProductName'];
            $price = $_POST['editPrice'];
            $reviews = $_POST['editReviews'];
        
    
            if (isset($_FILES['editImageFile']) && $_FILES['editImageFile']['error'] === UPLOAD_ERR_OK) {
                $imageFile = $_FILES['editImageFile'];
                $targetDir = "images/"; 
                $imageUrl = $targetDir . basename($imageFile['name']);
        
            
                if (move_uploaded_file($imageFile['tmp_name'], $imageUrl)) {
                    
                    $sql = "UPDATE products SET name = :name, price = :price, reviews = :reviews, img_url = :img_url WHERE id = :product_id";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':name', $productName);
                    $stmt->bindParam(':price', $price);
                    $stmt->bindParam(':reviews', $reviews);
                    $stmt->bindParam(':img_url', $imageUrl);
                    $stmt->bindParam(':product_id', $productId);
                    $stmt->execute();
                } else {
                    
                    echo "Sorry, there was an error uploading your file.";
                }
            } else {
                
                $sql = "UPDATE products SET name = :name, price = :price, reviews = :reviews WHERE id = :product_id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':name', $productName);
                $stmt->bindParam(':price', $price);
                $stmt->bindParam(':reviews', $reviews);
                $stmt->bindParam(':product_id', $productId);
                $stmt->execute();
            }
        
            header("Location: dashboard.php");
            exit();
        }
        
    }
    if ($_SESSION['is_admin'] === 'true') {
        ?>
        <h1 class="titulli">Contacts</h1>
        <?php
        echo '<div class="all-users">';
        foreach ($contact_entries as $contacts):
            ?>
            <div class="contact">
                <h1 class="emri">
                    <?= $contacts["name"] ?>
                </h1>
                <p class="contactform">
                    <?= $contacts["email"] ?>
                </p>
                <p class="contactform">
                    <?= $contacts["message"] ?>
                </p>
                <p class="contactform">
                    <?= $contacts["submission_date"] ?>
                </p>
                <a href="?action=delete_contact&contact_id=<?= $contacts['id'] ?>" class="delete">Delete</a>
            </div>
            <hr class="hr" />
            <?php
        endforeach;
        echo'</div>';
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Product Dashboard</title>
        <link rel="stylesheet" href="style/dashboard.css">
        <style> 
            .modal {
                display: none;
                position: fixed;
                z-index: 1;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgb(0, 0, 0);
                background-color: rgba(0, 0, 0, 0.4);
                padding-top: 60px;
            }

            .modal-content {
                background-color: #fefefe;
                margin: 5% auto;
                padding: 20px;
                border: 1px solid #888;
                width: 60%;
                max-width: 500px; 
                display: flex;          
                flex-direction: column;    
                align-items: stretch;    
            }

            .close {
                color: #aaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }

            .close:hover,
            .close:focus {
                color: black;
                text-decoration: none;
                cursor: pointer;
            }

        
            .modal-content input,
            .modal-content textarea {
                margin: 5px 0;       
                padding: 10px;          
                border: 1px solid #ccc;   
                border-radius: 4px;       
                width: 100%;  
            }

            .modal-content button {
                margin-top: 30px;        
                padding: 10px;            
                border: none;            
                background-color: #007bff; 
                color: white;             
                border-radius: 4px;      
                cursor: pointer;      
            }

            .modal-content button:hover {
                background-color: #0056b3; 
            }
    </style>

    </head>
    <body>
            <h1 class="titulli">My Products</h1>
            <div class="product-container">
                <?php foreach ($products_data as $product): ?>
                    <div class="product-card">
                        <img src="<?= $product['img_url'] ?>" alt="<?= $product['name'] ?>">
                        <h3><?= $product['name'] ?></h3>
                        <p class="price">$<?= number_format($product['price'], 2) ?></p>
                        <div class="rating">
                            <span>★★★★★</span>
                            <span>(<?= $product['reviews'] ?> Reviews)</span>
                        </div>
                        <?php if ($_SESSION['is_admin'] === "true"): ?>
                            <div class="admin-actions">
                            <button onclick="openEditModal(<?= $product['id'] ?>, '<?= addslashes($product['name']) ?>', <?= $product['price'] ?>, <?= $product['reviews'] ?>, '<?= $product['img_url'] ?>')" class="edit-button">Edit</button>
                                <a href="?action=delete_product&product_id=<?= $product['id'] ?>" class="delete-button" style="color: red;">Delete</a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <div id="editProductModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeEditModal()">&times;</span>
                    <h2>Edit Product</h2>

                    
                    <img id="imagePreview" src="" alt="Current Image" style="display: none; max-width: 100%; height: auto; margin-bottom: 10px;">

                    <form method="post" id="editProductForm" action="dashboard.php" enctype="multipart/form-data">
                        <input type="hidden" id="editProductId" name="product_id">
                        <label for="editProductName">Product Name:</label>
                        <input type="text" id="editProductName" name="editProductName" required>
                        <label for="editPrice">Price:</label>
                        <input type="number" id="editPrice" name="editPrice" step="0.01" required>
                        <label for="editReviews">Reviews:</label>
                        <input type="number" id="editReviews" name="editReviews" required>
                        <label for="editImageFile">Image File:</label>
                        <input type="file" id="editImageFile" name="editImageFile" data-path="images/">
                        <input type="submit" name="update_product" value="Update Product">
                    </form>
                </div>
            </div>


            <div class="products">
                <?php if (!empty($user_products)): ?>
                    <?php foreach ($user_products as $product): ?>
                        <div class="imageshop">
                            <img class="imageshop-img" src="./images/<?= $product['image_path'] ?>" alt="<?= $product['product_name'] ?>">
                            <div class="underimg">
                                <p>
                                    <?= $product['product_name'] ?>
                                </p>
                                <p id="cmimi">$<?= $product['price'] ?></p>
                            </div>

                            <div class="butonat">
                                <a href="?action=delete_product&product_id=<?= $product['id'] ?>" class="delete-button"
                                    style="color: red; margin-right: 10px">Delete</a>
                                <button onclick="openModal(
                                            <?= $product['id'] ?>,
                                            '<?= $product['product_name'] ?>',
                                            <?= $product['price'] ?>,
                                            '<?= $product['image_path'] ?>'
                                        )" class="edit-button">Edit</button>
                                <a href="SingleProduct.php?product_id=<?= $product['id'] ?>" class="view-button">View</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p id="hi"> <a href="add_product.php">Add one</a>.</p>
                <?php endif; ?>
            </div>






        <script>
        function openEditModal(productId, productName, price, reviews, image) {
            document.getElementById('editProductId').value = productId;
            document.getElementById('editProductName').value = productName;
            document.getElementById('editPrice').value = price;
            document.getElementById('editReviews').value = reviews;


            
        
            

            document.getElementById('editProductModal').style.display = 'flex';
        }

        function closeEditModal() {
            document.getElementById('editProductModal').style.display = 'none';
        }
        </script>



<?php
        include("footer.php");
?>
</body>
</html>
