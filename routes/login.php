<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

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

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = trim($_POST['password'] ?? '');

if (empty($email) || empty($password)) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Vyplňte všechny údaje."]);
    exit();
}

$user = new User();
$userId = $user->login($email, $password);

if ($userId) {
    $_SESSION['user_id'] = $userId;
    http_response_code(200);
    echo json_encode(["success" => true, "message" => "Přihlášení úspěšné.", "user_id" => $userId]);
} else {
    http_response_code(401);
    echo json_encode(["success" => false, "message" => "Nesprávné přihlašovací údaje."]);
}
exit();
