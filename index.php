<?php

$pagina = "login";

if (!empty($_GET['pagina'])) {
    $pagina = $_GET['pagina'];
}

if (is_file("controlador/".$pagina."Controlador.php")){

	//comprueba que se inicie la sesion php
    if(empty($_SESSION) and $pagina != 'login'){
        session_start();
    }

    //comprueba que exista una sesion para poder redirigirse entre paginas
    if(!isset($_SESSION['cedula']) || $_SESSION['cedula'] == "" and $pagina != 'login' and $pagina != 'error404'){
        
        require_once("controlador/logoutControlador.php");
        exit;
    }

    require_once("controlador/".$pagina."Controlador.php");
    exit;
}else{
    
    require_once("controlador/error404Controlador.php");
}


?>