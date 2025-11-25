<?php
include "connection.php";

$result = $conn->query("SELECT * FROM contact_messages ORDER BY id DESC");
?>

<?php
include"navbar.php";
?>

<!DOCTYPE html>
<html>
<head>
<title>Contact Messages - Card View</title>
<style>
body {
    margin: 0;
    padding: 0;
    font-family: "Poppins", sans-serif;
   
    background:#e6f0ff;
}

/* Page Title */
h2 {
    text-align: center;
    margin-top: 30px;
    color: #333;
    font-size: 28px;
    font-weight: 600;
}

/* Cards Container */
.cards {
    max-width: 900px;
    margin: 30px auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
    padding: 0 10px;
}

/* Individual Card */
.card {
    background: #fff;
    padding: 20px;
    border-radius: 16px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s, box-shadow 0.3s;
}

/* Card Hover Effect */
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

/* Card Content */
.card h3 {
    margin: 0 0 8px 0;
    color: #007bff;
    font-size: 20px;
}

.card p {
    font-size: 15px;
    color: #555;
    margin-bottom: 10px;
}

.card small {
    font-size: 12px;
    color: #888;
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

<h2>Contact Messages (Card View)</h2>

<div class="cards">
<?php while($row = $result->fetch_assoc()): ?>
<div class="card">
    <h3><?= htmlspecialchars($row['name']) ?> (<?= htmlspecialchars($row['email']) ?>)</h3>
    <p><?= nl2br(htmlspecialchars($row['message'])) ?></p>
    <small>Sent on: <?= $row['created_at'] ?></small>
</div>
<?php endwhile; ?>
</div>
<div class="footer">
    Designed & Developed by <b>Aslam</b><br>
    © <?= date('Y') ?> Student Registration System
</div>
</body>
</html>
