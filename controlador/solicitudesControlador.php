<?php

if (!is_file("modelo/" . $pagina . "Modelo.php")) {
    echo "modelo no existe";
    exit;
}

require_once("modelo/" . $pagina . "Modelo.php");

if (is_file("vista/" . $pagina . "Vista.php")) {

    $objeto = new SolicitudesModelo();

    if (isset($_POST['accion'])) {

        $accion = $_POST['accion'];

        if($accion == "registrar"){
          
            $codigo = $_POST["codigo"];
            $numero_registro = $_POST["numero_registro"];
            $trabajador = $_POST["trabajador"];
            $cedula = $_POST["cedula"];
            $nombre = $_POST["nombre"];
            $telefono = $_POST["telefono"];
            $tipo_solicitud = $_POST["tipo_solicitud"];
            $sub_tipo_solicitud = $_POST["sub_tipo_solicitud"];
            $estado_solicitud = $_POST["estado_solicitud"];
            $descripcion = $_POST["descripcion"];
            $financiado = $_POST["financiado"];
            $remitido = $_POST["remitido"];
            $monto_solicitado = $_POST["monto_solicitado"];
            $monto_aprobado = $_POST["monto_aprobado"];
            $fecha_registro = $_POST["fecha_registro"];
            $condicion = $_POST["condicion"];
            $estatus = $_POST["estatus"];
            $observacion = $_POST["observacion"];

            $objeto->set_codigo($codigo);
            $objeto->set_numero_registro($numero_registro);
            $objeto->set_trabajador($trabajador);
            $objeto->set_cedula($cedula);
            $objeto->set_nombre($nombre);
            $objeto->set_telefono($telefono);
            $objeto->set_tipo_solicitud($tipo_solicitud);
            $objeto->set_sub_tipo_solicitud($sub_tipo_solicitud);
            $objeto->set_estado_solicitud($estado_solicitud);
            $objeto->set_descripcion($descripcion);
            $objeto->set_financiado($financiado);
            $objeto->set_remitido($remitido);
            $objeto->set_monto_solicitado($monto_solicitado);
            $objeto->set_monto_aprobado($monto_aprobado);
            $objeto->set_fecha_registro($fecha_registro);
            $objeto->set_condicion($condicion);
            $objeto->set_estatus($estatus);
            $objeto->set_observacion($observacion);
            
            echo $objeto->registrar_solicitud();
            exit;
        }

        if($accion == "modificar"){
            
            $id = $_POST["id"];
            $codigo = $_POST["codigo"];
            $numero_registro = $_POST["numero_registro"];
            $trabajador = $_POST["trabajador"];
            $cedula = $_POST["cedula"];
            $nombre = $_POST["nombre"];
            $telefono = $_POST["telefono"];
            $tipo_solicitud = $_POST["tipo_solicitud"];
            $sub_tipo_solicitud = $_POST["sub_tipo_solicitud"];
            $estado_solicitud = $_POST["estado_solicitud"];
            $descripcion = $_POST["descripcion"];
            $financiado = $_POST["financiado"];
            $remitido = $_POST["remitido"];
            $monto_solicitado = $_POST["monto_solicitado"];
            $monto_aprobado = $_POST["monto_aprobado"];
            $fecha_registro = $_POST["fecha_registro"];
            $condicion = $_POST["condicion"];
            $estatus = $_POST["estatus"];
            $observacion = $_POST["observacion"];

            $objeto->set_id($id);
            $objeto->set_codigo($codigo);
            $objeto->set_numero_registro($numero_registro);
            $objeto->set_trabajador($trabajador);
            $objeto->set_cedula($cedula);
            $objeto->set_nombre($nombre);
            $objeto->set_telefono($telefono);
            $objeto->set_tipo_solicitud($tipo_solicitud);
            $objeto->set_sub_tipo_solicitud($sub_tipo_solicitud);
            $objeto->set_estado_solicitud($estado_solicitud);
            $objeto->set_descripcion($descripcion);
            $objeto->set_financiado($financiado);
            $objeto->set_remitido($remitido);
            $objeto->set_monto_solicitado($monto_solicitado);
            $objeto->set_monto_aprobado($monto_aprobado);
            $objeto->set_fecha_registro($fecha_registro);
            $objeto->set_condicion($condicion);
            $objeto->set_estatus($estatus);
            $objeto->set_observacion($observacion);
            echo $objeto->modificar_solicitud();
            exit;
        }

       if($accion == "eliminar"){
            $id = $_POST['id'];

            $objeto->set_id($id);
            echo $objeto->eliminar_solicitud();
            exit;
        }
    }

    $consultas = $objeto->listar_solicitudes();
    $consulta_trabajadores = $objeto->consulta_trabajadores();

    require_once("vista/" . $pagina . "Vista.php");
    exit;
} else {
    echo "pagina en contruccion vista";
    exit;
}
