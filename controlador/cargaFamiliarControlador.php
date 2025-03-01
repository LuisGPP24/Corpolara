<?php

$id_modulo = 3;

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

use modelo\cargaFamiliarModelo;

if (is_file("vista/" . $pagina . "Vista.php")) {

    $objeto = new cargaFamiliarModelo();

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

    $modulo = 3;

    if (isset($_POST['accion'])) {

        $accion = $_POST['accion'];

        if($accion == "registrar"){

            $trabajador = $_POST["trabajador"];
            $movimiento = $_POST["movimiento"];
            $nacionalidad = $_POST["nacionalidad"];
            $cedula = $_POST["cedula"];
            $fecha_nacimiento = $_POST["fecha_nacimiento"];
            $nombre = $_POST["nombre"];
            $parentesco = $_POST["parentesco"];
            $genero = $_POST["genero"];
            $cuenta = $_POST["cuenta"];
            $correo = $_POST["correo"];
            $fecha_ingreso = $_POST["fecha_ingreso"];
            
            $objeto->set_trabajador($trabajador);
            $objeto->set_movimiento($movimiento);
            $objeto->set_nacionalidad($nacionalidad);
            $objeto->set_cedula($cedula);
            $objeto->set_fecha_nacimiento($fecha_nacimiento);
            $objeto->set_nombre($nombre);
            $objeto->set_parentesco($parentesco);
            $objeto->set_genero($genero);
            $objeto->set_cuenta($cuenta);
            $objeto->set_correo($correo);
            $objeto->set_fecha_ingreso($fecha_ingreso);
            
            echo $objeto->registrar_familiar($cedula_bitacora,$modulo);
            exit;
        }

        if($accion == "modificar"){
            
            $trabajador = $_POST["trabajador"];
            $movimiento = $_POST["movimiento"];
            $nacionalidad = $_POST["nacionalidad"];
            $cedula = $_POST["cedula"];
            $fecha_nacimiento = $_POST["fecha_nacimiento"];
            $nombre = $_POST["nombre"];
            $parentesco = $_POST["parentesco"];
            $genero = $_POST["genero"];
            $cuenta = $_POST["cuenta"];
            $correo = $_POST["correo"];
            $fecha_ingreso = $_POST["fecha_ingreso"];
            $id = $_POST['id'];
            
            $objeto->set_trabajador($trabajador);
            $objeto->set_movimiento($movimiento);
            $objeto->set_nacionalidad($nacionalidad);
            $objeto->set_cedula($cedula);
            $objeto->set_fecha_nacimiento($fecha_nacimiento);
            $objeto->set_nombre($nombre);
            $objeto->set_parentesco($parentesco);
            $objeto->set_genero($genero);
            $objeto->set_cuenta($cuenta);
            $objeto->set_correo($correo);
            $objeto->set_fecha_ingreso($fecha_ingreso);
            $objeto->set_id($id);

            echo $objeto->modificar_familiar($cedula_bitacora,$modulo);
            exit;
        }

       if($accion == "eliminar"){
            $id = $_POST['id'];

            $objeto->set_id($id);
            echo $objeto->eliminar_familiar($cedula_bitacora,$modulo);
            exit;
        }
    }

    $consultas = $objeto->listar_familiar();
    $consulta_trabajadores = $objeto->consulta_trabajadores();

    require_once("vista/" . $pagina . "Vista.php");
    exit;
} else {
    echo "pagina en contruccion vista";
    exit;
}
