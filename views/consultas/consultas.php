<?php require_once("../db/db.php") ?>
<?php require_once '../../helpers/helpers.php'; ?>
<?php require_once '../layout/header.php'; ?>
<?php 
    if(!isLogin()){
        header("Location: http://localhost/hospital/views/login/login.php");
    }
?>

<?php if (isset($_SESSION['message_type'])): ?>
    <?php if ($_SESSION['message_type'] == "success"): ?>
        <div class="alert alert-success alert-dismissible fade show snackbar-dao" role="alert">
            <?= $_SESSION['message'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php clearSession('message_type'); ?>
    <?php elseif ($_SESSION['message_type'] == "error"): ?>
        <div class="alert alert-danger alert-dismissible fade show snackbar-dao" role="alert">
            <?= $_SESSION['message'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

    <?php clearSession('message_type');?>
    <?php endif; ?>
<?php endif; ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <h1>Consulta Médica</h1>
                            <div class="form-group">
                            <p class="card-text">
                            <?php
                            echo date('d-m-Y H:i:s');
                            ?>
                            </p>
                            </div>
                        </div>
                        <h5 class="card-title">Ingrese los datos de la consulta.</h5>
                        <form  name="receta" method="post" action="guardarDatosC.php">
                            <div class="form-group">
                            <label for="nombre">Paciente</label>
                                    <select name="paciente" id="paciente">
                                        <?php
                                            $sql = "select idPaciente as id, concat(nombre,' ',apellidopaterno,' ',apellidomaterno) as nombre from paciente";

                                            $result = mysqli_query($mysqli,$sql);

                                            if ($result->num_rows > 0) {
                                                while($fila = mysqli_fetch_assoc($result)) {
                                                  echo "<option value='" . $fila['id'] . "'>" . $fila['nombre'] . "</option>";
                                                }
                                            } else {
                                                echo "<option value=''>No hay opciones disponibles</option>";
                                            } 
                                            ?>
                                    </select>
                            </div>                            
                            <div class="form-group">
                                <label for="padecimiento">Padecimiento</label>
                                <input type="tel" class="form-control" name=padecimiento id="padecimiento"">
                            </div>
                            <div class="form-group">
                                <label for="indicaciones">Indicaciones</label>
                                <textarea class="form-control" name=indicaciones id="indicaciones" rows="3" placeholder="Ingrese indicaciones médicas"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="comentarios">Comentarios</label>
                                <textarea class="form-control" name=comentarios id="comentarios" rows="3" placeholder="Ingrese comentarios adicionales"></textarea>
                            </div>
                            <div class="form-group">
                            <label for="nombre">Medicamento</label>
                                    <select name="medicamento" id="medicamento">
                                            <?php

                                            $sql = "select idMedicamento as id, nombre as medicamento from medicamento";

                                            $result = mysqli_query($mysqli,$sql);

                                            if ($result->num_rows > 0) {
                                                while($fila = mysqli_fetch_assoc($result)) {
                                                  echo "<option value='" . $fila['id'] . "'>" . $fila['medicamento'] . "</option>";
                                                }
                                            } else {
                                                echo "<option value=''>No hay opciones disponibles</option>";
                                            } 
                                            ?>
                                    </select>
                            </div>            
                            <div class="btn-group" role="group">
                            <button type="submit" class="btn btn-primary">Guardar consulta</button>
                            </div>
                            <div class="btn-group mr-2" role="group">
                              <button onclick="history.back()" class="btn btn-secondary">Volver</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require_once '../layout/footer.php'; ?>
