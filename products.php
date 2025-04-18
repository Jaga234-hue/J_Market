<?php
include('db_connect.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $paymentType = $_POST['paymentType'];
    $paymentDetails = $_POST['paymentDetails'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $targetDir = "productfiles/";
    // Create folder if it doesn't exist
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    $fileName = basename($_FILES["fileUpload"]["name"]);
    $targetFile = $targetDir . $fileName;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Allowed file types
    $allowedTypes = ["jpg", "jpeg", "png", "pdf", "zip", "doc", "docx"];

    // Validation
    if (!in_array($fileType, $allowedTypes)) {
        echo "❌ File type not allowed.";
        exit;
    }

    if ($_FILES["fileUpload"]["size"] > 10 * 1024 * 1024) { // 10MB limit
        echo "❌ File is too large.";
        exit;
    }

    // Move file
    if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $targetFile)) {
        echo "✅ File '" . htmlspecialchars($fileName) . "' uploaded successfully.";
    } else {
        echo "❌ Error uploading file.";
    }
    echo $title . ' ' . $paymentType . ' ' . $paymentDetails . ' ' . $_SESSION['j_market_mobile_number'];
}

$stmt1 = $conn->prepare('SELECT * FROM users WHERE mobile_number = ?');
$stmt1->bind_param('s', $_SESSION['j_market_mobile_number']);
$stmt1->execute();
$result1 = $stmt1->get_result();
if ($result1->num_rows > 0) {
   //echo id
   $seller_id = $result1->fetch_assoc()['id'];
   
}
$stmt2 = $conn->prepare('INSERT INTO products (seller_id, title,description, payment_type, payment_details, price) VALUES (?, ?, ?, ?, ?, ?)');
$stmt2->bind_param('issssi', $seller_id, $title, $description, $paymentType, $paymentDetails, $price);
$stmt2->execute();


?>