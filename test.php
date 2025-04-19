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
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
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
      scroll-behavior: smooth;
      padding-bottom: 8px;
    }
    .products-row::-webkit-scrollbar { display: none; }
    .products-row { -ms-overflow-style: none; scrollbar-width: none; }

    /* Card: bigger, borderless */
    .card {
      min-width: 160px;
      max-width: 160px;
      flex: 0 0 auto;
      border: none;
      border-radius: 8px;
      background: white;
      box-shadow: 0 1px 4px rgba(0,0,0,0.08);
      text-align: center;
    }

    .card-img-top {
      width: 100%;
      height: 120px;
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
