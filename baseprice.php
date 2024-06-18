<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from POST request
    $id = $_POST['id'];
    $name = $_POST['name'];
    $mobile_number = $_POST['mobile_number'];
    $aadhar_number = $_POST['aadhar_number'];
    $survey = $_POST['survey'];
    $product = $_POST['product'];
    $grade = $_POST['grade'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $adjustedPrice = $_POST['adjustedPrice'];
    
    // Ensure all required fields are not empty
    if (!empty($id) && !empty($name) && !empty($mobile_number) && !empty($aadhar_number) && !empty($survey) && !empty($product) && !empty($grade) && !empty($quantity) && !empty($price) && !empty($adjustedPrice)) {

        // Database connection (replace with your own connection parameters)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "pavan";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check database connection
        if ($conn->connect_error) {
            echo json_encode(['success' => false, 'message' => 'Database connection failed']);
            exit();
        }

        // Prepare and bind SQL statement
        $stmt = $conn->prepare("INSERT INTO fapproved (id, name, mobile_number, aadhar_number, survey, product, grade, quantity, base_price, adjusted_price, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $created_at = date('Y-m-d H:i:s'); // Current timestamp
        $stmt->bind_param("sssssssiids", $id, $name, $mobile_number, $aadhar_number, $survey, $product, $grade, $quantity, $price, $adjustedPrice, $created_at);

        // Execute SQL statement
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Price approved and details stored']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to store details']);
        }

        // Close statement and database connection
        $stmt->close();
        $conn->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid input']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
