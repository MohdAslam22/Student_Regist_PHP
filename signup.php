<nav class="navbar">
    <div class="logo">My Website</div>
    <ul class="nav-links">
         <li><a href="index.php">Home</a></li>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="index.php">Student Registration</a></li>
        <li><a href="change_password.php">Change Password</a></li>
        <li><a href="contact.php">Contact</a></li>
    </ul>
    <div class="user-area">
        👋 Welcome, <strong><?=htmlspecialchars($_SESSION['username'] ?? 'Guest')?></strong>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</nav>

<style>
.navbar {
    position: fixed;  /* Navbar top par fixed */
    top: 0;
    left: 0;
    width: 100%;
    height: 60px; /* Navbar height */
 background: #007bff;
    color: #fff;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 20px;
    z-index: 1000;
}
.user-area{margin-right:20px;}
.nav-links { list-style: none; display: flex; gap: 15px; }
.nav-links li a { color: #fff; text-decoration: none; padding: 6px 12px; border-radius: 5px; transition: 0.3s; }
.nav-links li a:hover { background: #34495e; }
.logout-btn { background: red; padding: 6px 12px; border-radius: 6px; color: #fff; text-decoration: none;  m;}
.logout-btn:hover { background: #0056b3; }
</style>
<?php
session_start();
include "connection.php";

if (isset($_POST['submit'])) {
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    if ($password === $confirmpassword) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO signup (fullname, email, username, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $fullname, $email, $username, $hashed_password);

        if ($stmt->execute()) {
            echo "<script>alert('Account Created Successfully!'); window.location='login.php';</script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Passwords do not match!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sign Up</title>
<style>
/* Body and general */
body {
    font-family: "Poppins", sans-serif;
    /* background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); */
background:#e6f0ff;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    margin: 0;
}

/* Form container */
.signup-form {
    background: #fff;
    padding: 30px 25px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    width: 100%;
    max-width: 400px;
    animation: fadeIn 1s ease;
}

/* Headings */
.signup-form h2 {
    text-align: center;
    margin-bottom: 25px;
    color: #333;
}

/* Labels and Inputs */
.signup-form label {
    display: block;
    margin-bottom: 5px;
    font-weight: 600;
    color: #555;
}

.signup-form input {
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 8px;
    outline: none;
    transition: 0.3s;
}

.signup-form input:focus {
    border-color: #2575fc;
    box-shadow: 0 0 5px rgba(37,117,252,0.3);
}

/* Button */
.signup-form button {
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 8px;
    background: #2575fc;
    color: #fff;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.3s;
}

.signup-form button:hover {
    background: #6a11cb;
}

/* Links */
.signup-form p {
    text-align: center;
    margin-top: 15px;
    font-size: 14px;
}

.signup-form a {
    color: #2575fc;
    text-decoration: none;
    font-weight: 600;
}

.signup-form a:hover {
    text-decoration: underline;
}

/* Animation */
@keyframes fadeIn {
    from {opacity:0; transform: translateY(-20px);}
    to {opacity:1; transform: translateY(0);}
}
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

<form class="signup-form" action="" method="POST">
    <h2>Sign Up</h2>

    <label for="fullname">Full Name</label>
    <input type="text" id="fullname" name="fullname" placeholder="Enter your full name" required>

    <label for="email">Email</label>
    <input type="email" id="email" name="email" placeholder="Enter your email" required>

    <label for="username">Username</label>
    <input type="text" id="username" name="username" placeholder="Choose a username" required>

    <label for="password">Password</label>
    <input type="password" id="password" name="password" placeholder="Enter password" required>

    <label for="confirmpassword">Confirm Password</label>
    <input type="password" id="confirmpassword" name="confirmpassword" placeholder="Confirm password" required>

    <button type="submit" name="submit">Sign Up</button>
    <p>Already have an account? <a href="login.php">Login</a></p>
</form>
<div class="footer">
    Designed & Developed by <b>Nishu kaur</b><br>
    © <?= date('Y') ?> Student Registration System
</div>
</body>
</html>

