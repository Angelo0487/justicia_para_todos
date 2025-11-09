<?php
// conexión segura usando PDO
$host = '192.168.1.16';
$db   = 'justicia_para_todos';
$user = 'root';
$pass = 'angelo1989';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>