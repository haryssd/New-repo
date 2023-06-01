<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myfyp";

// Check if form data is submitted
if (isset($_POST['product_name']) && isset($_POST['product_price']) && isset($_POST['product_description']) && isset($_POST['product_image'])) {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO products (product_name, product_price, product_description, product_image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $product_name, $product_price, $product_description, $product_image);

    // Set parameters
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_description = $_POST['product_description'];
    $product_image = $_POST['product_image'];

    // Execute the statement
    if ($stmt->execute()) {
        // Successful insertion
        echo "Product added successfully";
    } else {
        // Error occurred
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    // Form data not submitted
    echo "Form data not submitted";
}
?>
