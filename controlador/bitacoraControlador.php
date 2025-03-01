<?php

if (!is_file("modelo/" . $pagina . "Modelo.php")) {
    echo "modelo no existe";
    exit;
}

use modelo\bitacoraModelo;

if (is_file("vista/" . $pagina . "Vista.php")) {

    $objeto = new bitacoraModelo();

    if(empty($_SESSION)){
        session_start();
    }
        
    if(isset($_SESSION['cedula'])){
        $cedula_bitacora = $_SESSION['cedula'];
    }
    else{
        $cedula_bitacora = "";
    }
 
    if(isset($_SESSION['rol'])){
        $rol_usuario = $_SESSION['rol'];
    }else{
        $rol_usuario = "";
    }

    $modulo = 19;

    if (isset($_POST['accion'])) {

        $accion = $_POST['accion'];

        if($accion=='vaciar'){

            echo $objeto->vaciar_bitacora($cedula_bitacora,$modulo);       
            exit;
        }
    }

    $consultas = $objeto->listar_bitacora();

    require_once("vista/" . $pagina . "Vista.php");
    exit;
} else {
    echo "pagina en contruccion vista";
    exit;
}
