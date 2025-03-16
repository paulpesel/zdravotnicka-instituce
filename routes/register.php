<?php
require_once __DIR__ . '/../app/init.php';
require_once __DIR__ . '/../app/models/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($email) && !empty($password)) {
        $user = new User();
        if ($user->register($email, $password)) {
            echo json_encode(["success" => true, "message" => "Registrace proběhla úspěšně."]);
        } else {
            echo json_encode(["success" => false, "message" => "Registrace selhala. Možná už e-mail existuje."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Vyplňte všechny údaje."]);
    }
}
?>
