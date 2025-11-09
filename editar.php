<?php 
include("conexion.php"); 
$rut = $_GET['rut'] ?? '';
$stmt = $conn->prepare("SELECT * FROM clientes WHERE rut = :rut");
$stmt->execute([':rut' => $rut]);
$cliente = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar Cliente</title>
<link rel="stylesheet" href="estilos.css">
</head>
<body>
<h2>Editar Cliente</h2>

<form method="POST" action="">
    <input type="hidden" name="rut" value="<?php echo $cliente['rut']; ?>">
    <label>Nombre:</label>
    <input type="text" name="nombre" value="<?php echo htmlspecialchars($cliente['nombre']); ?>" required>

    <label>Apellido:</label>
    <input type="text" name="apellido" value="<?php echo htmlspecialchars($cliente['apellido']); ?>" required>

    <label>Correo:</label>
    <input type="email" name="correo" value="<?php echo htmlspecialchars($cliente['correo']); ?>" required>

    <label>Teléfono:</label>
    <input type="text" name="telefono" value="<?php echo htmlspecialchars($cliente['telefono']); ?>" required>

    <label>Estado:</label>
    <select name="estado">
        <option <?php if($cliente['estado']=="Activo") echo "selected"; ?>>Activo</option>
        <option <?php if($cliente['estado']=="En Proceso") echo "selected"; ?>>En Proceso</option>
        <option <?php if($cliente['estado']=="Cerrado") echo "selected"; ?>>Cerrado</option>
    </select>

    <label>Descripción Sentencia:</label>
    <textarea name="descripcion_sentencia"><?php echo htmlspecialchars($cliente['descripcion_sentencia']); ?></textarea>

    <label>Fecha Cierre:</label>
    <input type="date" name="fecha_cierre" value="<?php echo $cliente['fecha_cierre']; ?>">

    <button type="submit" name="actualizar">Actualizar</button>
    <a href="listar.php" class="boton">Volver</a>
</form>

<?php
if (isset($_POST['actualizar'])) {
    try {
        $sql = "UPDATE clientes SET 
                nombre=:nombre, apellido=:apellido, correo=:correo, telefono=:telefono, 
                estado=:estado, descripcion_sentencia=:descripcion_sentencia, fecha_cierre=:fecha_cierre 
                WHERE rut=:rut";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':nombre' => limpiar($_POST['nombre']),
            ':apellido' => limpiar($_POST['apellido']),
            ':correo' => limpiar($_POST['correo']),
            ':telefono' => limpiar($_POST['telefono']),
            ':estado' => limpiar($_POST['estado']),
            ':descripcion_sentencia' => limpiar($_POST['descripcion_sentencia']),
            ':fecha_cierre' => limpiar($_POST['fecha_cierre']),
            ':rut' => limpiar($_POST['rut'])
        ]);
        echo "<p class='exito'>Cliente actualizado correctamente.</p>";
    } catch (PDOException $e) {
        echo "<p class='error'>Error: " . $e->getMessage() . "</p>";
    }
}
?>
</body>
</html>
