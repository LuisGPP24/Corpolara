<?php

$id_modulo = 6;

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

use modelo\FarmaciaModelo;

if (is_file("vista/" . $pagina . "Vista.php")) {

    $objeto = new FarmaciaModelo();

    if(empty($_SESSION)){
        session_start();
    }
        
    if(isset($_SESSION['cedula'])){
        $cedula_bitacora = $_SESSION['cedula'];
    }
    else{
        $cedula_bitacora = "";
    }

    if (isset($_POST['accion'])) {

        $accion = $_POST['accion'];

        if($accion == "registrar"){
          
            $id = $_POST["id"];
            $codigo_registro = $_POST["codigo_registro"];
            $ente = $_POST["ente"];
            $descripcion_solicitud = $_POST["descripcion_solicitud"];
            $fecha_nacimiento = $_POST["fecha_nacimiento"];
            $parentesco = $_POST["parentesco"];
            $patologia = $_POST["patologia"];
            $proveedor = $_POST["proveedor"];

            $objeto->set_id($id);
            $objeto->set_codigo_registro($codigo_registro);
            $objeto->set_ente($ente);
            $objeto->set_descripcion_solicitud($descripcion_solicitud);
            $objeto->set_fecha_nacimiento($fecha_nacimiento);
            $objeto->set_parentesco($parentesco);
            $objeto->set_patologia($patologia);
            $objeto->set_proveedor($proveedor);
            
            echo $objeto->registrar_farmacia($cedula_bitacora,$id_modulo);
            exit;
        }

        if($accion == "modificar"){
            
            $id = $_POST["id"];
            $codigo_registro = $_POST["codigo_registro"];
            $ente = $_POST["ente"];
            $descripcion_solicitud = $_POST["descripcion_solicitud"];
            $fecha_nacimiento = $_POST["fecha_nacimiento"];
            $parentesco = $_POST["parentesco"];
            $patologia = $_POST["patologia"];
            $proveedor = $_POST["proveedor"];

            $objeto->set_id($id);
            $objeto->set_codigo_registro($codigo_registro);
            $objeto->set_ente($ente);
            $objeto->set_descripcion_solicitud($descripcion_solicitud);
            $objeto->set_fecha_nacimiento($fecha_nacimiento);
            $objeto->set_parentesco($parentesco);
            $objeto->set_patologia($patologia);
            $objeto->set_proveedor($proveedor);
            
            echo $objeto->modificar_farmacia($cedula_bitacora,$id_modulo);
            exit;
        }

       if($accion == "eliminar"){
            $id = $_POST['id'];

            $objeto->set_id($id);
            echo $objeto->eliminar_registro($cedula_bitacora,$id_modulo);
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
