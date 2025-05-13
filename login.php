<?php
session_start();

$users = array(
    "admin" => "GIYDSKASTGHJX",
	"wolciax" => "DJHSJHDE"


); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

if ($username === '1234' && $password === '1234') {
        session_start();
        $_SESSION['loggedin'] = true;
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Nieprawidłowa nazwa użytkownika lub hasło.";
    }
}


