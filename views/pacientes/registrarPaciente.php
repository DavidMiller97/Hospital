<?php require_once("../db/db.php") ?>
<?php require_once("../layout/header.php") ?>
<?php require_once("../../helpers/helpers.php") ?>
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

    <div class="container d-flex justify-content-center align-items-center w-80 h-80 flex-column">
        <h1 class="mb-5">Registrar Paciente</h1>
        <form id="frm_registrarPaciente" name="frm_Registrarpaciente" method="post" action="pacienteAdded.php">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre">
            </div>
            <div class="mb-3">
                <label for="apellidoPat" class="form-label">Apellido Paterno</label>
                <input type="text" class="form-control" id="apellidoPat" name="apellidoPat">
            </div>
            <div class="mb-3">
                <label for="apellidoMat" class="form-label">Apellido Materno</label>
                <input type="text" class="form-control" id="apellidoMat" name="apellidoMat">
            </div>
            <div class="mb-3">
                <label for="fechaNac" class="form-label">Fecha de Nacimiento</label>
                <input type="date" class="form-control" id="fechaNac" name="fechaNac">
            </div>
            <div class="mb-3">
                <label for="correoPac" class="form-label">Correo</label>
                <input type="text" class="form-control" id="correoPac" name="correoPac">
            </div>
    
            <button type="submit" class="btn btn-primary w-50">Registrar</button>
        </form>
    </div>

<?php include("../layout/footer.php") ?>