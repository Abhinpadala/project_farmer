<?php
header('Content-Type: application/json');

// Include the database connection file
include 'db_connection.php';

// Fetch products from the 'market' table
$sql = "SELECT * FROM market";
$result = $conn->query($sql);

$products = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

echo json_encode($products);

$conn->close();
?>
