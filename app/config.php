<?php
// Nastavení připojení k databázi
$host = "localhost"; // nebo IP serveru
$dbname = "zdravotnicka_instituce";
$username = "root"; // změň podle svého nastavení
$password = ""; // pokud máš heslo, zadej ho sem

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Chyba připojení k databázi: " . $e->getMessage());
}

// Funkce pro bezpečné získání instance PDO
function getDB() {
    global $pdo;
    return $pdo;
}
?>
