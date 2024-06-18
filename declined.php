<?php
header('Content-Type: application/json');

// Include the database connection file
include 'db_connection.php';

// Fetch declined products from the 'fdecline' table
$sql = "SELECT id, name, mobile_number, aadhar_number, product, grade, survey, quantity FROM fdecline";
$result = $conn->query($sql);

$declinedProducts = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $declinedProducts[] = $row;
    }
}

echo json_encode($declinedProducts);

$conn->close();
?>
