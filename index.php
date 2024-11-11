<?php
include "modelo/conexion.php";

if (isset($_POST['btnregistrar'])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $dni = $_POST['dni'];
    $fecha_nacimiento = $_POST['fecha'];
    $correo = $_POST['correo'];

    $sql = "INSERT INTO personas (nombres, apellidos, dni, fecha_nacimiento, correo) 
            VALUES ('$nombre', '$apellido', '$dni', '$fecha_nacimiento', '$correo')";

    if ($conexion->query($sql) === TRUE) {
        echo "<script>alert('Registro exitoso');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD en PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        h1 {
            margin-bottom: 30px;
            color: #343a40;
        }

        /* Estilo para el formulario */
        #registroForm {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        /* Fondo semitransparente */
        #overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .container-fluid {
            padding: 20px;
        }

        /* Estilo del botón para abrir el formulario */
        #toggleFormBtn {
            margin-bottom: 20px;
            font-size: 16px;
            background-color: #007bff;
            border: none;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
        }

        /* Estilo del formulario */
        .form-control {
            border-radius: 5px;
            padding: 10px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            padding: 10px 20px;
            border-radius: 5px;
        }

        /* Estilo para la tabla */
        table {
            margin-top: 30px;
        }

        table th, table td {
            padding: 12px;
            text-align: center;
        }

        .table th {
            background-color: #007bff;
            color: white;
        }

        .table tbody tr:nth-child(odd) {
            background-color: #f2f2f2;
        }

        .table tbody tr:hover {
            background-color: #dcdcdc;
        }


        #closeFormBtn {
            margin-top: 10px;
        }

        .col-12 p-4 {
            padding-top: 0;
        }
    </style>
</head>
<body>
    <h1 class="text-center p-3">CRUD</h1>


    <button class="btn btn-primary ms-3" id="toggleFormBtn"><i class="fas fa-plus-circle"></i></button>




    <div id="overlay"></div>


    <div id="registroForm" class="container-fluid row">
        <form class="col-12 p-3" method="POST" action="index.php">
            <h3 class="text-center text-secondary">Registro de personas</h3>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" name="apellido" required>
            </div>
            <div class="mb-3">
                <label for="dni" class="form-label">DNI</label>
                <input type="text" class="form-control" name="dni" required>
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha de nacimiento</label>
                <input type="date" class="form-control" name="fecha" required>
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo</label>
                <input type="email" class="form-control" name="correo" required>
            </div>
            <button type="submit" class="btn btn-primary" name="btnregistrar" value="ok">Registrar</button>
            <button type="button" class="btn btn-secondary" id="closeFormBtn">Cerrar</button>
        </form>
    </div>

    <div class="container-fluid row">
        <div class="col-12 p-4">
            <table class="table">
                <thead class="bg-info">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombres</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">DNI</th>
                        <th scope="col">Fecha de Nacimiento</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "modelo/conexion.php";
                    $sql = $conexion->query("SELECT * FROM personas");
                    while ($datos = $sql->fetch_object()) { ?>
                        <tr>
                            <td><?php echo $datos->id; ?></td>
                            <td><?php echo $datos->nombres; ?></td>
                            <td><?php echo $datos->apellidos; ?></td>
                            <td><?php echo $datos->dni; ?></td>
                            <td><?php echo $datos->fecha_nacimiento; ?></td>
                            <td><?php echo $datos->correo; ?></td>
                            <td>
                                <a href="editar.php?id=<?php echo $datos->id; ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                <a href="eliminar.php?id=<?php echo $datos->id; ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        $('#toggleFormBtn').click(function() {
            $('#registroForm').fadeIn();
            $('#overlay').fadeIn();
        });


        $('#closeFormBtn').click(function() {
            $('#registroForm').fadeOut();
            $('#overlay').fadeOut();
        });


        $('#overlay').click(function() {
            $('#registroForm').fadeOut();
            $('#overlay').fadeOut();
        });
    </script>
</body>
</html>

</html>
