<?php 

    require_once("conexion.php");
    class ConsultasModelo extends conexion{

    private $id;
    private $trabajador;
    private $fecha_consulta;
    private $nombre_paciente;
    private $cedula_paciente;
    private $parentesco;
    private $genero_paciente;
    private $edad_paciente;
    private $direccion;
    private $gerencia;
    private $telefono;
    private $motivo_consulta;
    private $doctor;

    public function set_id($valor){
        $this->id = $valor;
    }
    public function set_trabajador($valor){
        $this->trabajador = $valor;
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
    public function set_parentesco($valor){
        $this->parentesco = $valor;
    }
    public function set_genero_paciente($valor){
        $this->genero_paciente = $valor;
    }
    public function set_edad_paciente($valor){
        $this->edad_paciente = $valor;
    }
    public function set_direccion($valor){
        $this->direccion = $valor;
    }
    public function set_gerencia($valor){
        $this->gerencia = $valor;
    }
    public function set_telefono($valor){
        $this->telefono = $valor;
    }
    public function set_motivo_consulta($valor){
        $this->motivo_consulta = $valor;
    }
    public function set_doctor($valor){
        $this->doctor = $valor;
    }

    public function registrar_morbilidad(){
        try {

            if(

                !$this->evaluar_caracteres("/^[0-9\b]{1,50}$/",$this->trabajador)
                /*!$this->evaluar_caracteres("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,50}$/",$this->antecedentes_cardiovasculares)||
                !$this->evaluar_caracteres("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,50}$/",$this->antecedentes_pulmonares)||
                !$this->evaluar_caracteres("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,50}$/",$this->antecedentes_digestivos)||
                !$this->evaluar_caracteres("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,50}$/",$this->antecedentes_diabeticos)||
                !$this->evaluar_caracteres("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,50}$/",$this->antecedentes_renales)||
                !$this->evaluar_caracteres("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,50}$/",$this->alergias)||
                !$this->evaluar_caracteres("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,50}$/",$this->otros)||
                !$this->evaluar_caracteres("/^[0-9a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,50}$/",$this->tratamientos)||
                !$this->evaluar_caracteres("/^[0-9a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,50}$/",$this->especificaciones_tratamiento)||
                !$this->evaluar_caracteres("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,50}$/",$this->intervenciones)||
                !$this->evaluar_caracteres("/^[0-9a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,50}$/",$this->edad_intervencion)||
                !$this->evaluar_caracteres("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,50}$/",$this->descripcion_intervencion)||
                !$this->evaluar_caracteres("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,50}$/",$this->accidentes)||
                !$this->evaluar_caracteres("/^[0-9a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,50}$/",$this->edad_accidente)||
                !$this->evaluar_caracteres("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,50}$/",$this->descripcion_accidente)||
                !$this->evaluar_caracteres("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,50}$/",$this->antecedentes_tabaquismo)||
                !$this->evaluar_caracteres("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,50}$/",$this->antecedentes_alcoholismo)*/
            ){
            	http_response_code(400);
                return "Elija a un trabajador";
            }

            /*if($this->existe_familiar($this->cedula)){
                http_response_code(400);
                return "Este familiar ya existe";
            }*/

            
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO morbilidad (id_trabajadores, fecha_consulta, nombre_paciente, cedula, genero, edad_paciente, parentesco, direccion, gerencia, telefono, motivo, especialidad) VALUES (:trabajador, :fecha_consulta, :nombre_paciente, :cedula, :genero, :edad_paciente, :parentesco, :direccion, :gerencia, :telefono, :motivo, :especialidad)";

            $stmt = $bd->prepare($sql);
            
            $stmt->execute(array(
                ":trabajador" => $this->trabajador,
                ":fecha_consulta" => $this->fecha_consulta,
                ":nombre_paciente" => $this->nombre_paciente,
                ":cedula" => $this->cedula_paciente,
                ":genero" => $this->genero_paciente,
                ":edad_paciente" => $this->edad_paciente,
                ":parentesco" => $this->parentesco,
                ":direccion" => $this->direccion,
                ":gerencia" => $this->gerencia,
                ":telefono" => $this->telefono,
                ":motivo" => $this->motivo_consulta,
                ":especialidad" => $this->doctor

            ));

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
                a.fecha_consulta, a.nombre_paciente, a.cedula, a.genero,
                a.edad_paciente, a.parentesco, a.direccion,a.gerencia,a.telefono,a.motivo, a.especialidad, b.nombre, b.cedula as cedula2 from morbilidad a INNER JOIN trabajadores b ON a.id_trabajadores = b.id";
            

            $stmt = $bd->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
        
    }

   public function modificar_consulta(){
        try {
            /*if (
                !$this->evaluar_caracteres("/^[0-9]{7,8}$/", $this->cedula) ||
                !$this->evaluar_caracteres("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,50}$/", $this->nombre) ||
                !$this->evaluar_caracteres("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $this->correo)
            ) {
                http_response_code(400);
                return "Caracteres inválidos";
            }
            
            if (!$this->existe_antecedentes($this->trabajador)) {
                http_response_code(400);
                return "Los antecedentes no existen";
            }*/

            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

           $sql = "UPDATE morbilidad SET fecha_consulta = :fecha_consulta, nombre_paciente = :nombre_paciente, cedula = :cedula, genero = :genero, edad_paciente = :edad_paciente, parentesco = :parentesco, direccion = :direccion, gerencia = :gerencia, telefono = :telefono, motivo = :motivo, especialidad = :especialidad WHERE id = :id";

            $stmt = $bd->prepare($sql);

            $stmt->execute(array(
                
                ":fecha_consulta" => $this->fecha_consulta,
                ":nombre_paciente" => $this->nombre_paciente,
                ":cedula" => $this->cedula_paciente,
                ":genero" => $this->genero_paciente,
                ":edad_paciente" => $this->edad_paciente,
                ":parentesco" => $this->parentesco,
                ":direccion" => $this->direccion,
                ":gerencia" => $this->gerencia,
                ":telefono" => $this->telefono,
                ":motivo" => $this->motivo_consulta,
                ":especialidad" => $this->doctor,
                ":id" => $this->id
            ));

            http_response_code(200);
            return "Modificación con exito";
        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
    }

    public function eliminar_consulta(){
        try {
            /*if(!$this->evaluar_caracteres("/^[0-9]{7,8}$/", $this->cedula)){
                http_response_code(400);
                return "Caracteres inválidos";
            }

            if (!$this->existe_familiar($this->cedula)){
                http_response_code(400);
                return "Este familiar No existe";
            }*/

            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "DELETE FROM morbilidad WHERE id = :id";

            $stmt = $bd->prepare($sql);

            $stmt->execute(array(
                ":id" => $this->id
            ));

            http_response_code(200);
            return "eliminacion con exito";
            
        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
    }

    /*private function existe_familiar($cedula){
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
    }*/

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


        }catch(Exception $e) {
            http_response_code(500);
            return $e->getMessage();
        }
    }
}
?>