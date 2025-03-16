<?php
require_once __DIR__ . '/../config.php';

class User {
    private $pdo;

    public function __construct() {
        $this->pdo = getDB();
    }

    // Přihlášení uživatele
    public function login($email, $password) {
        $stmt = $this->pdo->prepare("SELECT id, password FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return true;
        }
        return false;
    }

    // Získání ID uživatele podle emailu
    public function getUserIdByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT id FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetchColumn();
    }
}
?>
