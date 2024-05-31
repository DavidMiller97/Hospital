<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Hospital</title>
</head>
<body class="d-flex flex-column h-100">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="http://localhost/Hospital/index.php">Hospital</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <?php if($_SESSION['usuario']['isAdmin']): ?>
                    <a class="nav-link" href="/Hospital/views/doctores/altas.php">Doctores</a>
                <?php endif; ?>
                <a class="nav-link" href="/Hospital/views/pacientes/registrarPaciente.php">Pacientes</a>
                <a class="nav-link" href="/Hospital/views/consultas/medicamento.php">Medicamentos</a>
            </div>
            </div>
            <span class="navbar-text">
                <?=$_SESSION['usuario']['correo']?>
            </span>
            <span class="navbar-text"><a href="http://localhost/Hospital/views/logout/logout.php">Cerrar sesion</a></span>
            </div>
        </div>
    </nav>
