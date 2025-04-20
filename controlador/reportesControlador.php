<?php

$id_modulo = 10;

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

use modelo\ReportesModelo;

if (is_file("vista/" . $pagina . "Vista.php")) {

    $objeto = new ReportesModelo();

    if (isset($_POST['accion'])) {

        $accion = $_POST['accion'];

        if ($accion == 'generarReporte') {
            $trabajador = $_POST['trabajador'];
            $solicitante = $_POST['solicitante'];
            $categoria = $_POST['categoria'];
            $id_solicitud = $_POST['id_solicitud'];
            
            $objeto->setTrabajador($trabajador);
            $objeto->setSolicitante($solicitante);
            $objeto->setCategoria($categoria);
            $objeto->setIdSolicitud($id_solicitud);
            $objeto->generarReporte();
            exit;
           
        }

        if($accion == "getSolicitantes"){

            $trabajador = $_POST['trabajador'];
            $categoria = $_POST['categoria'];
            $objeto->setCategoria($categoria);
            $objeto->setTrabajador($trabajador);

            $solicitantes = $objeto->lista_solicitantes();

            echo $solicitantes;
            exit;

        }

        if($accion == "getSolicitudes"){
            $trabajdor = $_POST['trabajador'];
            $solicitante = $_POST['solicitante'];
            $categoria = $_POST['categoria'];
            
            $objeto->setTrabajador($trabajdor);
            $objeto->setSolicitante($solicitante);
            $objeto->setCategoria($categoria);

            echo $objeto->getSolicitudes();
            exit;
        }

        if($accion == "getTrabajadores"){

            $categoria = $_POST['categoria'];
            $objeto->setCategoria($categoria);
            $trabajadores = $objeto->lista_trabajadores();

            echo $trabajadores;
            exit;

        }

        exit;
    }

   $consulta_trabajadores = $objeto->consulta_trabajadores();

    require_once("vista/" . $pagina . "Vista.php");
    exit;
} else {
    echo "pagina en contruccion vista";
    exit;
}
