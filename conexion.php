<?php
$host = "192.168.1.16";
$dbname = "justicia_para_todos";
$username = "root";
$password = "angelo1989"

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

function limpiar($dato) {
    return htmlspecialchars(trim($dato));
}
?>
