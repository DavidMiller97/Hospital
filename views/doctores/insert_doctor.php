<?php 
include("../db/db.php");

$nombre = $_POST['nombre'];
$ape_pat = $_POST['ape_pat'];
$ape_mat = $_POST['ape_mat'];
$telefono = $_POST['telefono'];
$cedula = $_POST['cedula'];
$email = $_POST['email'];
$especialidad = strtolower($_POST['especialidad']);
isset($_POST['admin']) ? $admin = 1 : $admin = 0;

$get_especialidad = "SELECT idEspecialidad FROM especialidad WHERE LOWER(nombre) LIKE '%$especialidad%'";

$result = $mysqli->query($get_especialidad);
if ($result->num_rows == 0) {
  $insert_especialidad = "INSERT INTO especialidad (nombre) VALUES ('$especialidad')";
  $mysqli->query($insert_especialidad);
  $get_especialidad = "SELECT idEspecialidad FROM especialidad WHERE lower(nombre) = '$especialidad'";
  $result = $mysqli->query($get_especialidad);
} 
  while($row = $result->fetch_assoc()) {
  $id_especialidad = $row['idEspecialidad'];
  }

$query = "INSERT INTO medico(nombre, apellidoPa, apellidoMa, telefono, cedula, correo, password, admin, idEspecialidad) VALUES ('$nombre', '$ape_pat', '$ape_mat', '$telefono', '$cedula', '$email','12345',$admin, $id_especialidad);";
try {
    $result = $mysqli -> query($query);
    $_SESSION['message'] = 'Doctor registrado ';
    $_SESSION['message_type'] = 'success';
    header("Location: altas.php");
} catch (mysqli_sql_exception $th) {
    //throw $th;
    $_SESSION['message'] = 'Error al registrar al doctor ';
    $_SESSION['message_type'] = 'error';
    header("Location: altas.php");
}



?>