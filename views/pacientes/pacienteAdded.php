<?php require_once("../db/db.php");


$nombre=$_POST['nombre'];
$apellidoPat=$_POST['apellidoPat'];
$apellidoMat=$_POST['apellidoMat'];
$fechaNac=$_POST['fechaNac'];
$correoPac=$_POST['correoPac'];



	$sql="call Pacientes_insert('".$nombre."','".$apellidoPat."','".$apellidoMat."','".$fechaNac."','".$correoPac."')";

	try {
		$mysqli -> query($sql);
		$_SESSION['message'] = 'Paciente registrado ';
    $_SESSION['message_type'] = 'success';
    header("Location: registrarPaciente.php");


} catch (mysqli_sql_exception $th) {
	$_SESSION['message'] = 'Error al registrar al paciente ';
    $_SESSION['message_type'] = 'error';
    header("Location: registrarPaciente.php");


	}
?>
