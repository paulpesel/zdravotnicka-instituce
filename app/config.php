<?php
function getDB() {
    static $pdo = null;
    if ($pdo === null) {
        try {
            $pdo = new PDO("mysql:host=127.0.0.1;dbname=ete32e_2425zs_12;charset=utf8mb4", "root", "abc", [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Hlásit chyby
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // Vracet pole místo objektů
            ]);
        } catch (PDOException $e) {
            die(json_encode(["success" => false, "message" => "Database connection failed: " . $e->getMessage()]));
        }
    }
    return $pdo;
}
?>
