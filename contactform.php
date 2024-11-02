<?php
include("config.php");

class ContactForm
{
    private $conn; 

    public function __construct($dbConn) {
        $this->conn = $dbConn; 
    }
    
    public function handleFormSubmission()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $name = $_POST["name"];
            $email = $_POST["email"];
            $message = $_POST["message"];

            $this->insertIntoDatabase($name, $email, $message);
        }
    }

    private function insertIntoDatabase($name, $email, $message)
    {
        $sql = "INSERT INTO contactform (name, email, message) VALUES (:name, :email, :message)";
        $stmt = $this->conn->prepare($sql);
        
        if ($stmt === false) {
            echo "Error preparing statement: " . $this->conn->errorInfo()[2];
            return;
        }

    
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':message', $message);

        if ($stmt->execute()) {
            echo '<script>alert("Form submitted successfully!");</script>';
        } else {
            echo "Error submitting form: " . implode(", ", $stmt->errorInfo());
        }

        $stmt->closeCursor();
    }

    public function getAllContacts()
    {
        $sql = "SELECT * FROM contactform";
        $stmt = $this->conn->query($sql);

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return array();
        }
    }

    public function deleteContact($contactId)
    {
        $sql = "DELETE FROM contactform WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        
        
        $stmt->bindParam(':id', $contactId, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header("Location: dashboard.php");
            exit;
        } else {
            echo "Error deleting contact. Please try again later.";
        }

        $stmt->closeCursor();
    }
}
?>
