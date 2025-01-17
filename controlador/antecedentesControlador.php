<?php

if (!is_file("modelo/" . $pagina . "Modelo.php")) {
    echo "modelo no existe";
    exit;
}

use modelo\AntecedentesModelo;

if (is_file("vista/" . $pagina . "Vista.php")) {

    $objeto = new AntecedentesModelo();

    if (isset($_POST['accion'])) {

        $accion = $_POST['accion'];

        if($accion == "registrar"){

            $trabajador = $_POST["trabajador"];
            $antecedentes_cardiovasculares = $_POST["antecedentes_cardiovasculares"];
            $antecedentes_pulmonares = $_POST["antecedentes_pulmonares"];
            $antecedentes_digestivos = $_POST["antecedentes_digestivos"];
            $antecedentes_diabeticos = $_POST["antecedentes_diabeticos"];
            $antecedentes_renales = $_POST["antecedentes_renales"];
            $alergias = $_POST["alergias"];
            $otros = $_POST["otros"];
            $tratamientos = $_POST["tratamientos"];
            $especificaciones_tratamiento = $_POST["especificaciones_tratamiento"];
            $intervenciones = $_POST["intervenciones"];
            $fecha_intervencion = $_POST["fecha_intervencion"];
            $edad_intervencion = $_POST["edad_intervencion"];
            $descripcion_intervencion = $_POST["descripcion_intervencion"];
            $accidentes = $_POST["accidentes"];
            $fecha_accidente = $_POST["fecha_accidente"];
            $edad_accidente = $_POST["edad_accidente"];
            $descripcion_accidente = $_POST["descripcion_accidente"];
            $antecedentes_tabaquismo = $_POST["antecedentes_tabaquismo"];
            $antecedentes_alcoholismo = $_POST["antecedentes_alcoholismo"];

            $objeto->set_trabajador($trabajador);
            $objeto->set_antecedentes_cardiovasculares($antecedentes_cardiovasculares);
            $objeto->set_antecedentes_pulmonares($antecedentes_pulmonares);
            $objeto->set_antecedentes_digestivos($antecedentes_digestivos);
            $objeto->set_antecedentes_diabeticos($antecedentes_diabeticos);
            $objeto->set_antecedentes_renales($antecedentes_renales);
            $objeto->set_alergias($alergias);
            $objeto->set_otros($otros);
            $objeto->set_tratamientos($tratamientos);
            $objeto->set_especificaciones_tratamiento($especificaciones_tratamiento);
            $objeto->set_intervenciones($intervenciones);
            $objeto->set_fecha_intervencion($fecha_intervencion);
            $objeto->set_edad_intervencion($edad_intervencion);
            $objeto->set_descripcion_intervencion($descripcion_intervencion);
            $objeto->set_accidentes($accidentes);
            $objeto->set_fecha_accidente($fecha_accidente);
            $objeto->set_edad_accidente($edad_accidente);
            $objeto->set_descripcion_accidente($descripcion_accidente);
            $objeto->set_antecedentes_tabaquismo($antecedentes_tabaquismo);
            $objeto->set_antecedentes_alcoholismo($antecedentes_alcoholismo);

            echo $objeto->registrar_antecedentes();
            exit;
        }

        if($accion == "modificar"){

            $trabajador = $_POST["trabajador"];
            $antecedentes_cardiovasculares = $_POST["antecedentes_cardiovasculares"];
            $antecedentes_pulmonares = $_POST["antecedentes_pulmonares"];
            $antecedentes_digestivos = $_POST["antecedentes_digestivos"];
            $antecedentes_diabeticos = $_POST["antecedentes_diabeticos"];
            $antecedentes_renales = $_POST["antecedentes_renales"];
            $alergias = $_POST["alergias"];
            $otros = $_POST["otros"];
            $tratamientos = $_POST["tratamientos"];
            $especificaciones_tratamiento = $_POST["especificaciones_tratamiento"];
            $intervenciones = $_POST["intervenciones"];
            $fecha_intervencion = $_POST["fecha_intervencion"];
            $edad_intervencion = $_POST["edad_intervencion"];
            $descripcion_intervencion = $_POST["descripcion_intervencion"];
            $accidentes = $_POST["accidentes"];
            $fecha_accidente = $_POST["fecha_accidente"];
            $edad_accidente = $_POST["edad_accidente"];
            $descripcion_accidente = $_POST["descripcion_accidente"];
            $antecedentes_tabaquismo = $_POST["antecedentes_tabaquismo"];
            $antecedentes_alcoholismo = $_POST["antecedentes_alcoholismo"];

            $objeto->set_trabajador($trabajador);
            $objeto->set_antecedentes_cardiovasculares($antecedentes_cardiovasculares);
            $objeto->set_antecedentes_pulmonares($antecedentes_pulmonares);
            $objeto->set_antecedentes_digestivos($antecedentes_digestivos);
            $objeto->set_antecedentes_diabeticos($antecedentes_diabeticos);
            $objeto->set_antecedentes_renales($antecedentes_renales);
            $objeto->set_alergias($alergias);
            $objeto->set_otros($otros);
            $objeto->set_tratamientos($tratamientos);
            $objeto->set_especificaciones_tratamiento($especificaciones_tratamiento);
            $objeto->set_intervenciones($intervenciones);
            $objeto->set_fecha_intervencion($fecha_intervencion);
            $objeto->set_edad_intervencion($edad_intervencion);
            $objeto->set_descripcion_intervencion($descripcion_intervencion);
            $objeto->set_accidentes($accidentes);
            $objeto->set_fecha_accidente($fecha_accidente);
            $objeto->set_edad_accidente($edad_accidente);
            $objeto->set_descripcion_accidente($descripcion_accidente);
            $objeto->set_antecedentes_tabaquismo($antecedentes_tabaquismo);
            $objeto->set_antecedentes_alcoholismo($antecedentes_alcoholismo);

            echo $objeto->modificar_antecedentes();
            exit;
        }

       if($accion == "eliminar"){
            $trabajador = $_POST['trabajador'];

            $objeto->set_trabajador($trabajador);
            echo $objeto->eliminar_antecedente();
            exit;
        }
    }

    $consultas = $objeto->listar_antecedentes();
    $consulta_trabajadores = $objeto->consulta_trabajadores();

    require_once("vista/" . $pagina . "Vista.php");
    exit;
} else {
    echo "pagina en contruccion vista";
    exit;
}
