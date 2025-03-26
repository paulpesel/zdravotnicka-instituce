<?php
require_once __DIR__ . '/../config.php';

class User {
    private $pdo;

    public function __construct() {
        $this->pdo = getDB();
    }

    // Registrace uživatele
    public function register($name, $surname, $email, $password, $phone, $address, $birthdate, $insurance, $nationality) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt = $this->pdo->prepare("INSERT INTO User (Name, Surname, Email, Password, Phone, Address, BirthDate, Insurance, Nationality) 
                                         VALUES (:name, :surname, :email, :password, :phone, :address, :birthdate, :insurance, :nationality)");
            $stmt->execute([
                ':name' => $name,
                ':surname' => $surname,
                ':email' => $email,
                ':password' => $hashedPassword,
                ':phone' => $phone,
                ':address' => $address,
                ':birthdate' => $birthdate,
                ':insurance' => $insurance,
                ':nationality' => $nationality
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // Zkontroluje, zda uživatel s tímto e-mailem existuje
    public function emailExists($email) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM User WHERE Email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetchColumn() > 0;
    }

    // Přihlášení uživatele
    public function login($email, $password) {
        $stmt = $this->pdo->prepare("SELECT UserId, Password FROM User WHERE Email = :email");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['Password'])) {
            return $user['UserId']; // Vrátíme ID uživatele
        }
        return false;
    }
}
?>
