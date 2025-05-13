<?php
session_start();

// Wyświetlanie błędów (do debugowania)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Tablica użytkowników (login => hasło)
$users = array(
    "kazik" => "kazik111",
    "wolciax" => "DJHSJHDE"
);

// Sprawdzenie czy formularz został wysłany
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Sprawdzenie poprawności loginu i hasła
    if (array_key_exists($username, $users) && $users[$username] === $password) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Nieprawidłowy login lub hasło.";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Logowanie</title>
</head>
<body>
    <h2>Logowanie</h2>
    <?php if (!empty($error)) : ?>
        <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <form method="POST" action="index.php">
        <label for="username">Login:</label><br>
        <input type="text" name="username" id="username" required><br><br>

        <label for="password">Hasło:</label><br>
        <input type="password" name="password" id="password" required><br><br>

        <input type="submit" value="Zaloguj">
    </form>
</body>
</html>
