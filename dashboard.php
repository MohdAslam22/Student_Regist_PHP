<?php
session_start();
include "connection.php";

// User login check
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Fetch all students
$query = "SELECT * FROM studentreg ORDER BY id DESC";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Dashboard</title>
<style>
/* Reset and font */
* { margin: 0; padding: 0; box-sizing: border-box; font-family: "Poppins", sans-serif; }

/* Body and container */
body {   background:#e6f0ff; }

/* Navbar */
.navbar {
    width: 100%;
    background: #2575fc;
    color: white;
    padding: 15px 25px;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1000;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.navbar h1 { font-size: 22px; }
.navbar .user { font-weight: 500; }
.navbar .logout-btn a { color: white; text-decoration: none; font-weight: 500; }

/* Sidebar */
.sidebar {
    width: 220px;
    background: #2c3e50;
    height: 100vh;
    position: fixed;
    top: 60px;
    left: 0;
    padding: 20px;
}

.sidebar ul { list-style: none; }
.sidebar ul li { margin: 20px 0; }
.sidebar ul li a { color: #ecf0f1; text-decoration: none; padding: 10px 15px; display: block; border-radius: 6px; transition: 0.3s; }
.sidebar ul li a:hover { background: #34495e; }

/* Main content */
.main {
    margin-left: 240px;
    padding: 80px 30px 30px 30px;
}

.main h2 {
   text-align: center;
}



/* Table */
table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

th, td {
    padding: 12px 15px;
    text-align: left;
}

th {
    background-color: #2575fc;
    color: white;
}

tr:nth-child(even) { background: #f9f9f9; }
tr:hover { background: #f1f1f1; }

td img { border-radius: 50%; }

/* Action links */
td a {
    color: #2575fc;
    text-decoration: none;
    font-weight: 500;
    margin-right: 8px;
}

td a:hover { text-decoration: underline; }

/* Buttons */
.logout-btn {
    background: #ff4757;
    border: none;
    padding: 8px 15px;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.3s;
}

.logout-btn:hover { background: #e84118; }

@media (max-width: 768px) {
    .sidebar { width: 100%; height: auto; position: relative; top: 0; }
    .main { margin-left: 0; padding: 150px 15px 15px 15px; }
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

<!-- Navbar -->
<div class="navbar">
    <h1>Dashboard</h1>
    <div class="user">
        👋 Welcome, <strong><?= htmlspecialchars($_SESSION['username']); ?></strong>
        <button class="logout-btn"><a href="logout.php">Logout</a></button>
    </div>
</div>

<!-- Sidebar -->
<div class="sidebar">
    <ul>
         <li><a href="index.php">Home</a></li>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="index.php">Student Registration</a></li>
        <li><a href="change_password.php">Change Password</a></li>
        <li><a href="contact.php">Contact</a></li>
    </ul>
</div>

<!-- Main Content -->
<div class="main">
    <h2>Registered Students</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Email</th>
            <th>Roll No</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Action</th>
        </tr>
        <?php $i = 1; while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $i++; ?></td>
            <td><img src="uploads/<?= htmlspecialchars($row['image']); ?>" width="50" height="50" alt="student image"></td>
            <td><?= htmlspecialchars($row['name']); ?></td>
            <td><?= htmlspecialchars($row['email']); ?></td>
            <td><?= htmlspecialchars($row['rollno']); ?></td>
            <td><?= htmlspecialchars($row['age']); ?></td>
            <td><?= htmlspecialchars($row['gender']); ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id']; ?>">Edit</a>
                <a href="delete.php?id=<?= $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
<div class="footer">
    Designed & Developed by <b>Aslam kaur</b><br>
    © <?= date('Y') ?> Student Registration System
</div>
</body>
</html>
