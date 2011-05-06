<?php

$id_modulo = 13;

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

use modelo\consultasMedicasModelo;

if (is_file("vista/" . $pagina . "Vista.php")) {

    $objeto = new consultasMedicasModelo();

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

            $trabajador = $_POST["trabajador"];
            $fecha_consulta = $_POST["fecha_consulta"];
            $nombre_paciente = $_POST["nombre_paciente"];
            $cedula_paciente = $_POST["cedula_paciente"];
            $parentesco = $_POST["parentesco"];
            $genero = $_POST["genero"];
            $direccion = $_POST["direccion"];
            $gerencia = $_POST["gerencia"];
            $telefono = $_POST["telefono"];
            $motivo = $_POST["motivo"];
            $edad = $_POST["edad"];
            $doctor = $_POST["doctor"];
            
            $objeto->set_trabajador($trabajador);
            $objeto->set_fecha_consulta($fecha_consulta);
            $objeto->set_nombre_paciente($nombre_paciente);
            $objeto->set_cedula_paciente($cedula_paciente);
            $objeto->set_parentesco($parentesco);
            $objeto->set_genero_paciente($genero);
            $objeto->set_edad_paciente($edad);
            $objeto->set_direccion($direccion);
            $objeto->set_gerencia($gerencia);
            $objeto->set_telefono($telefono);
            $objeto->set_motivo_consulta($motivo);
            $objeto->set_doctor($doctor);
            
            echo $objeto->registrar_morbilidad($cedula_bitacora,$id_modulo);
            exit;
        }

        if($accion == "modificar"){
            
            $trabajador = $_POST["trabajador"];
            $fecha_consulta = $_POST["fecha_consulta"];
            $nombre_paciente = $_POST["nombre_paciente"];
            $cedula_paciente = $_POST["cedula_paciente"];
            $parentesco = $_POST["parentesco"];
            $genero = $_POST["genero"];
            $direccion = $_POST["direccion"];
            $gerencia = $_POST["gerencia"];
            $telefono = $_POST["telefono"];
            $motivo = $_POST["motivo"];
            $edad = $_POST["edad"];
            $doctor = $_POST["doctor"];
            $id = $_POST["id"];
            
            $objeto->set_trabajador($trabajador);
            $objeto->set_fecha_consulta($fecha_consulta);
            $objeto->set_nombre_paciente($nombre_paciente);
            $objeto->set_cedula_paciente($cedula_paciente);
            $objeto->set_parentesco($parentesco);
            $objeto->set_genero_paciente($genero);
            $objeto->set_edad_paciente($edad);
            $objeto->set_direccion($direccion);
            $objeto->set_gerencia($gerencia);
            $objeto->set_telefono($telefono);
            $objeto->set_motivo_consulta($motivo);
            $objeto->set_doctor($doctor);
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
