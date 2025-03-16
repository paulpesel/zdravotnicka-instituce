<?php
session_start();
require_once __DIR__ . '/../app/init.php';
require_once __DIR__ . '/../app/models/User.php';

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($email) && !empty($password)) {
        $user = new User();
        if ($user->login($email, $password)) {
            $_SESSION['user_id'] = $user->getUserIdByEmail($email); // Uloží ID do session
            echo json_encode(["success" => true, "message" => "Přihlášení úspěšné."]);
        } else {
            echo json_encode(["success" => false, "message" => "Nesprávné přihlašovací údaje."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Vyplňte všechny údaje."]);
    }
}
?>
