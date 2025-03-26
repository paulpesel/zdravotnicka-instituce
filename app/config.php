<?php
$database = 'ete32e_2425zs_12';
$username = 'ete32e_2425zs_12';
$password = '144.110+096!32';
$host = 'localhost';

$mysqli = new mysqli($host, $username, $password, $database);

// Kontrola připojení
if ($mysqli->connect_errno) {
    die('Failed to connect to MySQL: ' . $mysqli->connect_error);
}

// Funkce pro získání instance připojení
function getDB() {
    global $mysqli;
    return $mysqli;
}
?>
