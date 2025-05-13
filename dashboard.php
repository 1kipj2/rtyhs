<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}

$username = $_SESSION['username'];
$is_admin = ($username === 'admin');
?>
