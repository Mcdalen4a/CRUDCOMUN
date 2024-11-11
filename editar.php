<?php
include "modelo/conexion.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $resultado = $conexion->query("SELECT * FROM personas WHERE id = $id");

    if ($resultado->num_rows > 0) {
        $datos = $resultado->fetch_object();
    } else {
        echo "Registro no encontrado.";
        exit();
    }
}

if (isset($_POST['btnActualizar'])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $dni = $_POST['dni'];
    $fecha_nacimiento = $_POST['fecha'];
    $correo = $_POST['correo'];

    $conexion->query("UPDATE personas SET nombres='$nombre', apellidos='$apellido', dni='$dni', fecha_nacimiento='$fecha_nacimiento', correo='$correo' WHERE id=$id");

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Persona</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container p-5">
        <h3 class="text-center">Editar Persona</h3>
        <form method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="<?php echo $datos->nombres; ?>">
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" name="apellido" value="<?php echo $datos->apellidos; ?>">
            </div>
            <div class="mb-3">
                <label for="dni" class="form-label">DNI</label>
                <input type="text" class="form-control" name="dni" value="<?php echo $datos->dni; ?>">
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha de Nacimiento</label>
                <input type="date" class="form-control" name="fecha" value="<?php echo $datos->fecha_nacimiento; ?>">
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo</label>
                <input type="text" class="form-control" name="correo" value="<?php echo $datos->correo; ?>">
            </div>
            <button type="submit" class="btn btn-primary" name="btnActualizar">Actualizar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
