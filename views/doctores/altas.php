<?php include("../db/db.php") ?>
<?php include("../layout/header.php") ?>

<?php if (isset($_SESSION['message_type'])) {
  if ($_SESSION['message_type'] == "success") { ?>
 <div class="alert alert-success alert-dismissible fade show snackbar-dao" role="alert">
    <?= $_SESSION['message'] ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
 </div>
<?php session_unset();
  } elseif ($_SESSION['message_type'] == "error") { ?>
<div class="alert alert-danger alert-dismissible fade show snackbar-dao" role="alert">
    <?= $_SESSION['message'] ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<?php session_unset();
  }
}  ?>

<div class="p-5">
    <form action='insert_doctor.php' method="POST">

        <div class="row">
            <div class="col-sm-12 col-lg-6">
                <div class="mb-3 ">
                    <label for="validationDefaultUsername" class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" id="validationDefaultUsername"
                        aria-describedby="emailHelp" required>
                </div>
            </div>
            <div class="col-sm-12 col-lg-6">
                <div class="mb-3 ">
                    <label for="validationDefaultUsername" class="form-label">Apellido Paterno</label>
                    <input type="text" name="ape_pat" class="form-control" id="validationDefaultUsername"
                        aria-describedby="emailHelp" required>
                </div>
            </div>
            <div class="col-sm-12 col-lg-6">
                <div class="mb-3 ">
                    <label for="validationDefaultUsername" class="form-label">Apellido Materno</label>
                    <input type="text" name="ape_mat" class="form-control" id="validationDefaultUsername"
                        aria-describedby="emailHelp" required>
                </div>
            </div>
            <div class="col-sm-12 col-lg-6">
                <div class="mb-3 ">
                    <label for="validationDefaultUsername" class="form-label">Telefono</label>
                    <input type="text" name="telefono" class="form-control" id="validationDefaultUsername"
                        aria-describedby="emailHelp" required>
                </div>
            </div>
            <div class="col-sm-12 col-lg-6">
                <div class="mb-3 ">
                    <label for="validationDefaultUsername" class="form-label">Cedula</label>
                    <input type="text" name="cedula" class="form-control" id="validationDefaultUsername"
                        aria-describedby="emailHelp" required>
                </div>
            </div>
            <div class="col-sm-12 col-lg-6">
                <label for="exampleInputEmail1" class="form-label">Correo</label>
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Username" aria-label="Username"
                        required>
                </div>
            </div>
            <div class="col-sm-12 col-lg-6">
                <div class="mb-3 ">
                    <label for="validationDefaultUsername" class="form-label">Especialidad</label>
                    <input type="text" name="especialidad" class="form-control" id="validationDefaultUsername"
                        aria-describedby="emailHelp" required>
                </div>
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="admin" value="1" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        Admin
                    </label>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>


    </form>
</div>


<?php include("../layout/footer.php") ?>