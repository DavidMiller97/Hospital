<?php 
require_once '../db/db.php';
require_once '../../helpers/helpers.php';

if(isset($_POST)){
    $correo = filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL) ? $_POST['correo'] :  "";
    $contrasena = !empty($_POST['contrasena']) ? $_POST['contrasena'] : "";

    if(empty($contrasena)){
        $_SESSION['error'] = "La contraseña no es valida";
    }else if(empty($correo)){
        $_SESSION['error'] = "El correo no es valido";
    }else{

        $query = "SELECT * FROM medico WHERE correo = '$correo' AND password = '$contrasena';";

        $result = $mysqli->query($query);

        if($result->num_rows > 0){
            $usuario = mysqli_fetch_assoc($result);
            init_usuario($usuario);
        }else{
            $_SESSION['error'] = 'Correo o contraseña incorrectos';
        }

    }

}


header("Location: http://localhost/Hospital/views/login/login.php");
