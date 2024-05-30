<?php require_once 'views/layout/header.php'; ?>

<?php
if (!isset($_POST["paciente"], $_POST["padecimiento"],$_POST["indicaciones"],$_POST["comentarios"],$_POST["medicamento"])) {
   die("Error: Los datos requeridos no están presentes.");
}

$paciente = $_POST["paciente"];
$padecimiento = $_POST["padecimiento"];
$fecha = date('Y-m-d');
$indicaciones = $_POST["indicaciones"];
$comentarios = $_POST["comentarios"];
$medicamento = $_POST["medicamento"];

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'hospital';

$conexion = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);

$insertConsulta = "INSERT INTO consulta (idPaciente,idMedico,fecha,padecimiento) VALUES ('".$paciente."','".$paciente."','".$fecha."','".$padecimiento."')";  

if (mysqli_query($conexion, $insertConsulta)) {

    $idConsulta = mysqli_insert_id($conexion);
    
    $insertReceta = "INSERT INTO receta (idConsulta, fecha, indicaciones, comentarios) VALUES ('$idConsulta', '$fecha', '$indicaciones', '$comentarios')";

    if (mysqli_query($conexion, $insertReceta)) {
        echo "Información registrada exitosamente.";
    } else {
        echo "Error al insertar en la tabla receta: " . mysqli_error($conexion);
    }

}  else {
    echo "Error al insertar en la tabla consulta: " . mysqli_error($conexion);
}

$sql = "SELECT * FROM ";  

// Cierra la conexión
mysqli_close($conexion);



?>

<?php require_once 'views/layout/footer.php'; ?>