<?php

if (!is_file("modelo/" . $pagina . "Modelo.php")) {
    echo "modelo no existe";
    exit;
}

use modelo\permisosModelo;

if (is_file("vista/" . $pagina . "Vista.php")) {

    $objeto = new permisosModelo();

    if (isset($_POST['accion'])) {

        $accion = $_POST['accion'];

        if($accion == "guardar_permisos"){
            $idRol =  $_POST['idRol'];
            $permisos = json_decode($_POST['permisos'],true);

            $objeto->set_id_rol($idRol);
            $objeto->set_permisos($permisos);

            echo $objeto->guardar_permisos();
            exit;
        }
        if($accion == "consulta_accesos"){
            $idRol =  $_POST['id'];

            $objeto->set_id_rol($idRol);
            echo $objeto->consulta_accesos();
            exit;
        }

        if($accion == "registrar"){
          
            $nombre = $_POST["nombre"];
            $descripcion = $_POST["descripcion"];

            $objeto->set_nombre($nombre);
            $objeto->set_descripcion($descripcion);
            
            echo $objeto->registrar_roles();
            exit;
        }

        if($accion == "modificar"){
            
            $id = $_POST["id"];
            $nombre = $_POST["nombre"];
            $descripcion = $_POST["descripcion"];

            $objeto->set_id($id);
            $objeto->set_nombre($nombre);
            $objeto->set_descripcion($descripcion);

            echo $objeto->modificar_rol();
            exit;
        }

       if($accion == "eliminar"){
            $id = $_POST['id'];

            $objeto->set_id($id);
            echo $objeto->eliminar_rol();
            exit;
        }
    }

    $consultas = $objeto->listar_roles();
    $lista_permisos = $objeto->lista_permisos();

    require_once("vista/" . $pagina . "Vista.php");
    exit;
} else {
    echo "pagina en contruccion vista";
    exit;
}
