<?php 

    if(!is_file("modelo/".$pagina."Modelo.php")){
        echo "modelo no existe";
        exit;
    }

    require_once("modelo/".$pagina."Modelo.php");
    
    if(is_file("vista/".$pagina."Vista.php")){

        $objeto = new homeModelo();

        if(isset($_POST['accion'])){

            $accion = $_POST['accion'];

            if($accion == "envio"){
                
                $saludar = "Hola Diego";
                http_response_code(200);
                echo $saludar;
                exit;
            }

        }
        

        require_once("vista/" . $pagina . "Vista.php");
        exit;
    }else{
        echo "pagina en contruccion vista";
        exit;
    }

?>