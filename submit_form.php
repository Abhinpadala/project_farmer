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
$name = $_POST['name'];
$mobile_number = $_POST['mobile_number'];
$aadhar_number = $_POST['aadhar_number'];
$survey = $_POST['survey'];
$product = $_POST['product'];
$grade = $_POST['grade'];
$quantity = $_POST['quantity'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO market (name, mobile_number, aadhar_number, survey, product, grade, quantity) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssi", $name, $mobile_number, $aadhar_number, $survey, $product, $grade, $quantity);

$stmt2 = $conn->prepare("INSERT INTO govmarket (name, mobile_number, aadhar_number, survey, product, grade, quantity) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt2->bind_param("ssssssi", $name, $mobile_number, $aadhar_number, $survey, $product, $grade, $quantity);

if ($stmt->execute() && $stmt2->execute()) {
    echo "<script>alert('Submission Successful!'); window.location.href='market.html';</script>";
} else {
    echo "Error: " . $stmt->error . "<br>" . $stmt2->error;
}

$stmt->close();
$stmt2->close();
$conn->close();
?>
