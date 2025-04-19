<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Borderless Carousel</title>

  <style>
    /* Container */
    .container {
      width: 100%;
      margin: 0 auto;
      padding: 20px;
      overflow: hidden;
    }

    /* Carousel wrapper */
    .carousel-wrap {
      margin-bottom: 2rem;
    }

    /* Scrollable row */
    .products-row {
      display: flex;
      overflow-x: auto;
      gap: 12px;
      padding-bottom: 8px;
    }

    /* Card: bigger, borderless */
    .card {
      min-width: 225px;
      max-width: 225px;
      flex: 0 0 auto;
      border: none;
      border-radius: 8px;
      box-shadow: 0 1px 4px rgba(0,0,0,0.08);
      text-align: center;
    }

    .card-img-top {
      width: 100%;
      height: 80%;
      object-fit: contain;
      padding: 8px;
    }

    .card-body {
      padding: 8px;
    }

    .card-title {
      font-size: 0.875rem;
      margin-bottom: 0.25rem;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .text-muted {
      color: #6c757d;
      font-size: 0.75rem;
    }

    .fw-bold {
      font-weight: 600;
      font-size: 0.875rem;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="carousel-wrap">
      <div class="products-row">
        <?php
          include("db_connect.php");
          $stmt = $conn->prepare("SELECT * FROM products");
          $stmt->execute();
          $result = $stmt->get_result();
          foreach ($result as $row) {
            $price = str_replace('From ', '', $row["price"]);
        ?>
            <div class="card">
              <img src="<?= htmlspecialchars($row['file_path']) ?>"
                   class="card-img-top"
                   alt="<?= htmlspecialchars($row['title']) ?>">
              <div class="card-body">
                <p class="card-title"><?= htmlspecialchars($row['title']) ?></p>
                <p class="text-muted"><?= htmlspecialchars($row['brand'] ?? '') ?></p>
                <p class="fw-bold">£<?= htmlspecialchars($price) ?></p>
              </div>
            </div>
        <?php
          }
        ?>
      </div>
    </div>
  </div>
</body>
</html>
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
$stmt2 = $conn->prepare('INSERT INTO products (seller_id, title,description, payment_type, payment_details, price,file_path) VALUES (?, ?, ?, ?, ?, ?, ?)');
$stmt2->bind_param('issssis', $seller_id, $title, $description, $paymentType, $paymentDetails, $price,$targetFile);
$stmt2->execute();


?>
