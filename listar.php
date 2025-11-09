<?php include("conexion.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Lista de Clientes</title>
<link rel="stylesheet" href="estilos.css">
</head>
<body>
<h2>Listado de Clientes</h2>
<a href="registro.php" class="boton">Registrar nuevo</a>
<table>
<tr>
<th>RUT</th><th>Nombre</th><th>Apellido</th><th>Correo</th><th>Teléfono</th><th>Estado</th><th>Acciones</th>
</tr>

<?php
$result = $conn->query("SELECT * FROM clientes");
while ($row = $result->fetch_assoc()) {
    echo "<tr>
    <td>{$row['rut']}</td>
    <td>{$row['nombre']}</td>
    <td>{$row['apellido']}</td>
    <td>{$row['correo']}</td>
    <td>{$row['telefono']}</td>
    <td>{$row['estado']}</td>
    <td>
        <a href='editar.php?rut={$row['rut']}'>Editar</a> |
        <a href='eliminar.php?rut={$row['rut']}' onclick='return confirm(\"¿Eliminar este cliente?\");'>Eliminar</a>
    </td>
    </tr>";
}
?>
</table>
</body>
</html>
