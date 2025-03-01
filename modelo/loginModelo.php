<?php 

    namespace modelo;

    use modelo\conexion as conexion;
    use PDO;
    use PDOException;

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

                $info_usuario = $stmt->fetch(PDO::FETCH_ASSOC);
                $sql = "SELECT * FROM usuarios WHERE cedula = :cedula LIMIT 1";

                $stmt = $bd->prepare($sql);

                $stmt->execute(array(
                    ":cedula" => $this->cedula
                ));

                $info_usuario = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if(!$info_usuario){
                    http_response_code(400);
                    return false;
                }

                $sql = "SELECT p.id,p.id_modulos,p.acceso from usuarios u INNER Join permisos p on u.id_rol = p.id_rol WHERE u.cedula = :cedula";

                $stmt = $bd->prepare($sql);

                $stmt->execute(array(
                    ":cedula" => $this->cedula
                ));

                $permisos = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $resultado = array(
                    "cedula" => $info_usuario["cedula"],
                    "nombre" => $info_usuario["nombre"],
                    "correo" => $info_usuario["correo"],
                    "id_rol" => $info_usuario["id_rol"],
                    "permisos" => $permisos
                );

                return $resultado;
            } catch (PDOException $e){
                echo $e->getMessage();
            }
        }


    }

?>



