<?php
include "connection.php";
include "navbar.php"; // Navbar upar include
if(isset($_POST['reset'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if($new_password !== $confirm_password){
        echo "<script>alert('Passwords do not match');</script>";
    } else {
        // Check if email exists
        $stmt = $conn->prepare("SELECT * FROM signup WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0){
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            
            // Update password in DB
            $update_stmt = $conn->prepare("UPDATE signup SET password = ? WHERE email = ?");
            $update_stmt->bind_param("ss", $hashed_password, $email);
            if($update_stmt->execute()){
                echo "<script>alert('Password updated successfully!'); window.location='login.php';</script>";
            } else {
                echo "<script>alert('Error updating password');</script>";
            }
        } else {
            echo "<script>alert('Email not registered');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Reset Password</title>
<style>
    Body{
        background:#e6f0ff;
    }
    .container { max-width:400px; margin:100px auto; background:#fff; padding:30px; border-radius:10px; box-shadow:0 0 10px rgba(0,0,0,0.1);}
    input, button { width:100%; padding:10px; margin:10px 0; border-radius:5px; border:1px solid #ccc;}
    button { background:#007BFF; color:#fff; border:none; cursor:pointer;}
    button:hover { background:#0056b3;}
      .footer {
            margin-top:30px; 
            font-size:14px; 
            text-align:center; 
            color:#555;
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
<div class="container">
<h2>Reset Password</h2>
<form method="POST">
    <input type="email" name="email" placeholder="Enter your registered email" required>
    <input type="password" name="new_password" placeholder="Enter New Password" required>
    <input type="password" name="confirm_password" placeholder="Confirm New Password" required>
    <button type="submit" name="reset">Reset Password</button>
</form>
</div>

<div class="footer">
    Designed & Developed by <b>Nishu</b><br>
    © <?= date('Y') ?> Student Registration System
</div>
</body>
</html>
