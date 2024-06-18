<?php
header('Content-Type: application/json');

// Include the database connection file
include 'db_connection.php';

// Get the posted data
$product = json_decode(file_get_contents('php://input'), true);
$product_id = $product['id'];

// Insert the declined product into the 'fdecline' table with a created_at timestamp
$sql = "INSERT INTO fdecline (id, name, mobile_number, aadhar_number, survey, product, grade, quantity, created_at) VALUES ('" . $product['id'] . "', '" . $product['name'] . "', '" . $product['mobile_number'] . "', '" . $product['aadhar_number'] . "', '" . $product['survey'] . "', '" . $product['product'] . "', '" . $product['grade'] . "', '" . $product['quantity'] . "', NOW())";
if ($conn->query($sql) === TRUE) {
    // Delete the product from the 'market' table
    $sql = "DELETE FROM market WHERE id=$product_id";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['message' => 'Product has been declined.']);
    } else {
        echo json_encode(['error' => 'Error deleting record: ' . $conn->error]);
    }
} else {
    echo json_encode(['error' => 'Error inserting record: ' . $conn->error]);
}

$conn->close();
?>
