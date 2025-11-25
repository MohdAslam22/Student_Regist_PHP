<?php
// contact.php
?>

<?php
include"navbar.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
    <style>
        body { font-family: Arial, sans-serif; background:#f5f5f5; padding:20px; }
        .card { 
            background:#fff; 
            max-width:600px; 
            margin:auto; 
            padding:20px; 
            border-radius:10px; 
            box-shadow:0 0 10px rgba(0,0,0,0.1); 
        }
        label { display:block; margin-top:10px; font-weight:600; }
        input, textarea { 
            width:100%; 
            padding:10px; 
            margin-top:5px; 
            border:1px solid #ccc; 
            border-radius:5px; 
        }
        button { 
            margin-top:15px; 
            padding:10px 15px; 
            border:none; 
            background:#007bff; 
            color:#fff; 
            border-radius:6px; 
            cursor:pointer; 
        }
        button:hover { background:#0056b3; }
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

<div class="card">
    <h2>Contact Us</h2>

    <form action="contact_process.php" method="post">
        <label>Your Name</label>
        <input type="text" name="name" required>

        <label>Your Email</label>
        <input type="email" name="email" required>

        <label>Your Message</label>
        <textarea name="message" rows="5" required></textarea>

        <button type="submit" name="submit">Send Message</button>
    </form>
</div>

<div class="footer">
    Designed & Developed by <b>Aslam kaur</b><br>
    © <?= date('Y') ?> Student Registration System
</div>

</body>
</html>
