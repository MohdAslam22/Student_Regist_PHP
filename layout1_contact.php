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
<title>Contact Messages - Table View</title>

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

/* Table Wrapper */
.table-container {
    width: 90%;
    margin: 30px auto;
    background: #ffffff;
    padding: 20px;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    overflow-x: auto;
}

/* Table */
table {
    width: 100%;
    border-collapse: collapse;
    border-radius: 12px;
    overflow: hidden;
}

/* Header */
th {
    background: #4A90E2;
    color: #fff;
    padding: 12px;
    font-size: 16px;
    text-align: left;
}

/* Row Data */
td {
    padding: 12px;
    border-bottom: 1px solid #eee;
    color: #444;
}

/* Hover Effect */
tr:hover {
    background: #f0f7ff;
    transition: 0.25s;
}

/* Responsive */
@media (max-width: 600px) {
    th, td {
        font-size: 14px;
        padding: 8px;
    }
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

<h2>Contact Messages (Table View)</h2>

<div class="table-container">
<table>
<tr>
  <th>ID</th>
  <th>Name</th>
  <th>Email</th>
  <th>Message</th>
  <th>Date</th>
</tr>

<?php while($row = $result->fetch_assoc()): ?>
<tr>
  <td><?= $row['id'] ?></td>
  <td><?= $row['name'] ?></td>
  <td><?= $row['email'] ?></td>
  <td><?= $row['message'] ?></td>
  <td><?= $row['created_at'] ?></td>
</tr>
<?php endwhile; ?>

</table>
</div>
<div class="footer">
    Designed & Developed by <b>Nishu kaur</b><br>
    © <?= date('Y') ?> Student Registration System
</div>
</body>
</html>
