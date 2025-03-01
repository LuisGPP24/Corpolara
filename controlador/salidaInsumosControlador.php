<?php

if (!is_file("modelo/" . $pagina . "Modelo.php")) {
    echo "modelo no existe";
    exit;
}

use modelo\salidaInsumosModelo;

if (is_file("vista/" . $pagina . "Vista.php")) {

    $objeto = new salidaInsumosModelo();

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

    $modulo = 15;

    if (isset($_POST['accion'])) {

        $accion = $_POST['accion'];

        if ($accion == "cantidad") {


            $insumo = $_POST['insumo'];
            echo $objeto->cantidad_insumo_disponible($insumo);
            exit;
        }

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
            
            echo $objeto->registrar_salida($cedula_bitacora,$modulo);
            exit;
        }

        

       if($accion == "eliminar"){
            $id = $_POST['id'];

            $objeto->set_id($id);
            echo $objeto->eliminar_registro($cedula_bitacora,$modulo);
            exit;
        }
        exit;
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
