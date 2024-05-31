<?php 
require_once("../db/db.php");
require_once '../layout/header.php';



$paciente = $_POST["paciente"];
$padecimiento = $_POST["padecimiento"];
$fecha = date('Y-m-d');
$indicaciones = $_POST["indicaciones"];
$comentarios = $_POST["comentarios"];
$medicamento = $_POST["medicamento"];
$idMedico = $_SESSION['usuario']['id'];


$insertConsulta = "INSERT INTO consulta (idPaciente, idMedico, fecha, padecimiento) VALUES ($paciente, $idMedico, '$fecha', '$padecimiento')";

if (mysqli_query($mysqli, $insertConsulta)) {
    $idConsulta = mysqli_insert_id($mysqli);
    
    $insertReceta = "INSERT INTO receta (idConsulta, fecha, indicaciones, comentarios) VALUES ($idConsulta, '$fecha', '$indicaciones', '$comentarios')";

    if (mysqli_query($mysqli, $insertReceta)) {
        $idReceta = mysqli_insert_id($mysqli);
        
        $insertDetalle = "INSERT INTO detallesReceta (idReceta, idMedicamento) VALUES ($idReceta, $medicamento)";
        
        if (mysqli_query($mysqli, $insertDetalle)) {
            $mensaje = 'Consulta registrada correctamente!';
        } else {
            $mensaje = 'Error al registrar la consulta ';
        }
    } else {
        $mensaje = 'Error al registrar la consulta ';
    }
} else {
    $mensaje = 'Error al registrar la consulta ';
}

$consultarDatos = "
SELECT 
    CONCAT(paciente.nombre, ' ', paciente.apellidopaterno, ' ', paciente.apellidoMaterno) AS paciente,
    CONCAT(medico.nombre, ' ', medico.apellidoPa, ' ', medico.apellidoMa) AS medico,
    consulta.padecimiento,
    receta.indicaciones,
    receta.comentarios,
    medicamento.nombre AS medicamento
FROM 
    receta
    JOIN consulta ON consulta.idConsulta = receta.idConsulta
    JOIN paciente ON consulta.idPaciente = paciente.idPaciente
    JOIN medico ON consulta.idMedico = medico.idmedico
    JOIN detallesReceta ON receta.idReceta = detallesReceta.idReceta
    JOIN medicamento ON detallesReceta.idMedicamento = medicamento.idMedicamento
    AND consulta.idConsulta = (SELECT MAX(idConsulta) FROM consulta)
";

$result = mysqli_query($mysqli, $consultarDatos);

if (!$result) {
    die("Error en la consulta: " . mysqli_error($mysqli));
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Datos de Consultas Médicas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Datos de la Consulta</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Paciente</th>
                    <th>Médico</th>
                    <th>Padecimiento</th>
                    <th>Indicaciones</th>
                    <th>Comentarios</th>
                    <th>Medicamento</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['paciente'] . "</td>";
                        echo "<td>" . $row['medico'] . "</td>";
                        echo "<td>" . $row['padecimiento'] . "</td>";
                        echo "<td>" . $row['indicaciones'] . "</td>";
                        echo "<td>" . $row['comentarios'] . "</td>";
                        echo "<td>" . $row['medicamento'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>No hay datos disponibles</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="resultadoModal" tabindex="-1" role="dialog" aria-labelledby="resultadoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resultadoModalLabel">Resultado</h5>
                </div>
                <div class="modal-body">
                    <?php echo $mensaje; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#resultadoModal').modal('show');
        });
    </script>
      <div class="container mt-5">
      
    <div class="container mt-5">
        <form action="receta.php" method="post" style="display: inline;">
            <input type="hidden" name="idConsulta" value="<?php echo ($idConsulta);?>">
            <button type="submit" class="btn btn-primary">Imprimir Receta</button>
        </form>
    </div>

</div>
</body>
</html>

<?php require_once '../layout/footer.php';?>