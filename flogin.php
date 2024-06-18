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

$mobile_number = $_POST['mobile_number'];
$password = $_POST['password'];

// Check if mobile number exists
$sql = "SELECT password FROM register WHERE mobile_number = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $mobile_number);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($stored_password);
    $stmt->fetch();

    if ($stored_password === $password) {
        // Correct password, log the login time
        $login_time = date('Y-m-d H:i:s');
        $log_sql = "INSERT INTO flogin (mobile_number, time_of_login) VALUES (?, ?)";
        $log_stmt = $conn->prepare($log_sql);
        $log_stmt->bind_param("ss", $mobile_number, $login_time);
        $log_stmt->execute();
        $log_stmt->close();

        echo "<script>alert('Login Successful! Redirecting to market...'); window.location.href='market.html';</script>";
    } else {
        echo "<script>alert('Incorrect Password. Redirecting to forgot password...'); window.location.href='forgot-password.html';</script>";
    }
} else {
    echo "<script>alert('Mobile number does not exist. Redirecting to register...'); window.location.href='sign.html';</script>";
}

$stmt->close();
$conn->close();
?>
