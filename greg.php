<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pavan";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$mobile_number = $_POST['mobile_number'];
$password = $_POST['password'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO gregister (mobile_number, password) VALUES (?, ?)");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("ss", $mobile_number, $password);

if ($stmt->execute()) {
    echo "<script>alert('Registration Successful!'); window.location.href='govlogin.html';</script>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
