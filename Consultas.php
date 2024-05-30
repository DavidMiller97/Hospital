<?php require_once 'views/layout/header.php'; ?>


    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <h1>Consulta Médica</h1> <!-- Se centra este h1 -->
                            <div class="form-group">
                            <p class="card-text">
                            <?php
                            // Obtener la fecha del sistema
                            echo date('d-m-Y H:i:s');
                            ?>
                            </p>
                            </div>
                        </div>
                        <h5 class="card-title">Ingrese los datos de la consulta.</h5>
                        <form  name="receta" method="post" action="GuardarDatosC.php">
                            <div class="form-group">
                            <label for="nombre">Paciente</label>
                                    <select name="paciente" id="paciente">
                                            <?php
                                            $dbhost = 'localhost';
                                            $dbuser = 'root';
                                            $dbpass = '';
                                            $dbname = 'hospital';

                                            $conexion = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
                                            $sql = "select idPaciente as id, concat(nombre,' ',apellidopaterno,' ',apellidomaterno) as nombre from paciente";

                                            $result = mysqli_query($conexion,$sql);

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
                                            $dbhost = 'localhost';
                                            $dbuser = 'root';
                                            $dbpass = '';
                                            $dbname = 'hospital';

                                            $conexion = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
                                            $sql = "select idMedicamento as id, nombre as medicamento from medicamento";

                                            $result = mysqli_query($conexion,$sql);

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

<?php require_once 'views/layout/footer.php'; ?>
