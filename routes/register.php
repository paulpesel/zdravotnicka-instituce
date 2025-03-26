<?php
require_once __DIR__ . '/../app/init.php';
require_once __DIR__ . '/../app/models/User.php';

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["success" => false, "message" => "Pouze POST metoda je podporována."]);
    exit();
}

$name = trim($_POST['name'] ?? '');
$surname = trim($_POST['surname'] ?? '');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = trim($_POST['password'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$address = trim($_POST['address'] ?? '');
$birthdate = trim($_POST['birthdate'] ?? '');
$insurance = trim($_POST['insurance'] ?? '');
$nationality = trim($_POST['nationality'] ?? '');

if (!$email || empty($password) || empty($name) || empty($surname) || empty($phone) || empty($address) || empty($birthdate) || empty($insurance) || empty($nationality)) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Vyplňte všechny údaje."]);
    exit();
}

$user = new User();

// Ověření, zda e-mail existuje
if ($user->emailExists($email)) {
    http_response_code(409);
    echo json_encode(["success" => false, "message" => "Tento e-mail je již registrován."]);
    exit();
}

// Registrace uživatele
if ($user->register($name, $surname, $email, $password, $phone, $address, $birthdate, $insurance, $nationality)) {
    http_response_code(201);
    echo json_encode(["success" => true, "message" => "Registrace proběhla úspěšně."]);
} else {
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "Chyba při registraci, zkuste to znovu."]);
}
exit();
