<?php

if (!is_file("modelo/" . $pagina . "Modelo.php")) {
    echo "modelo no existe";
    exit;
}

use modelo\inventarioModelo;

if (is_file("vista/" . $pagina . "Vista.php")) {

    $objeto = new inventarioModelo();

    if (isset($_POST['accion'])) {

        $accion = $_POST['accion'];

        if($accion == "registrar"){

            $codigo = $_POST["codigo"];
            $insumo = $_POST["insumo"];
            $cantidad = $_POST["cantidad"];
            $fecha = $_POST["fecha"];

            $objeto->set_codigo($codigo);
            $objeto->set_insumo($insumo);
            $objeto->set_cantidad($cantidad);
            $objeto->set_fecha($fecha);

            echo $objeto->registrar_insumo();
            exit;
        }

        if($accion == "modificar"){

            $codigo = $_POST["codigo"];
            $insumo = $_POST["insumo"];
            $cantidad = $_POST["cantidad"];
            $fecha = $_POST["fecha"];
            $id = $_POST["id"];

            $objeto->set_codigo($codigo);
            $objeto->set_insumo($insumo);
            $objeto->set_cantidad($cantidad);
            $objeto->set_fecha($fecha);
            $objeto->set_id($id);

            echo $objeto->modificar_insumo();
            exit;
        }

        if($accion == "eliminar"){
            $id = $_POST['id'];

            $objeto->set_id($id);
            echo $objeto->eliminar_insumo();
            exit;
        }
    }

    $consultas = $objeto->listar_insumos();

    require_once("vista/" . $pagina . "Vista.php");
    exit;
} else {
    echo "pagina en contruccion vista";
    exit;
}
