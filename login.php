<?php
include "navbar.php"; // Navbar upar include
session_start();
include "connection.php";

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM signup WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $row['username'];
            header("Location: dashboard.php");
            exit;
        } else {
            echo "<script>alert('Invalid password');</script>";
        }
    } else {
        echo "<script>alert('User not found');</script>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Page</title>
<style>
/* Ensure navbar height is considered */
body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f3f3f3; background:#e6f0ff; }
.main-content { padding: 80px 20px 20px; /* Top padding for navbar */ display: flex; justify-content: center; }

/* Login Form */
.login-container {
    background-color: #fff;
    padding: 25px 30px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    width: 100%;
    max-width: 400px;
}

.login-container h2 {
    margin-bottom: 20px;
    text-align: center;
    color: #333;
}

.login-container label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
}

.login-container input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.login-container button {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    border: none;
    color: #fff;
    font-size: 16px;
    border-radius: 4px;
    cursor: pointer;
    transition: 0.3s;
}

.login-container button:hover { background-color: #0056b3; }

.signup-link { text-align: center; margin-top: 10px; }
.signup-link a { text-decoration: none; color: #007bff; }
.signup-link a:hover { text-decoration: underline; }
.footer {
    width: 100%;
    text-align: center;
    padding: 15px 0;
    font-size: 14px;
    color: #555;
    background: #f0f7ff;
    border-top: 1px solid #ddd;
    position: fixed;
    bottom: 0;
    left: 0;
}
</style>
</head>
<body>

<div class="main-content">
    <div class="login-container">
        <h2>Login</h2>
        <form action="" method="POST">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Enter your username" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>

            <button type="submit" name="login">Login</button>
        </form>
        <div class="signup-link">
            <p>Don't have an account? <a href="signup.php">SignUp here</a>.</p>
        </div>
    </div>
</div>
<div class="footer">
    Designed & Developed by <b>Aslam</b><br>
    © <?= date('Y') ?> Student Registration System
</div>
</body>
</html>
