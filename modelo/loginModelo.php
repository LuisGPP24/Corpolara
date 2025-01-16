<?php 

    require_once('conexion.php');

    class loginModelo extends conexion {

        private $cedula;
        private $contrasena;

        public function set_cedula($valor)
        {
            $this->cedula = $valor;
        }
        public function set_contrasena($valor)
        {
            $this->contrasena = $valor;
        }

        public function login(){
            try {

                if(
                    !$this->val_string("/^[0-9]{7,10}$/",$this->cedula) ||
                    !$this->val_string("/^[a-zA-Z0-9*#.,-_]{5,20}$/",$this->contrasena) 

                ){
                    http_response_code(400);
                    return "Carácteres inválidos";
                }

                $bd = $this->conecta();
                $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT * FROM usuarios WHERE cedula = :cedula LIMIT 1";

                $stmt = $bd->prepare($sql);

                $stmt->execute(array(
                    ":cedula" => $this->cedula
                ));

                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

                if(!$resultado){
                    http_response_code(400);
                    return "usuario no existe";
                }

                if(!password_verify($this->contrasena, $resultado['contrasena'])){
                    http_response_code(400);
                    return "contraseña incorrecta";
                }

                http_response_code(200);
                return "ok";


            } catch (PDOException $e){
                echo $e->getMessage();
            }
        }

        public function info_usuario(){
            try {


                $bd = $this->conecta();
                $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT * FROM usuarios WHERE cedula = :cedula LIMIT 1";

                $stmt = $bd->prepare($sql);

                $stmt->execute(array(
                    ":cedula" => $this->cedula
                ));

                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

                if($resultado){
                    return $resultado;
                }else{
                    http_response_code(400);
                    return false;
                }

               

            } catch (PDOException $e){
                echo $e->getMessage();
            }
        }


    }

?>



