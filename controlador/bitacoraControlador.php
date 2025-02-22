<?php

if (!is_file("modelo/" . $pagina . "Modelo.php")) {
    echo "modelo no existe";
    exit;
}

use modelo\facturasModelo;

if (is_file("vista/" . $pagina . "Vista.php")) {

    $objeto = new facturasModelo();

    if (isset($_POST['accion'])) {

        $accion = $_POST['accion'];

        if($accion == "registrar"){
          
            $id = $_POST["id"];
            $codigo_registro = $_POST["codigo_registro"];
            $numero_factura = $_POST["numero_factura"];
            $descripcion = $_POST["descripcion"];
            $monto = $_POST["monto"];

            $objeto->set_id($id);
            $objeto->set_codigo_registro($codigo_registro);
            $objeto->set_numero_factura($numero_factura);
            $objeto->set_descripcion($descripcion);
            $objeto->set_monto($monto);
            
            echo $objeto->registrar_factura();
            exit;
        }

        if($accion == "modificar"){
            
            $id = $_POST["id"];
            $codigo_registro = $_POST["codigo_registro"];
            $numero_factura = $_POST["numero_factura"];
            $descripcion = $_POST["descripcion"];
            $monto = $_POST["monto"];

            $objeto->set_id($id);
            $objeto->set_codigo_registro($codigo_registro);
            $objeto->set_numero_factura($numero_factura);
            $objeto->set_descripcion($descripcion);
            $objeto->set_monto($monto);
            
            echo $objeto->modificar_factura();
            exit;
        }

       if($accion == "eliminar"){
        
            $id = $_POST['id'];

            $objeto->set_id($id);
            echo $objeto->eliminar_factura();
            exit;
        }
    }

    $consultas = $objeto->listar_facturas();
    $consulta_solicitudes = $objeto->consulta_solicitudes();

    require_once("vista/" . $pagina . "Vista.php");
    exit;
} else {
    echo "pagina en contruccion vista";
    exit;
}
