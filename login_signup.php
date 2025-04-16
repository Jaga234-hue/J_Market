<?php
// login_signup.php
session_start();
include 'db_connect.php';

// Handle Signup
if (isset($_POST['signup'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobileNumber']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if mobile or email exists
    $check_query = "SELECT * FROM users WHERE mobile_number = '$mobile' OR email = '$email'";
    $result = mysqli_query($conn, $check_query);
    
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['error'] = "Mobile number or email already exists!";
        header("Location: index.php");
        exit();
    }

    // Insert new user
    $insert_query = "INSERT INTO users (name, mobile_number, email, password)
                     VALUES ('$name', '$mobile', '$email', '$password')";
    
    if (mysqli_query($conn, $insert_query)) {
        $_SESSION["j_market_mobile_number"] = $mobile;
        $_SESSION['success'] = "Registration successful! Please login.";
        header("Location: index.php");
    } else {
        $_SESSION['signUperror'] = "Error: " . mysqli_error($conn);
        header("Location: index.php");
    }
}

// Handle Login
else {
    $mobile = mysqli_real_escape_string($conn, $_POST['mobileNumber']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE mobile_number = '$mobile'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        // Verify the password
        if (password_verify($password, $user['password'])) {
           $_SESSION["j_market_mobile_number"] = $user['mobile_number'];
            exit();
        } else {
            $_SESSION['error'] = "Invalid password!";
            exit();
        }
    } else {
        $_SESSION['error'] = "User not found!";

        exit();
    }
}
mysqli_close($conn);
?>