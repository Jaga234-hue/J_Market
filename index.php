<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>J_Market</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <div class="homeContainer">
        <div class="headerContainer">
            <div class="leftHeader">
                <i class="bi bi-list menu"></i>
            </div>
            <div class="searchBar"><input type="text" placeholder="Search..." class=""></div>
            <div class="rightHeader">
                <i class="bi bi-person-circle profile"></i>
            </div>
        </div>
        <div class="mainContainer">
            <div class="leftMain" style="display: none;">
                <div class="leftMainTop">
                </div>
                <div class="leftMainBottom">
                    <div class="setting"></div>
                    <div class="help"></div>
                </div>
            </div>
            <div class="rightMain">
                <div class="rightMainTop">
                    <div class="neon-scan">
                        <div class="neon-scan-text">J Market</div>
                    </div>
                    <i class="bi bi-bell notification"></i>
                    <i class="bi bi-cart addtocart"></i>
                    <i class="bi bi-box-seam order"> order</i>
                    <!--  <i class="bi bi-cart-plus"></i>  -->

                </div>
                <div class="main_body"> <!-- scroll -->
                    <div class="offers" style="height:150px; width: 100%;">
                    </div>
                    <?php
                    require_once('db_connect.php');
                    session_start();
                    if (!isset($_SESSION["j_market_mobile_number"])) {
                        echo '
                        <div class="login_signup" style="display: none;">
                        <div class="login active">
                            <form action="login_signup.php" method="post">
                                <input type="text" value="login" name="login" hidden="true">
                                <input type="text" name="mobileNumber" placeholder="Mobile Number" required>
                                <input type="password" name="password" placeholder="Password" required>
                                <input type="submit" name="login" value="Login">
                                <a href="#" class="switch-form">Dont have an account? Sign Up</a>
                            </form>
                        </div>
                        <div class="signup">
                            <form action="login_signup.php" method="post">
                                <input type="text" value="signup" name="signup" hidden="true">
                                <input type="text" name="name" placeholder="Name" required>
                                <input type="text" name="mobileNumber" placeholder="Mobile Number" required>
                                <input type="text" name="email" placeholder="Email" required>
                                <input type="password" name="password" placeholder="Password" required>
                                <input type="submit" name="signup" value="Signup">
                                <a href="#" class="switch-form">Already have an account? Login</a>
                            </form>
                        </div>
                        </div>
                        ';
                    } else {
                        $stmt = mysqli_prepare($conn, "SELECT name, email FROM users WHERE mobile_number = ?");
                        mysqli_stmt_bind_param($stmt, "s", $_SESSION["j_market_mobile_number"]);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        if ($row = mysqli_fetch_assoc($result)) {
                            $name = $row["name"];
                            $email = $row["email"];

                            echo '
<div class="profileinfo" style="display:none;">
        <div class="profile-box">
            <div class= "close">X</div> 
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
</div>
                        ';
                        }
                    }
                    ?>
                    <div class="Sell" onclick="window.open('sellform.php', '_blank')" style="cursor: pointer;">
                        <i class="fas fa-tag" style="margin-right: 8px;"></i>Sell
                    </div>
                    <?php include('products.php'); ?>
                </div>
            </div>
        </div>
        <div></div>
    </div>
</body>
<script src="script.js"></script>

</html>