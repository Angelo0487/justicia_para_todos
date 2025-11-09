<?php
include("conexion.php");
$rut = $_GET['rut'] ?? '';

try {
    $stmt = $conn->prepare("DELETE FROM clientes WHERE rut = :rut");
    $stmt->execute([':rut' => $rut]);
    echo "<script>alert('Cliente eliminado correctamente');window.location='listar.php';</script>";
} catch (PDOException $e) {
    echo "<script>alert('Error al eliminar: {$e->getMessage()}');window.location='listar.php';</script>";
}
?>
