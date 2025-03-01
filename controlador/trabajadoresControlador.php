<?php

$id_modulo = 1;

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

use modelo\trabajadoresModelo;

if (is_file("vista/" . $pagina . "Vista.php")) {

    $objeto = new trabajadoresModelo();

    if(empty($_SESSION)){
            session_start();
        }
        
        if(isset($_SESSION['cedula'])){
            $cedula_bitacora = $_SESSION['cedula'];
        }
        else{
            $cedula_bitacora = "";
        }
 
        if(isset($_SESSION['rol'])){
            $rol_usuario = $_SESSION['rol'];
        }else{
            $rol_usuario = "";
    }

    $modulo = 1;

    if (isset($_POST['accion'])) {

        $accion = $_POST['accion'];

        if($accion == "registrar"){

            $fecha_registro = $_POST["fecha_registro"];
            $personal_contratado = $_POST["personal"];
            $unidad_organizativa = $_POST["unidad_organizativa"];
            $cedula = $_POST["cedula"];
            $nombre = $_POST["nombre"];
            $fecha_nacimiento = $_POST["fecha_nacimiento"];
            $pais = $_POST["pais"];
            $estado = $_POST["estado"];
            $municipio = $_POST["municipio"];
            $telefono = $_POST["telefono"];
            $correo = $_POST["correo"];
            $direccion = $_POST["direccion"];
            $cuenta = $_POST["cuenta"];
            $profesion = $_POST["profesion"];
            $genero = $_POST["genero"];
            $talla_camisa = $_POST["talla_camisa"];
            $talla_calzado = $_POST["talla_calzado"];
            $talla_pantalon = $_POST["talla_pantalon"];
            $tipo_sangre = $_POST["sangre"];
            $vacunas = $_POST["vacuna"];
            $covid = $_POST["covid"];

            $objeto->set_fecha_registro($fecha_registro);
            $objeto->set_personal_contratado($personal_contratado);
            $objeto->set_unidad_organizativa($unidad_organizativa);
            $objeto->set_cedula($cedula);
            $objeto->set_nombre($nombre);
            $objeto->set_fecha_nacimiento($fecha_nacimiento);
            $objeto->set_pais($pais);
            $objeto->set_estado($estado);
            $objeto->set_municipio($municipio);
            $objeto->set_telefono($telefono);
            $objeto->set_correo($correo);
            $objeto->set_direccion($direccion);
            $objeto->set_cuenta($cuenta);
            $objeto->set_profesion($profesion);
            $objeto->set_genero($genero);
            $objeto->set_talla_camisa($talla_camisa);
            $objeto->set_talla_calzado($talla_calzado);
            $objeto->set_talla_pantalon($talla_pantalon);
            $objeto->set_tipo_sangre($tipo_sangre);
            $objeto->set_vacunas($vacunas);
            $objeto->set_covid($covid);

            echo $objeto->registrar_trabajador($cedula_bitacora,$modulo);
            exit;
        }

        if($accion == "modificar"){

            $fecha_registro = $_POST["fecha_registro"];
            $personal_contratado = $_POST["personal"];
            $unidad_organizativa = $_POST["unidad_organizativa"];
            $cedula = $_POST["cedula"];
            $nombre = $_POST["nombre"];
            $fecha_nacimiento = $_POST["fecha_nacimiento"];
            $pais = $_POST["pais"];
            $estado = $_POST["estado"];
            $municipio = $_POST["municipio"];
            $telefono = $_POST["telefono"];
            $correo = $_POST["correo"];
            $direccion = $_POST["direccion"];
            $cuenta = $_POST["cuenta"];
            $profesion = $_POST["profesion"];
            $genero = $_POST["genero"];
            $talla_camisa = $_POST["talla_camisa"];
            $talla_calzado = $_POST["talla_calzado"];
            $talla_pantalon = $_POST["talla_pantalon"];
            $tipo_sangre = $_POST["sangre"];
            $vacunas = $_POST["vacuna"];
            $covid = $_POST["covid"];

            $objeto->set_fecha_registro($fecha_registro);
            $objeto->set_personal_contratado($personal_contratado);
            $objeto->set_unidad_organizativa($unidad_organizativa);
            $objeto->set_cedula($cedula);
            $objeto->set_nombre($nombre);
            $objeto->set_fecha_nacimiento($fecha_nacimiento);
            $objeto->set_pais($pais);
            $objeto->set_estado($estado);
            $objeto->set_municipio($municipio);
            $objeto->set_telefono($telefono);
            $objeto->set_correo($correo);
            $objeto->set_direccion($direccion);
            $objeto->set_cuenta($cuenta);
            $objeto->set_profesion($profesion);
            $objeto->set_genero($genero);
            $objeto->set_talla_camisa($talla_camisa);
            $objeto->set_talla_calzado($talla_calzado);
            $objeto->set_talla_pantalon($talla_pantalon);
            $objeto->set_tipo_sangre($tipo_sangre);
            $objeto->set_vacunas($vacunas);
            $objeto->set_covid($covid);

            echo $objeto->modificar_trabajador($cedula_bitacora,$modulo);
            exit;
        }

        if($accion == "eliminar"){
            $cedula = $_POST['cedula'];

            $objeto->set_cedula($cedula);
            echo $objeto->eliminar_trabajador($cedula_bitacora,$modulo);
            exit;
        }
    }

    $consultas = $objeto->listar_trabajador();

    require_once("vista/" . $pagina . "Vista.php");
    exit;
} else {
    echo "pagina en contruccion vista";
    exit;
}
