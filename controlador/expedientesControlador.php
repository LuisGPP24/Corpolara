<?php

if (!is_file("modelo/" . $pagina . "Modelo.php")) {
    echo "modelo no existe";
    exit;
}

use modelo\ExpedientesModelo;

if (is_file("vista/" . $pagina . "Vista.php")) {

    $objeto = new ExpedientesModelo();

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

    $modulo = 4;

    if (isset($_POST['accion'])) {

        $accion = $_POST['accion'];

        if($accion=='eliminar'){

                $objeto->set_id($_POST['id']);
                echo $objeto->eliminar_registro($cedula_bitacora,$modulo);

            }else{
                
                if (empty($_FILES['expediente']) ) {
                    http_response_code(400);
                    echo "Debe Seleccionar un archivo";
                    exit;
                }
                $objeto->set_id($_POST['id']);
                $objeto->set_trabajador($_POST['trabajador']);
                $objeto->set_fecha_registro($_POST['fecha_registro']);
                $objeto->set_expediente($_FILES['expediente']);
                
                if($accion=='registrar'){

                    echo $objeto->registrar_expediente($cedula_bitacora,$modulo); 
                }      
            }

        exit;
    }

    $consultas = $objeto->listar_expediente();
    $consulta_trabajadores = $objeto->consulta_trabajadores();

    require_once("vista/" . $pagina . "Vista.php");
    exit;
} else {
    echo "pagina en contruccion vista";
    exit;
}
