<?php
// Pokaż błędy, jeśli coś pójdzie nie tak
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Jeśli nie jest to żądanie POST, cofamy użytkownika do formularza
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.html');
    exit;
}

// Pobieramy dane z formularza
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Sprawdzamy poprawność (testowe dane: 1234/1234)
if ($username === '1234' && $password === '1234') {
    session_start();
    $_SESSION['loggedin'] = true;
    header('Location: dashboard.php');
    exit;
} else {
    echo 'Nieprawidłowa nazwa użytkownika lub hasło.';
}
