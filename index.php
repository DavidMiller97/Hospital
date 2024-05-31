<?php require_once 'views/db/db.php'; ?>
<?php require_once 'helpers/helpers.php';?>
<?php require_once 'views/layout/header.php'; ?>

<?php 
    if(!isLogin()){
        header("Location: http://localhost/hospital/views/login/login.php");
    }

    $query = "SELECT * FROM consulta INNER JOIN paciente ON(consulta.idPaciente = paciente.idPaciente)  WHERE idMedico = " . $_SESSION['usuario']['id'];

    $result = $mysqli->query($query);
    $consultas = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<div class="container w-100 h-100 mt-auto mb-auto">
    <?php if(count($consultas) > 0): ?>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre del paciente</th>
            <th scope="col">Padecimiento</th>
            <th scope="col">Fecha</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($consultas as $consulta): ?>
            <tr>
              <td><?=$consulta['idConsulta']?></td>
              <td><?=$consulta['nombre']?></td>
              <td><?=$consulta['padecimiento']?></td>
              <td><?=$consulta['fecha']?></td>
            </tr>
          <?php endforeach;?>
        </tbody>
      </table>
    <?php else: ?>
      <h2>No has hecho consultas aún</h2>
    <?php endif; ?>

    <div class="container mt-5">
        <a href="views/consultas/consultas.php" class="btn btn-primary">Nueva Consulta</a>
    </div>
</div>


<?php require_once 'views/layout/footer.php'; ?>


