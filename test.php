<?php
session_start();
echo $_SESSION['success'];
echo $_SESSION['loginerror'];
echo $_SESSION['j_market_mobile_number'];
echo $_SESSION['error'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile Card - E-commerce</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
    <style>
        .profile-box {
            background: linear-gradient(135deg, #5e60ce, #6930c3, #7400b8);
            padding: 30px 20px;
            border-radius: 25px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            width: 320px;
            color: #fff;
            text-align: center;
        }

        .profile-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 20px;
            border: 3px solid #fff;
        }

        .profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .info-box {
            background: rgba(255, 255, 255, 0.15);
            padding: 10px;
            border-radius: 10px;
            margin: 10px 0;
            font-size: 16px;
        }

        .profile-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-top: 20px;
        }

        .profile-actions .action-box {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 15px;
            padding: 15px 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .profile-actions .action-box:hover {
            transform: scale(1.05);
        }

        .profile-actions i {
            font-size: 22px;
            margin-bottom: 5px;
        }

        .profile-actions span {
            font-size: 14px;
            font-weight: 500;
        }
    </style>
</head>

<body>
    <div class="profile-box">
        <div class="profile-image">
            <img src="https://via.placeholder.com/100" alt="User Photo" />
        </div>

        Hello, <h1>John Doe</h1>
        <div class="info-box">john.doe@example.com</div>

        <div class="profile-actions">
            <div class="action-box">
                <i class="bi bi-geo-alt"></i>
                <span>Address</span>
            </div>
            <div class="action-box">
                <i class="bi bi-bag-check"></i>
                <span>Orders</span>
            </div>
            <div class="action-box">
                <i class="bi bi-pencil-square"></i>
                <span>Edit</span>
            </div>
            <div class="action-box">
                <i class="bi bi-chat-dots"></i>
                <span>Help</span>
            </div>
        </div>
    </div>
</body>

</html>