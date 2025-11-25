<?php
include "navbar.php";
include "connection.php";

// Form submission
if(isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $rollnumber = mysqli_real_escape_string($conn, $_POST['rollnumber']);
    $age = (int)$_POST['age'];
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $created_at = !empty($_POST['created_at']) ? $_POST['created_at'] : date('Y-m-d H:i:s');

    // Image handling
    $image = "";
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "uploads/";
        if(!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true); // folder create if not exists
        }

        $filename = time() . "_" . basename($_FILES['image']['name']);
        $target_file = $target_dir . $filename;

        $check = getimagesize($_FILES['image']['tmp_name']);
        if($check !== false) {
            if(move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $image = $filename;
            } else {
                echo "<script>alert('Upload error: Cannot move file');</script>";
            }
        } else {
            echo "<script>alert('File is not an image');</script>";
        }
    } else {
        echo "<script>alert('Please choose an image');</script>";
    }

    // Insert into database
    if($image != "") {
        $stmt = $conn->prepare("INSERT INTO studentreg (name,email,rollno,age,gender,image,created_at) VALUES (?,?,?,?,?,?,?)");
        $stmt->bind_param("sssisss", $name, $email, $rollnumber, $age, $gender, $image, $created_at);
        if($stmt->execute()) {
            echo "<script>alert('Student registered successfully!'); window.location='dashboard.php';</script>";
        } else {
            echo "<script>alert('Error: ".$stmt->error."');</script>";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Student Form</title>
<style>
/* body & main padding so navbar space is accounted for */


/* Form card styling */

.card {
    background: #fff;
    max-width: 600px;
    margin: 40px auto; /* top & bottom margin */
    padding: 30px 25px; /* more padding inside card */
    border-radius: 10px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.15);
}

/* Card heading */
.card h2 {
    text-align: center;
    margin-bottom: 25px;
}

/* Labels & inputs */
label {
    display: block;
    margin-top: 15px;
    font-weight: 600;
    color: #333;
}

input, select {
    width: 100%;
    padding: 12px;
    margin-top: 6px;
    border: 1px solid #ccc;
    border-radius: 6px;
    outline: none;
    transition: 0.3s;
}

input:focus, select:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0,123,255,0.3);
}

/* Button */
button {
    width: 100%;
    padding: 12px;
    margin-top: 20px;
    border: none;
    border-radius: 6px;
    background: #007bff;
    color: white;
    font-weight: 600;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    background: #0056b3;
}

/* Image preview */
img.preview {
    display: block;
    margin-top: 10px;
    width: 60px;
    height: 60px;
    border-radius: 5px;
    object-fit: cover;
}

/* Footer */
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
body{
    margin:0px;
}
</style>

</head>
<body>

<div class="card">
<h2> Student Registration Form</h2>

<form action="" method="post" enctype="multipart/form-data">

<label>Name</label>
<input type="text" name="name" required>

<label>Email</label>
<input type="email" name="email" required>

<label>Roll Number</label>
<input type="text" name="rollnumber" required>

<label>Age</label>
<input type="number" name="age" required>

<label>Gender</label>
<select name="gender" required>
    <option value="">Select</option>
    <option value="male">Male</option>
    <option value="female">Female</option>
    <option value="other">Other</option>
</select>

<label>Image</label>
<input type="file" name="image" accept="image/*" required>

<label>Created At</label>
<input type="datetime-local" name="created_at">

<button type="submit" name="submit">Submit</button>

</form>
</div>
<div class="footer">
    Designed & Developed by <b>Nishu kaur</b><br>
    © <?= date('Y') ?> Student Registration System
</div>
</body>
</html>
