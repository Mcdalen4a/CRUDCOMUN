<?php
include "modelo/conexion.php";


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM personas WHERE id = $id";

    if ($conexion->query($sql) === TRUE) {
       
        header("Location: index.php");
    } else {
        echo "Error al eliminar el registro: " . $conexion->error;
    }
} else {
    echo "No se especificó el ID para eliminar.";
}
?>
