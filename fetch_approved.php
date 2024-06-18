<?php
header('Content-Type: application/json');

// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pavan";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['error' => 'Connection failed: ' . $conn->connect_error]));
}

// Fetch data from fapproved table
$sql = "SELECT product, grade, quantity, adjustedprice AS fairPrice FROM fapproved where mobile_number="mobile_number" ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    echo json_encode([]);
}

$conn->close();
?>
