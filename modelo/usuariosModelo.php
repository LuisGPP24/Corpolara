<?php

namespace modelo;

use modelo\conexion as conexion;
use PDO;
use PDOException;

class usuariosModelo extends conexion{

    private $id;
    private $cedula;
    private $nombre;
    private $contrasena;
    private $contrasena2;
    private $correo;
    private $rol;

    public function set_id($valor){
        $this->id = $valor;
    }
    public function set_cedula($valor){
        $this->cedula = $valor;
    }
    public function set_nombre($valor){
        $this->nombre = $valor;
    }
    public function set_contrasena($valor){
        $this->contrasena = $valor;
    }
    public function set_contrasena2($valor){
        $this->contrasena2 = $valor;
    }
    public function set_correo($valor){
        $this->correo = $valor;
    }
    public function set_rol($valor){
        $this->rol = $valor;
    }

    public function registrar_usuario(){
        try {

            if(
                !$this->evaluar_caracteres("/^[0-9]{7,8}$/",$this->cedula) ||
                !$this->evaluar_caracteres("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,50}$/",$this->nombre)||
                !$this->evaluar_caracteres("/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ$#*.,]{1,50}$/",$this->contrasena) ||
                !$this->evaluar_caracteres("/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ$#*.,]{1,50}$/",$this->contrasena2) ||
                !$this->evaluar_caracteres("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/",$this->correo) ||
                !$this->evaluar_caracteres("/^[0-9]{1,10}$/", $this->rol)
            ){
                http_response_code(400);
                return "Caracteres inválidos";
            }

            if($this->existe_usuario($this->cedula)){
                http_response_code(400);
                return "Usuario ya existe";
            }

            if($this->contrasena != $this->contrasena2){
                http_response_code(400);
                return "contraseñas no coinciden";
            }

            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $contrasena_hash = password_hash($this->contrasena, PASSWORD_DEFAULT,["cost" => 12]);

            $sql = "INSERT INTO usuarios (cedula,id_rol,nombre,contrasena,correo) VALUES (:cedula,:id_rol, :nombre,:contrasena,:correo)";

            $stmt = $bd->prepare($sql);
            
            $stmt->execute(array(
                ":cedula" => $this->cedula,
                ":id_rol" => $this->rol,
                ":nombre" => $this->nombre,
                ":contrasena" => $contrasena_hash,
                ":correo" => $this->correo,
            ));

            http_response_code(200);
            return "registro exitoso";
            
        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
    }

    // public function listar_usuario(){

    //     try{
    //         $bd = $this->conecta();
    //         $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //         $sql = "SELECT * FROM usuarios";

    //         $stmt = $bd->prepare($sql);

    //         $stmt->execute();

    //         return $stmt->fetchAll(PDO::FETCH_ASSOC);

    //     } catch (PDOException $e) {
    //         http_response_code(500);
    //         return $e->getMessage();
    //     }
        
    // }
    public function listar_usuario(){

        try{
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM usuarios";

            $stmt = $bd->prepare($sql);

            $stmt->execute();

            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $data = array();

            foreach ($resultados as $resultado) {

                $subarray = array();
                $subarray['id'] = $resultado['id'];
                $subarray['cedula'] = $resultado['cedula'];
                $subarray['nombre'] = $resultado['nombre'];
                $subarray['correo'] = $resultado['correo'];

                $data[] = $subarray;
            }

            $json = array(
                    "data" => $data
                );

            return json_encode($json);
        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
        
    }

    public function modificar_usuario(){
        try {
            if (
                !$this->evaluar_caracteres("/^[0-9]{7,8}$/", $this->cedula) ||
                !$this->evaluar_caracteres("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,50}$/", $this->nombre) ||
                !$this->evaluar_caracteres("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $this->correo) ||
                !$this->evaluar_caracteres("/^[0-9]{1,10}$/", $this->rol)
            ) {
                http_response_code(400);
                return "Caracteres inválidos";
            }

            if (!$this->existe_usuario($this->cedula)) {
                http_response_code(400);
                return "Usuario no existe";
            }
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "UPDATE usuarios SET nombre = :nombre, correo = :correo, id_rol = :id_rol WHERE cedula = :cedula";

            $stmt = $bd->prepare($sql);

            $stmt->execute(array(
                ":cedula" => $this->cedula,
                ":id_rol" => $this->rol,
                ":nombre" => $this->nombre,
                ":correo" => $this->correo,
                
            ));

            http_response_code(200);
            return "Modificación con exito";
        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
    }
    public function eliminar_usuario(){
        try {
            if(!$this->evaluar_caracteres("/^[0-9]{7,8}$/", $this->cedula)){
                http_response_code(400);
                return "Caracteres inválidos";
            }

            if (!$this->existe_usuario($this->cedula)){
                http_response_code(400);
                return "Usuario No existe";
            }

            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "DELETE FROM usuarios WHERE cedula = :cedula";

            $stmt = $bd->prepare($sql);

            $stmt->execute(array(
                ":cedula" => $this->cedula
            ));

            http_response_code(200);
            return "eliminacion con exito";
            
        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
    }

    public function cambiar_contrasena(){
        try{

            if (
                !$this->evaluar_caracteres("/^[0-9]{7,8}$/", $this->cedula) ||
                !$this->evaluar_caracteres("/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ$#*.,]{1,50}$/", $this->contrasena) ||
                !$this->evaluar_caracteres("/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ$#*.,]{1,50}$/", $this->contrasena2) 
            ) {
                http_response_code(400);
                return "Caracteres inválidos";
            }
            if (!$this->existe_usuario($this->cedula)) {
                http_response_code(400);
                return "Usuario no existe";
            }

            if ($this->contrasena != $this->contrasena2) {
                http_response_code(400);
                return "contraseñas no coinciden";
            }

            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $contrasena_hash = password_hash($this->contrasena, PASSWORD_DEFAULT, ["cost" => 12]);

            $sql = "UPDATE usuarios SET contrasena = :contrasena WHERE cedula = :cedula";

            $stmt = $bd->prepare($sql);

            $stmt->execute(array(
                ":cedula" => $this->cedula,
                ":contrasena" => $contrasena_hash,

            ));

            http_response_code(200);
            return "Actualización con exito";

            
        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
    }

    private function existe_usuario($cedula){
        try {
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM usuarios WHERE cedula = :cedula";

            $stmt = $bd->prepare($sql);

            $stmt->execute(array(
                ":cedula" => $cedula,
            ));
            
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($resultado) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }
    }

    private function evaluar_caracteres($regex, $valor){
        $valor = trim($valor);
        $matches = preg_match_all($regex, $valor);

        return $matches > 0;
    }
}