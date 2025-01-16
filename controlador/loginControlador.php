<?php

require_once("modelo/".$pagina."Modelo.php");


if (is_file("vista/" . $pagina . "Vista.php")) {

	if(isset($_POST['accion'])){

            $objeto = new loginModelo();

            $accion = $_POST['accion'];

              
            if($accion == "login"){

                $cedula = $_POST['cedula'];
                $contrasena = $_POST['contrasena'];

                $objeto->set_cedula($cedula);
                $objeto->set_contrasena($contrasena);

                $resultado = $objeto->login();

                if($resultado == "ok"){

                    $info_usuario = $objeto->info_usuario();

                    session_start();

                    $_SESSION["cedula"] = $info_usuario['cedula'];
                    $_SESSION["nombre"] = $info_usuario['nombre'];
                    
                    http_response_code(200);
                    echo "Inicio con exito";
                }else{
                    http_response_code(400);

                    echo $resultado;
                }
            	
                exit;

            }    
     }

    require_once("vista/" . $pagina . "Vista.php");
    exit;
} else {
    echo "pagina en contruccion vista";
    exit;
}
