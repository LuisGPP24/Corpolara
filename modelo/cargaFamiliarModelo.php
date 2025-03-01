<?php

namespace modelo;

use modelo\conexion as conexion;

use PDO;
use PDOException;

class cargaFamiliarModelo extends conexion{

    private $id;
    private $trabajador;
    private $movimiento;
    private $nacionalidad;
    private $cedula;
    private $fecha_nacimiento;
    private $nombre;
    private $parentesco;
    private $genero;
    private $cuenta;
    private $correo;
    private $fecha_ingreso;

    public function set_id($valor){
        $this->id = $valor;
    }
    public function set_trabajador($valor){
        $this->trabajador = $valor;
    }
    public function set_movimiento($valor){
        $this->movimiento = $valor;
    }
    public function set_nacionalidad($valor){
        $this->nacionalidad = $valor;
    }
    public function set_cedula($valor){
        $this->cedula = $valor;
    }
    public function set_fecha_nacimiento($valor){
        $this->fecha_nacimiento = $valor;
    }
    public function set_nombre($valor){
        $this->nombre = $valor;
    }
    public function set_parentesco($valor){
        $this->parentesco = $valor;
    }
    public function set_genero($valor){
        $this->genero = $valor;
    }
    public function set_cuenta($valor){
        $this->cuenta = $valor;
    }
    public function set_correo($valor){
        $this->correo = $valor;
    }
    public function set_fecha_ingreso($valor){
        $this->fecha_ingreso = $valor;
    }

    public function registrar_familiar($cedula_bitacora,$modulo){
        try {

            if(

                !$this->evaluar_caracteres("/^[0-9\b]{1,50}$/",$this->trabajador)
            ){
            	http_response_code(400);
                return "Elija a un trabajador";
            }

            if($this->existe_familiar($this->cedula)){
                http_response_code(400);
                return "Este familiar ya existe";
            }

            $accion= "Ha registrado una carga familiar";

            parent::registrar_bitacora($cedula_bitacora, $accion, $modulo);

            
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO familiares (id_trabajadores,movimiento,nacionalidad,cedula,fecha_nacimiento,nombre,parentesco,genero,cuenta,correo,fecha_ingreso) VALUES (:trabajador, :movimiento, :nacionalidad, :cedula, :fecha_nacimiento, :nombre, :parentesco, :genero, :cuenta, :correo, :fecha_ingreso)";

            $stmt = $bd->prepare($sql);
            
            $stmt->execute(array(
                ":trabajador" => $this->trabajador,
                ":movimiento" => $this->movimiento,
                ":nacionalidad" => $this->nacionalidad,
                ":cedula" => $this->cedula,
                ":fecha_nacimiento" => $this->fecha_nacimiento,
                ":nombre" => $this->nombre,
                ":parentesco" => $this->parentesco,
                ":genero" => $this->genero,
                ":cuenta" => $this->cuenta,
                ":correo" => $this->correo,
                ":fecha_ingreso" => $this->fecha_ingreso

            ));

            http_response_code(200);
            return "registro exitoso";
            
        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
    }

    public function listar_familiar(){

        try{
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT a.id,
                b.id as id_trabajadores,
                a.movimiento, a.nacionalidad, a.cedula, a.fecha_nacimiento,
                a.nombre, a.parentesco,a.genero,a.cuenta,a.correo,a.fecha_ingreso,a.nombre as nombre2,b.nombre from familiares a INNER JOIN trabajadores b ON a.id_trabajadores = b.id";
            

            $stmt = $bd->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
        
    }

   public function modificar_familiar($cedula_bitacora,$modulo){
        try {

            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

           
            $sql = "UPDATE familiares SET movimiento = :movimiento, nacionalidad = :nacionalidad, cedula = :cedula, fecha_nacimiento = :fecha_nacimiento, nombre = :nombre, parentesco = :parentesco, genero = :genero, cuenta = :cuenta, correo = :correo, fecha_ingreso = :fecha_ingreso WHERE id = :id";

            $stmt = $bd->prepare($sql);

            $stmt->execute(array(
                
                ":movimiento" => $this->movimiento,
                ":nacionalidad" => $this->nacionalidad,
                ":cedula" => $this->cedula,
                ":fecha_nacimiento" => $this->fecha_nacimiento,
                ":nombre" => $this->nombre,
                ":parentesco" => $this->parentesco,
                ":genero" => $this->genero,
                ":cuenta" => $this->cuenta,
                ":correo" => $this->correo,
                ":fecha_ingreso" => $this->fecha_ingreso,
                ":id" => $this->id,
            ));

            $accion= "Ha modificado una carga familiar";

            parent::registrar_bitacora($cedula_bitacora, $accion, $modulo);

            http_response_code(200);
            return "Modificación con exito";
        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
    }

    public function eliminar_familiar($cedula_bitacora,$modulo){
        try {

            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "DELETE FROM familiares WHERE id = :id";

            $stmt = $bd->prepare($sql);

            $stmt->execute(array(
                ":id" => $this->id
            ));

            $accion= "Ha eliminado una carga familiar";

            parent::registrar_bitacora($cedula_bitacora, $accion, $modulo);

            http_response_code(200);
            return "eliminacion con exito";
            
        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
    }

    private function existe_familiar($cedula){
        try {
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM familiares WHERE cedula = :cedula";

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

    public function consulta_trabajadores(){

        try{

            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT id,cedula, nombre from trabajadores";

            $stmt = $bd->prepare($sql);
            $stmt->execute();
            
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if($resultado){
                http_response_code(200);
                return $resultado;
            }else{
                http_response_code(200);
                return null;
            }


        }catch(PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
    }
}
?>