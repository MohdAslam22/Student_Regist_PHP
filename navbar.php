<?php
// navbar.php
?>
<style>
    .navbar {
        width: 100%;
        background: #007bff;
        padding: 12px 0;
        display: flex;
        justify-content: center;
        box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        position: sticky;
        top: 0;
        z-index: 999;
        border-radius:10px;
    }

    .navbar ul {
        list-style: none;
        display: flex;
        gap: 25px;
        margin: 0;
        padding: 0;
    }

    .navbar ul li {
        display: inline-block;
    }

    .navbar ul li a {
        color: #fff;
        text-decoration: none;
        font-size: 17px;
        padding: 8px 15px;
        font-weight: 600;
        transition: all 0.3s;
        border-radius: 5px;
    }

    .navbar ul li a:hover,
    .active {
        background: #0056b3;
    }
</style>

<div class="navbar">
    <ul>
        <li><a class="<?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>" href="index.php">Home</a></li>

        <li><a class="<?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : '' ?>" href="dashboard.php">Dashboard</a></li>

        <li><a class="<?= basename($_SERVER['PHP_SELF']) == 'signup.php' ? 'active' : '' ?>" href="signup.php">signup</a></li>

        <li><a class="<?= basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : '' ?>" href="contact.php">Contact</a></li>

        <li><a class="<?= basename($_SERVER['PHP_SELF']) == 'layout1_contact.php' ? 'active' : '' ?>" href="layout1_contact.php">Messages (Table)</a></li>

        <li><a class="<?= basename($_SERVER['PHP_SELF']) == 'layout2_contact.php' ? 'active' : '' ?>" href="layout2_contact.php">Messages (Cards)</a></li>
    </ul>
</div>
