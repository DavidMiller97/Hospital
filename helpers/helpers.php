<?php

function clearSession($session){
    unset($_SESSION['error']);
}

function init_usuario($usuario){

    if(isset($usuario) && !empty($usuario)){
        $_SESSION['usuario']['id'] = $usuario['idMedico'];
        $_SESSION['usuario']['nombre'] = $usuario['nombre'];
        $_SESSION['usuario']['idMedico'] = $usuario['idMedico'];
        $_SESSION['usuario']['correo'] = $usuario['correo'];
        $_SESSION['usuario']['isAdmin'] = $usuario['admin'] == "1" ? true : false;
    }
}


function isLogin(){

    if(isset($_SESSION['usuario']) && !empty($_SESSION['usuario'])){
        return true;
    }else {
        return false;
    }
}

function logout(){
    session_start();
    $_SESSION['usuario'] = null;
    unset($_SESSION['usuario']);
}
