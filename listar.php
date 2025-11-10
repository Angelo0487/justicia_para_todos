<?php
include("conexion.php");

$sql = "SELECT * FROM clientes ORDER BY id DESC";
$stmt = $conn->query($sql); // ejecuta la consulta
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC); // ✅ obtiene todos los registros como array asociativo
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Listado de Clientes - Justicia para Todos</title>
<link rel="stylesheet" href="estilos.css">
</head>
<body>
<h2>Listado de Clientes</h2>

<table border="1">
<tr>
    <th>RUT</th>
    <th>Nombre</th>
    <th>Apellido</th>
    <th>Correo</th>
    <th>Teléfono</th>
    <th>Estado</th>
    <th>Fecha Inicio</th>
    <th>Fecha Cierre</th>
</tr>

<?php foreach ($clientes as $fila): ?>
<tr>
    <td><?= htmlspecialchars($fila['rut']) ?></td>
    <td><?= htmlspecialchars($fila['nombre']) ?></td>
    <td><?= htmlspecialchars($fila['apellido']) ?></td>
    <td><?= htmlspecialchars($fila['correo']) ?></td>
    <td><?= htmlspecialchars($fila['telefono']) ?></td>
    <td><?= htmlspecialchars($fila['estado']) ?></td>
    <td><?= htmlspecialchars($fila['fecha_inicio']) ?></td>
    <td><?= htmlspecialchars($fila['fecha_cierre'] ?? '') ?></td>
</tr>
<?php endforeach; ?>
</table>

<a href="registro.php" class="boton">Registrar nuevo cliente</a>
</body>
</html>
