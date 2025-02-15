<?php

if (!is_file("modelo/" . $pagina . "Modelo.php")) {
    echo "modelo no existe";
    exit;
}

use modelo\salidaInsumosModelo;

if (is_file("vista/" . $pagina . "Vista.php")) {

    $objeto = new salidaInsumosModelo();

    if (isset($_POST['accion'])) {

        $accion = $_POST['accion'];

        if($accion == "registrar"){
          
            $id = $_POST["id"];
            $fecha = $_POST["fecha"];
            $insumo = $_POST["insumo"];
            $trabajador = $_POST["trabajador"];
            $cantidad = $_POST["cantidad"];
            $entregado = $_POST["entregado"];

            $objeto->set_id($id);
            $objeto->set_fecha($fecha);
            $objeto->set_insumo($insumo);
            $objeto->set_trabajador($trabajador);
            $objeto->set_cantidad($cantidad);
            $objeto->set_entregado($entregado);
            
            echo $objeto->registrar_salida();
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
            
            echo $objeto->modificar_farmacia();
            exit;
        }

       if($accion == "eliminar"){
            $id = $_POST['id'];

            $objeto->set_id($id);
            echo $objeto->eliminar_registro();
            exit;
        }
    }

    $consultas = $objeto->listar_inventario();
    $consulta_trabajadores = $objeto->consulta_trabajadores();
    $consulta_inventario = $objeto->consulta_inventario();

    require_once("vista/" . $pagina . "Vista.php");
    exit;
} else {
    echo "pagina en contruccion vista";
    exit;
}
