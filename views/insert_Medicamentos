<?php 
include("../db/db.php");

$nombre = $_POST['nombre'];
$fecha_caducidad = $_POST['fecha_caducidad'];
$precio = $_POST['precio'];
$ingredientes = $_POST['ingredientes'];
$descripcion = $_POST['descripcion'];

$query = "INSERT INTO medicamento (nombre, fechaCaducidad, precio, ingredientes, descripcion) 
          VALUES ('$nombre', '$fecha_caducidad', $precio, '$ingredientes', '$descripcion')";

try {
    $result = $mysqli->query($query);
    if ($result) {
        $_SESSION['message'] = 'Medicamento registrado exitosamente';
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = 'Error al registrar el medicamento';
        $_SESSION['message_type'] = 'error';
    }
} catch (mysqli_sql_exception $th) {
    $_SESSION['message'] = 'Error al registrar el medicamento: ' . $th->getMessage();
    $_SESSION['message_type'] = 'error';
}

header("Location: altas.php");
?>
