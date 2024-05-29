<?php include("../db/db.php") ?>
<?php include("../layout/header.php") ?>
<?php
$nombre=$_POST['nombre'];
$apellidoPat=$_POST['apellidoPat'];
$apellidoMat=$_POST['apellidoMat'];
$fechaNac=$_POST['fechaNac'];
$correoPac=$_POST['correoPac'];

echo "Nombre: <b>".$nombre."</b><BR>";
echo "Apellido Paterno: <b>".$apellidoPat."</b><BR>";
echo "apellido Materno: <b>".$apellidoMat."</b><BR>";
echo "Fecha de Nacimiento: <b>".$fechaNac."</b><BR>";
echo "Correo: <b>".$correoPac."</b><BR>";



	$sql="call Pacientes_insert('".$nombre."','".$apellidoPat."','".$apellidoMat."','".$fechaNac."','".$correoPac."')";

	try {
		$mysqli -> query($sql);
		echo "Registro agregado";

} catch (mysqli_sql_exception $th) {
		echo "El correo ya existe";
	}
?>

<?php include("../layout/footer.php") ?>