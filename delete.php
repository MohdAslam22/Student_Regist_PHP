<?php
require_once "connection.php";
require_once "helper.php";
require_login();

$id = intval($_GET['id'] ?? 0);
if ($id > 0) {
    // optionally delete image file
    $stmt = $conn->prepare("SELECT image FROM studentreg WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $res = $stmt->get_result();
    $r = $res->fetch_assoc();
    if ($r && !empty($r['image']) && file_exists(__DIR__ . '/uploads/' . $r['image'])) {
        unlink(__DIR__ . '/uploads/' . $r['image']);
    }
    $stmt->close();

    $stmt = $conn->prepare("DELETE FROM studentreg WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
}

header('Location: dashboard.php'); exit;
