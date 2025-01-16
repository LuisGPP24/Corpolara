<?php

if (!is_file("modelo/" . $pagina . "Modelo.php")) {
    echo "modelo no existe";
    exit;
}

require_once("modelo/" . $pagina . "Modelo.php");

if (is_file("vista/" . $pagina . "Vista.php")) {

    $objeto = new ExpedienteModelo();

    if (isset($_POST['accion'])) {

        $accion = $_POST['accion'];

        if($accion == "registrar"){
            
            $trabajador = $_POST['trabajador'];
            $fecha_registro = $_POST["fecha_registro"];
            $expediente_nombre = $_FILES['expediente']['name'];
            $expediente_tmp = $_FILES['expediente']['tmp_name'];
            
            $ruta = "assets/expedientes/".$expediente_nombre;

            $objeto->set_trabajador($trabajador);
            $objeto->set_fecha_registro($fecha_registro);
            $objeto->set_expediente($expediente);

            move_uploaded_file($expediente_tmp, $ruta);           
            
            
            echo $objeto->registrar_expediente();
            exit;
        }

        /*if($accion == "modificar"){
            
            $id = $_POST["id"];
            $codigo_registro = $_POST["codigo_registro"];
            $ente = $_POST["ente"];
            $descripcion_solicitud = $_POST["descripcion_solicitud"];
            $fecha_nacimiento = $_POST["fecha_nacimiento"];
            $parentesco = $_POST["parentesco"];
            $patologia = $_POST["patologia"];
            $proveedor = $_POST["proveedor"];

            $objeto->set_id($id);
            $objeto->set_codigo_registro($codigo_registro);
            $objeto->set_ente($ente);
            $objeto->set_descripcion_solicitud($descripcion_solicitud);
            $objeto->set_fecha_nacimiento($fecha_nacimiento);
            $objeto->set_parentesco($parentesco);
            $objeto->set_patologia($patologia);
            $objeto->set_proveedor($proveedor);
            
            echo $objeto->modificar_farmacia();
            exit;
        }*/

       /*if($accion == "eliminar"){
            $id = $_POST['id'];

            $objeto->set_id($id);
            echo $objeto->eliminar_registro();
            exit;
        }*/
    }

    //$consultas = $objeto->listar_expediente();
    $consulta_trabajadores = $objeto->consulta_trabajadores();

    require_once("vista/" . $pagina . "Vista.php");
    exit;
} else {
    echo "pagina en contruccion vista";
    exit;
}
