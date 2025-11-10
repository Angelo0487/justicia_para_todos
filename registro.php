<?php include("conexion.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Registrar Cliente - Justicia para Todos</title>
<link rel="stylesheet" href="estilos.css">
</head>
<body>
<h2>Registro de Clientes</h2>

<form method="POST" action="">
    <label>RUT:</label>
    <input type="text" name="rut" required placeholder="12345678-9">

    <label>Nombre:</label>
    <input type="text" name="nombre" required>

    <label>Apellido:</label>
    <input type="text" name="apellido" required>

    <label>Dirección:</label>
    <input type="text" name="direccion" required placeholder="País, número, calle, casa/depto, código postal">

    <label>Correo electrónico:</label>
    <input type="email" name="correo" required>

    <label>Teléfono:</label>
    <input type="text" name="telefono" required placeholder="+569XXXXXXXX">

    <label>Número de Caso:</label>
    <input type="number" name="numero_caso" required>

    <label>Descripción del Caso:</label>
    <textarea name="descripcion_caso" required></textarea>

    <label>Fecha de Inicio:</label>
    <input type="date" name="fecha_inicio" required>

    <label>Estado del Caso:</label>
    <select name="estado" required>
        <option value="Activo">Activo</option>
        <option value="En Proceso">En Proceso</option>
        <option value="Cerrado">Cerrado</option>
    </select>

    <label>Descripción de Sentencia (si aplica):</label>
    <textarea name="descripcion_sentencia"></textarea>

    <label>Fecha de Cierre (si aplica):</label>
    <input type="date" name="fecha_cierre">

    <button type="submit" name="guardar">Guardar Cliente</button>
    <a href="listar.php" class="boton">Ver Clientes</a>
</form>

<?php
function validarRUT($rut) {
    return preg_match("/^[0-9]{7,8}-[0-9Kk]{1}$/", $rut);
}
function validarCorreo($correo) {
    return filter_var($correo, FILTER_VALIDATE_EMAIL);
}
function validarTelefono($telefono) {
    return preg_match("/^\+[0-9]{11,15}$/", $telefono);
}

if (isset($_POST['guardar'])) {
    $rut = $_POST['rut'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $direccion = $_POST['direccion'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $numero_caso = $_POST['numero_caso'];
    $descripcion_caso = $_POST['descripcion_caso'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $estado = $_POST['estado'];
    $descripcion_sentencia = $_POST['descripcion_sentencia'];
    $fecha_cierre = !empty($_POST['fecha_cierre']) ? $_POST['fecha_cierre'] : NULL;

    if (!validarRUT($rut)) {
        echo "<p class='error'>RUT inválido.</p>";
    } elseif (!validarCorreo($correo)) {
        echo "<p class='error'>Correo inválido.</p>";
    } elseif (!validarTelefono($telefono)) {
        echo "<p class='error'>Teléfono inválido.</p>";
    } else {
        try {
            $sql = "INSERT INTO clientes 
                    (rut, nombre, apellido, direccion, correo, telefono, numero_caso, descripcion_caso, fecha_inicio, estado, descripcion_sentencia, fecha_cierre)
                    VALUES 
                    (:rut, :nombre, :apellido, :direccion, :correo, :telefono, :numero_caso, :descripcion_caso, :fecha_inicio, :estado, :descripcion_sentencia, :fecha_cierre)";
            
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':rut', $rut);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellido', $apellido);
            $stmt->bindParam(':direccion', $direccion);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':numero_caso', $numero_caso);
            $stmt->bindParam(':descripcion_caso', $descripcion_caso);
            $stmt->bindParam(':fecha_inicio', $fecha_inicio);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':descripcion_sentencia', $descripcion_sentencia);
            $stmt->bindParam(':fecha_cierre', $fecha_cierre);

            $stmt->execute();

            echo "<p class='exito'>Cliente registrado correctamente.</p>";
        } catch (PDOException $e) {
            echo "<p class='error'>Error al guardar: " . $e->getMessage() . "</p>";
        }
    }
}
?>
</body>
</html>
