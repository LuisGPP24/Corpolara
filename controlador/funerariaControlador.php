<?php

if (!is_file("modelo/" . $pagina . "Modelo.php")) {
    echo "modelo no existe";
    exit;
}

use modelo\FunerariaModelo;

if (is_file("vista/" . $pagina . "Vista.php")) {

    $objeto = new FunerariaModelo();

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

    $modulo = 8;

    if (isset($_POST['accion'])) {

        $accion = $_POST['accion'];

        if($accion == "registrar"){
          
            $id = $_POST["id"];
            $codigo_registro = $_POST["codigo_registro"];
            $ente = $_POST["ente"];
            $defuncion_paciente = $_POST["defuncion_paciente"];

            $objeto->set_id($id);
            $objeto->set_codigo_registro($codigo_registro);
            $objeto->set_ente($ente);
            $objeto->set_defuncion_paciente($defuncion_paciente);
            
            echo $objeto->registrar_funeraria($cedula_bitacora,$modulo);
            exit;
        }

        if($accion == "modificar"){
            
            $id = $_POST["id"];
            $codigo_registro = $_POST["codigo_registro"];
            $ente = $_POST["ente"];
            $defuncion_paciente = $_POST["defuncion_paciente"];

            $objeto->set_id($id);
            $objeto->set_codigo_registro($codigo_registro);
            $objeto->set_ente($ente);
            $objeto->set_defuncion_paciente($defuncion_paciente);
            
            echo $objeto->modificar_funeraria($cedula_bitacora,$modulo);
            exit;
        }

       if($accion == "eliminar"){
            $id = $_POST['id'];

            $objeto->set_id($id);
            echo $objeto->eliminar_registro($cedula_bitacora,$modulo);
            exit;
        }
    }

    $consultas = $objeto->listar_solicitudes();
    $consulta_solicitudes = $objeto->consulta_solicitudes();

    require_once("vista/" . $pagina . "Vista.php");
    exit;
} else {
    echo "pagina en contruccion vista";
    exit;
}
