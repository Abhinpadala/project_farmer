<?php
header('Content-Type: application/json');

// Include the database connection file
include 'db_connection.php';

// Fetch approved products from the 'fapproved' table
$sql = "SELECT * FROM fapproved";
$result = $conn->query($sql);

$approvedProducts = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $approvedProducts[] = $row;
    }
}

echo json_encode($approvedProducts);

$conn->close();
?>
