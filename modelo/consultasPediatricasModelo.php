<?php 

    namespace modelo;

    use modelo\conexion as conexion;
    use PDO;
    use PDOException;

    class consultasPediatricasModelo extends conexion{

    private $id;
    private $representante;
    private $fecha_consulta;
    private $nombre_paciente;
    private $cedula_paciente;
    private $fecha_nacimiento;
    private $genero_paciente;
    private $telefono;
    private $especialidad;
    private $observacion;

    public function set_id($valor){
        $this->id = $valor;
    }
    public function set_representante($valor){
        $this->representante = $valor;
    }
    public function set_fecha_consulta($valor){
        $this->fecha_consulta = $valor;
    }
    public function set_nombre_paciente($valor){
        $this->nombre_paciente = $valor;
    }
    public function set_cedula_paciente($valor){
        $this->cedula_paciente = $valor;
    }
    public function set_fecha_nacimiento($valor){
        $this->fecha_nacimiento = $valor;
    }
    public function set_genero_paciente($valor){
        $this->genero_paciente = $valor;
    }
    public function set_telefono($valor){
        $this->telefono = $valor;
    }
    public function set_especialidad($valor){
        $this->especialidad = $valor;
    }
    public function set_observacion($valor){
        $this->observacion = $valor;
    }

    public function registrar_morbilidad($cedula_bitacora,$modulo){
        try {

            if(

                !$this->evaluar_caracteres("/^[0-9\b]{1,50}$/",$this->representante)
            ){
            	http_response_code(400);
                return "Elija a un representante";
            }

            
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO morbilidad_pediatrica (id_trabajadores, fecha_consulta, nombre_paciente, cedula_paciente, fecha_nacimiento, genero, telefono, doctor, observacion) VALUES (:trabajador, :fecha_consulta, :nombre_paciente, :cedula_paciente, :fecha_nacimiento, :genero, :telefono, :doctor, :observacion)";

            $stmt = $bd->prepare($sql);
            
            $stmt->execute(array(
                ":trabajador" => $this->representante,
                ":fecha_consulta" => $this->fecha_consulta,
                ":nombre_paciente" => $this->nombre_paciente,
                ":cedula_paciente" => $this->cedula_paciente,
                ":fecha_nacimiento" => $this->fecha_nacimiento,
                ":genero" => $this->genero_paciente,
                ":telefono" => $this->telefono,
                ":doctor" => $this->especialidad,
                ":observacion" => $this->observacion
            ));

            $accion= "Ha registrado una consulta pediátrica";

            parent::registrar_bitacora($cedula_bitacora, $accion, $modulo);

            http_response_code(200);
            return "registro exitoso";
            
        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
    }

    public function listar_consulta(){

        try{
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT a.id,
                b.id as id_trabajadores,
                a.fecha_consulta, a.nombre_paciente, a.cedula_paciente, a.fecha_nacimiento,
                a.genero, a.telefono, a.telefono, a.doctor, a.observacion, b.nombre from morbilidad_pediatrica a INNER JOIN trabajadores b ON a.id_trabajadores = b.id";
            

            $stmt = $bd->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
        
    }

   public function modificar_consulta($cedula_bitacora,$modulo){
        try {

            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

           $sql = "UPDATE morbilidad_pediatrica SET id_trabajadores = :representante, fecha_consulta = :fecha_consulta, nombre_paciente = :nombre_paciente, fecha_nacimiento = :fecha_nacimiento, genero = :genero, telefono = :telefono, doctor = :doctor, observacion = :observacion WHERE id = :id";

            $stmt = $bd->prepare($sql);

            $stmt->execute(array(
                
                ":representante" => $this->representante,
                ":fecha_consulta" => $this->fecha_consulta,
                ":nombre_paciente" => $this->nombre_paciente,
                ":fecha_nacimiento" => $this->fecha_nacimiento,
                ":genero" => $this->genero_paciente,
                ":telefono" => $this->telefono,
                ":doctor" => $this->especialidad,
                ":observacion" => $this->observacion,
                ":id" => $this->id
            ));

            $accion= "Ha modificado una consulta pediátrica";

            parent::registrar_bitacora($cedula_bitacora, $accion, $modulo);


            http_response_code(200);
            return "Modificación con exito";
        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
    }

    public function eliminar_consulta($cedula_bitacora,$modulo){
        try {

            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "DELETE FROM morbilidad_pediatrica WHERE id = :id";

            $stmt = $bd->prepare($sql);

            $stmt->execute(array(
                ":id" => $this->id
            ));

            $accion= "Ha eliminado una consulta pediátrica";

            parent::registrar_bitacora($cedula_bitacora, $accion, $modulo);

            http_response_code(200);
            return "eliminacion con exito";
            
        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
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

            $sql = "SELECT id, nombre from trabajadores";

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


        }catch(Exception $e) {
            http_response_code(500);
            return $e->getMessage();
        }
    }
}
?>