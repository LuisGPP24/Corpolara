<?php

$id_modulo = 9;

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

        if ($accion == 'generarReporte'){

            $trabajador = $_POST['trabajador'];
            $solicitante = $_POST['solicitante'];
            $objeto->setTrabajador($trabajador);
            $objeto->setSolicitante($solicitante);
            $objeto->generarReporte();

            exit;           
        }
        exit;
    }

   

    require_once("vista/" . $pagina . "Vista.php");
    exit;
} else {
    echo "pagina en contruccion vista";
    exit;
}
