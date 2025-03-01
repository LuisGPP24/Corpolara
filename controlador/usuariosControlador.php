<?php

$id_modulo = 17;

$index_modulo = array_search($id_modulo, array_column($_SESSION["permisos"], "id_modulos"));

if ($index_modulo !== false) {
    $permiso = $_SESSION["permisos"][$index_modulo];

    if ($permiso["acceso"] == 0) {

        echo "No tienes permisos para acceder a este módulo";
        exit;
    }
}

if (!is_file("modelo/" . $pagina . "Modelo.php")) {
    echo "modelo no existe";
    exit;
}

use modelo\usuariosModelo;

if (is_file("vista/" . $pagina . "Vista.php")) {

    $objeto = new usuariosModelo();

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

    $modulo = 17;

    if (isset($_POST['accion'])) {

        $accion = $_POST['accion'];

        if ($accion == "listar") {
            echo $objeto->listar_usuario();
            exit;
        }

        if($accion == "registrar"){

            $cedula = $_POST["cedula"];
            $nombre = $_POST["nombre"];
            $contrasena = $_POST["contrasena"];
            $contrasena2 = $_POST["contrasena2"];
            $correo = $_POST["correo"];
            $rol = $_POST["rol"];

            $objeto->set_cedula($cedula);
            $objeto->set_nombre($nombre);
            $objeto->set_contrasena($contrasena);
            $objeto->set_contrasena2($contrasena2);
            $objeto->set_correo($correo);
            $objeto->set_rol($rol);

            echo $objeto->registrar_usuario($cedula_bitacora,$modulo);
            exit;
        }

        if($accion == "eliminar"){
            $cedula = $_POST['cedula'];

            $objeto->set_cedula($cedula);
            echo $objeto->eliminar_usuario($cedula_bitacora,$modulo);
            exit;
        }
        if($accion == "modificar"){

            $cedula = $_POST['cedula'];
            $nombre = $_POST['nombre'];
            $correo = $_POST['correo'];
            $rol = $_POST["rol"];
            
            $objeto->set_cedula($cedula);
            $objeto->set_nombre($nombre);
            $objeto->set_correo($correo);            
            $objeto->set_rol($rol);

            echo $objeto->modificar_usuario($cedula_bitacora,$modulo);
            exit;
        }
        if($accion == "cambiar"){
            $cedula = $_POST["cedula"];
            $contrasena = $_POST["contrasena"];
            $contrasena2 = $_POST["contrasena2"];

            $objeto->set_cedula($cedula);
            $objeto->set_contrasena($contrasena);
            $objeto->set_contrasena2($contrasena2);

            echo $objeto->cambiar_contrasena($cedula_bitacora,$modulo);
            exit;
        }
        
    }

    $consulta_roles = $objeto->consulta_roles();

    require_once("vista/" . $pagina . "Vista.php");
    exit;
} else {
    echo "pagina en contruccion vista";
    exit;
}
