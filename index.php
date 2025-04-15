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
    <div>
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
                <div class="main_body">
                    <div class="offers" style="height:150px; width: 100%;">
                    </div>
                    <div class="login_signup" style="display: none;">
                        <div class="login active">
                            <form action="login_signup.php" method="post">
                                <input type="text" value="login" name="login" hidden="true">
                                <input type="text" name="mobileNumber" placeholder="Mobile Number" required>
                                <input type="password" name="password" placeholder="Password" required>
                                <input type="submit" name="login" value="Login">
                                <a href="#" class="switch-form">Don't have an account? Sign Up</a>
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
                    <div class="products_scroll" style="height: 100%; width: 100%; border: 3px solid black;">
                        <div class="Sell"><i class="fas fa-tag" style="margin-right: 8px;"></i>Sell</div>
                    </div>
                </div>
            </div>
        </div>
        <div></div>
    </div>
</body>
<script src="script.js"></script>

</html>