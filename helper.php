<?php
// helpers.php
session_start();

function flash($key, $message = null) {
    if ($message === null) {
        if (isset($_SESSION['flash'][$key])) {
            $msg = $_SESSION['flash'][$key];
            unset($_SESSION['flash'][$key]);
            return $msg;
        }
        return null;
    } else {
        $_SESSION['flash'][$key] = $message;
    }
}

function require_login() {
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        flash('error', 'Please login first.');
        header('Location: login.php');
        exit;
    }
}
