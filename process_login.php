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

// Check if mobile number exists in the database
$sql = "SELECT password FROM gregister WHERE mobile_number = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $mobile_number);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($db_password);
    $stmt->fetch();

    if ($password === $db_password) {
        // Correct password, redirect to gov_products.html
        $login_time = date('Y-m-d H:i:s');
        $login_stmt = $conn->prepare("INSERT INTO glogin (login_id, login_time) VALUES (?, ?)");
        $login_stmt->bind_param("ss", $mobile_number, $login_time);
        $login_stmt->execute();
        $login_stmt->close();

        echo "<script>alert('Login Successful!'); window.location.href='gov_products.html';</script>";
    } else {
        // Incorrect password, redirect to forgot_gov.html
        echo "<script>alert('Incorrect Password'); window.location.href='forgot_gov.html';</script>";
    }
} else {
    // Mobile number does not exist, redirect to govsign.html
    echo "<script>alert('Mobile number does not exist'); window.location.href='govsign.html';</script>";
}

$stmt->close();
$conn->close();
?>
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

// Check if mobile number exists in the database
$sql = "SELECT password FROM gregister WHERE mobile_number = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $mobile_number);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($db_password);
    $stmt->fetch();

    if ($password === $db_password) {
        // Correct password, redirect to gov_products.html
        $login_time = date('Y-m-d H:i:s');
        $login_stmt = $conn->prepare("INSERT INTO glogin (login_id, login_time) VALUES (?, ?)");
        $login_stmt->bind_param("ss", $mobile_number, $login_time);
        $login_stmt->execute();
        $login_stmt->close();

        echo "<script>alert('Login Successful!'); window.location.href='gov_products.html';</script>";
    } else {
        // Incorrect password, redirect to forgot_gov.html
        echo "<script>alert('Incorrect Password'); window.location.href='forgot_gov.html';</script>";
    }
} else {
    // Mobile number does not exist, redirect to govsign.html
    echo "<script>alert('Mobile number does not exist'); window.location.href='govsign.html';</script>";
}

$stmt->close();
$conn->close();
?>
