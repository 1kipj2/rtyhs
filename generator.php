<?php
session_start();

function generateRandomString($length = 10) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}

function sanitize_input($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $imie = sanitize_input($_POST['imie']);
    $nazwisko = sanitize_input($_POST['nazwisko']);
    $birthdate = sanitize_input($_POST['birthdate']);
    $pesel = sanitize_input($_POST['pesel']);
    $link_zdjecia = ($_POST['link_zdjecia']);
    $plec = sanitize_input($_POST['plec']);
  
    $username = $_SESSION['username'];
  
    $dowodnowy_template = file_get_contents('templates/dowodnowy.html');
    $dashboard_template = file_get_contents('templates/dashboard.html');
    $index_template = file_get_contents('templates/index.html');
    $more_template = file_get_contents('templates/more.html');
    $documents_template = file_get_contents('templates/documents.html');
    $qr_template = file_get_contents('templates/qr.html');
    $services_template = file_get_contents('templates/services.html');

    $dowodnowy_template = str_ireplace('{IMIE}', $imie, $dowodnowy_template);
    $dowodnowy_template = str_ireplace('{NAZWISKO}', $nazwisko, $dowodnowy_template);
    $dowodnowy_template = str_ireplace('{BIRTHDATE}', $birthdate, $dowodnowy_template);
    $dowodnowy_template = str_ireplace('{PESEL}', $pesel, $dowodnowy_template);
    $dowodnowy_template = str_ireplace('{PŁEĆ}', $plec, $dowodnowy_template);

    $folder_name = "demObywatel_" . $username . "_" . $imie . "_" . generateRandomString();
    mkdir($folder_name);
	  
	$img = 'zdjecie.png';  
	$savePath = $folder_name . DIRECTORY_SEPARATOR . $img;
	
	file_put_contents($savePath, file_get_contents($link_zdjecia)); 
    file_put_contents("$folder_name/index.html", $index_template);
    file_put_contents("$folder_name/dashboard.html", $dashboard_template);
    file_put_contents("$folder_name/dowodnowy.html", $dowodnowy_template);
    file_put_contents("$folder_name/qr.html", $qr_template);
    file_put_contents("$folder_name/more.html", $more_template);
    file_put_contents("$folder_name/services.html", $services_template);
    file_put_contents("$folder_name/documents.html", $documents_template);

    header("Location: $folder_name");
    exit;
}
?>
