<?php
include 'db_connection.php';

$product_id = $_POST['product_id'];

// Redirect to base_price.html with product ID
header("Location: base_price.html?product_id=" . $product_id);
exit();

$conn->close();
?>
