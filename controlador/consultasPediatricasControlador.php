<?php

$id_modulo = 14;

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

use modelo\consultasPediatricasModelo;

if (is_file("vista/" . $pagina . "Vista.php")) {

    $objeto = new consultasPediatricasModelo();

    if(empty($_SESSION)){
            session_start();
        }
        
        if(isset($_SESSION['cedula'])){
            $cedula_bitacora = $_SESSION['cedula'];
        }
        else{
            $cedula_bitacora = "";
        }

    if (isset($_POST['accion'])) {

        $accion = $_POST['accion'];

        if($accion == "registrar"){

            $representante = $_POST["representante"];
            $fecha_consulta = $_POST["fecha_consulta"];
            $nombre_paciente = $_POST["nombre_paciente"];
            $cedula_paciente = $_POST["cedula_paciente"];
            $fecha_nacimiento = $_POST["fecha_nacimiento"];
            $genero = $_POST["genero"];
            $telefono = $_POST["telefono"];
            $doctor = $_POST["doctor"];
            $observacion = $_POST["observacion"];
            
            $objeto->set_representante($representante);
            $objeto->set_fecha_consulta($fecha_consulta);
            $objeto->set_nombre_paciente($nombre_paciente);
            $objeto->set_cedula_paciente($cedula_paciente);
            $objeto->set_fecha_nacimiento($fecha_nacimiento);
            $objeto->set_genero_paciente($genero);
            $objeto->set_telefono($telefono);
            $objeto->set_especialidad($doctor);
            $objeto->set_observacion($observacion);
            
            echo $objeto->registrar_morbilidad($cedula_bitacora,$id_modulo);
            exit;
        }

        if($accion == "modificar"){
            
            $representante = $_POST["representante"];
            $fecha_consulta = $_POST["fecha_consulta"];
            $nombre_paciente = $_POST["nombre_paciente"];
            $cedula_paciente = $_POST["cedula_paciente"];
            $fecha_nacimiento = $_POST["fecha_nacimiento"];
            $genero = $_POST["genero"];
            $telefono = $_POST["telefono"];
            $doctor = $_POST["doctor"];
            $observacion = $_POST["observacion"];
            $id = $_POST["id"];
            
            $objeto->set_representante($representante);
            $objeto->set_fecha_consulta($fecha_consulta);
            $objeto->set_nombre_paciente($nombre_paciente);
            $objeto->set_cedula_paciente($cedula_paciente);
            $objeto->set_fecha_nacimiento($fecha_nacimiento);
            $objeto->set_genero_paciente($genero);
            $objeto->set_telefono($telefono);
            $objeto->set_especialidad($doctor);
            $objeto->set_observacion($observacion);
            $objeto->set_id($id);

            echo $objeto->modificar_consulta($cedula_bitacora,$id_modulo);
            exit;
        }

       if($accion == "eliminar"){
            $id = $_POST['id'];

            $objeto->set_id($id);
            echo $objeto->eliminar_consulta($cedula_bitacora,$id_modulo);
            exit;
        }
    }

    $consultas = $objeto->listar_consulta();
    $consulta_trabajadores = $objeto->consulta_trabajadores();

    require_once("vista/" . $pagina . "Vista.php");
    exit;
} else {
    echo "pagina en contruccion vista";
    exit;
}
