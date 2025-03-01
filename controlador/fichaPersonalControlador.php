<?php

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
