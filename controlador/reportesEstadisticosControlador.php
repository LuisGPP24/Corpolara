<?php

$id_modulo = 11;

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

use modelo\reportesEstadisticosModelo;

if (is_file("vista/" . $pagina . "Vista.php")) {

    $objeto = new reportesEstadisticosModelo();

    $solicitudes = $objeto->obtener_solicitudes();
    $monto_aprobado = $objeto->obtener_bolivares_solicitudes();
    $trabajadores = $objeto->obtener_trabadores();

    require_once("vista/" . $pagina . "Vista.php");
    exit;
} else {
    echo "pagina en contruccion vista";
    exit;
}
