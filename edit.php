<?php
require_once "connection.php";
require_once "helper.php";
include "navbar.php";
require_login();

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) { header('Location: dashboard.php'); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $rollno = trim($_POST['rollno'] ?? '');
    $age = intval($_POST['age'] ?? 0);
    $gender = $_POST['gender'] ?? '';

    // image handling
    $imageName = $_POST['existing_image'] ?? null;
    if (!empty($_FILES['image']['name'])) {
        $imageName = time() . '_' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/uploads/' . $imageName);
    }

    $stmt = $conn->prepare("UPDATE studentreg SET name=?, email=?, rollno=?, age=?, gender=?, image=? WHERE id=?");
    $stmt->bind_param('sssissi', $name, $email, $rollno, $age, $gender, $imageName, $id);
    if ($stmt->execute()) {
        flash('success', 'Student updated');
        header('Location: dashboard.php'); exit;
    } else {
        flash('error', 'DB error: ' . $conn->error);
    }
    $stmt->close();
}

// load existing
$stmt = $conn->prepare("SELECT * FROM studentreg WHERE id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$res = $stmt->get_result();
$show = $res->fetch_assoc();
$stmt->close();

if (!$show) { header('Location: dashboard.php'); exit; }
?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Edit Student</title>

  <style>
  .card_contant {
      font-family: Arial, sans-serif;
     
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 20px 0 20px 0;
    }

    .card {
      background: #eef2f3;
      width: 420px;
      padding: 25px 30px;
      border-radius: 12px;
      box-shadow: 0px 4px 12px rgba(0,0,0,0.15);
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }

    label {
      display: block;
      margin-top: 12px;
      font-weight: bold;
      color: #555;
    }

    input, select {
      width: 100%;
      padding: 12px;
      border-radius: 8px;
      border: 1px solid #ccc;
      margin-top: 5px;
      outline: none;
      transition: 0.2s ease;
    }

    input:focus, select:focus {
      border-color: #4a90e2;
      box-shadow: 0 0 4px rgba(74,144,226,0.5);
    }

    .btn {
      width: 100%;
      padding: 12px;
      background: #4a90e2;
      border: none;
      color: white;
      margin-top: 18px;
      border-radius: 8px;
      cursor: pointer;
      font-size: 16px;
    }

    .btn:hover {
      background: #357ABD;
    }

    .back-link {
      display: block;
      text-align: center;
      margin-top: 12px;
      text-decoration: none;
      color: #4a90e2;
    }

    .back-link:hover {
      text-decoration: underline;
    }

    .img-preview {
      margin-top: 10px;
      border-radius: 8px;
    }

    .error {
      color: red;
      text-align: center;
      margin-bottom: 10px;
      font-weight: bold;
    }

      .footer {
            margin-top:30px; 
            font-size:14px; 
            text-align:center; 
            color:#555;
        }
        body{
          background:#e6f0ff;
        }
  </style>

</head>
<body>

<div class="card_contant">
<div class="card">

  <h2>Edit Student</h2>

  <?php if ($m = flash('error')): ?>
    <p class="error"><?=htmlspecialchars($m)?></p>
  <?php endif; ?>

  <form method="POST" enctype="multipart/form-data">

    <label>Name</label>
    <input name="name" value="<?=htmlspecialchars($show['name'])?>" required>

    <label>Email</label>
    <input name="email" type="email" value="<?=htmlspecialchars($show['email'])?>" required>

    <label>Roll Number</label>
    <input name="rollno" value="<?=htmlspecialchars($show['rollno'])?>" required>

    <label>Age</label>
    <input name="age" type="number" value="<?=htmlspecialchars($show['age'])?>" required>

    <label>Gender</label>
    <select name="gender">
      <option value="Male" <?= $show['gender']=='Male' ? 'selected' : '' ?>>Male</option>
      <option value="Female" <?= $show['gender']=='Female' ? 'selected' : '' ?>>Female</option>
      <option value="Other" <?= $show['gender']=='Other' ? 'selected' : '' ?>>Other</option>
    </select>

    <?php if ($show['image']): ?>
      <img class="img-preview" src="uploads/<?=htmlspecialchars($show['image'])?>" width="100">
    <?php endif; ?>

    <input type="hidden" name="existing_image" value="<?=htmlspecialchars($show['image'])?>">

    <label>Upload New Image</label>
    <input type="file" name="image">

    <button type="submit" class="btn">Update</button>

  </form>

  <a class="back-link" href="dashboard.php">← Back</a>

</div>
</div>
<div class="footer">
    Designed & Developed by <b>Aslam kaur</b><br>
    © <?= date('Y') ?> Student Registration System
</div>
</body>
</html>
