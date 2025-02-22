<?php

if (!is_file("modelo/" . $pagina . "Modelo.php")) {
    echo "modelo no existe";
    exit;
}

use modelo\reportesEstadisticosModelo;

if (is_file("vista/" . $pagina . "Vista.php")) {

    $objeto = new reportesEstadisticosModelo();

    

    

    require_once("vista/" . $pagina . "Vista.php");
    exit;
} else {
    echo "pagina en contruccion vista";
    exit;
}
