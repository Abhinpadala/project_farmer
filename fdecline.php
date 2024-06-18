<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pavan";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form data is received
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are provided
    if (isset($_POST['name']) && isset($_POST['product']) && isset($_POST['grade']) && isset($_POST['quantity'])) {

        // Prepare SQL statement to insert the declined product details into the fdecline table
        $sql = "INSERT INTO fdecline (name, product, grade, quantity)
                VALUES (?, ?, ?, ?)";
        
        // Prepare and bind parameters
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $name, $product, $grade, $quantity);

        // Set parameters and execute statement
        $name = $_POST['name'];
        $product = $_POST['product'];
        $grade = $_POST['grade'];
        $quantity = $_POST['quantity'];

        if ($stmt->execute()) {
            echo "Product is declined. Details stored successfully in the database.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    } else {
        echo "One or more fields are missing. Please provide all required fields.";
    }
} else {
    echo "Invalid request method. Please use POST method.";
}
?>
