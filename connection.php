<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud";

// IMPORTANT — XAMPP me port change hua hai. (3307)
$conn = new mysqli($servername, $username, $password, $dbname, 3307);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
