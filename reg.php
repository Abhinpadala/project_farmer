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

$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$aadhar_number = $_POST["aadhar_number"];
$mobile_number = $_POST["mobile_number"];
$password = $_POST["password"];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO register (first_name, last_name, aadhar_number, mobile_number, password) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssds", $first_name, $last_name, $aadhar_number, $mobile_number, $password);

if ($stmt->execute()) {
    echo "<script>alert('Registration Successful!'); window.location.href='loginform1.html';</script>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
