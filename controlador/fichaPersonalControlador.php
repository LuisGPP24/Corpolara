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

use modelo\FichaPersonalModelo;    

if (is_file("vista/" . $pagina . "Vista.php")) {

    $objeto = new FichaPersonalModelo();

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

        if($accion == "getSolicitantes"){

            $trabajador = $_POST['trabajador'];
            $objeto->setTrabajador($trabajador);

            $solicitantes = $objeto->lista_solicitantes();

            echo $solicitantes;
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
