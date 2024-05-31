<?php
// Incluimos el archivo de conexión a la base de datos
require_once "../db/db.php";
require_once("../layout/header.php");
require_once("../../helpers/helpers.php");

if(!isLogin()){
    header("Location: http://localhost/hospital/views/login/login.php");
}

// Consulta SQL para obtener los medicamentos
$sql = "SELECT idMedicamento, nombre, fechaCaducidad, precio, ingredientes, descripcion FROM medicamento";

// Ejecutamos la consulta
$resultado = mysqli_query($mysqli, $sql);

// Verificamos si la consulta tuvo éxito
if (!$resultado) {
    die("Error al obtener los medicamentos: " . mysqli_error($mysqli));
}
?>


    <div class="container mt-5">
        <h1 class="text-center">Consulta de Medicamentos</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Fecha de Caducidad</th>
                    <th>Precio</th>
                    <th>Ingredientes</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Verificamos si hay resultados
                if (mysqli_num_rows($resultado) > 0) {
                    // Iteramos sobre cada fila de resultados
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo "<tr>";
                        echo "<td>" . $fila['idMedicamento'] . "</td>";
                        echo "<td>" . $fila['nombre'] . "</td>";
                        echo "<td>" . $fila['fechaCaducidad'] . "</td>";
                        echo "<td>" . $fila['precio'] . "</td>";
                        echo "<td>" . $fila['ingredientes'] . "</td>";
                        echo "<td>" . $fila['descripcion'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    // Si no hay resultados, mostramos un mensaje
                    echo "<tr><td colspan='6' class='text-center'>No hay medicamentos disponibles</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php require_once '../layout/footer.php';?>
