<?php 
    namespace modelo;
    use modelo\conexion as conexion;

    use PDO;
    use PDOException;
    class AntecedentesModelo extends conexion{

    private $trabajador;
    private $antecedentes_cardiovasculares;
    private $antecedentes_pulmonares;
    private $antecedentes_digestivos;
    private $antecedentes_diabeticos;
    private $antecedentes_renales;
    private $alergias;
    private $otros;
    private $tratamientos;
    private $especificaciones_tratamiento;
    private $intervenciones;
    private $fecha_intervencion;
    private $edad_intervencion;
    private $descripcion_intervencion;
    private $accidentes;
    private $fecha_accidente;
    private $edad_accidente;
    private $descripcion_accidente;
    private $antecedentes_tabaquismo;
    private $antecedentes_alcoholismo;

    public function set_trabajador($valor){
        $this->trabajador = $valor;
    }
    public function set_antecedentes_cardiovasculares($valor){
        $this->antecedentes_cardiovasculares = $valor;
    }
    public function set_antecedentes_pulmonares($valor){
        $this->antecedentes_pulmonares = $valor;
    }
    public function set_antecedentes_digestivos($valor){
        $this->antecedentes_digestivos = $valor;
    }
    public function set_antecedentes_diabeticos($valor){
        $this->antecedentes_diabeticos = $valor;
    }
    public function set_antecedentes_renales($valor){
        $this->antecedentes_renales = $valor;
    }
    public function set_alergias($valor){
        $this->alergias = $valor;
    }
    public function set_otros($valor){
        $this->otros = $valor;
    }
    public function set_tratamientos($valor){
        $this->tratamientos = $valor;
    }
    public function set_especificaciones_tratamiento($valor){
        $this->especificaciones_tratamiento = $valor;
    }
    public function set_intervenciones($valor){
        $this->intervenciones = $valor;
    }
    public function set_fecha_intervencion($valor){
        $this->fecha_intervencion = $valor;
    }
    public function set_edad_intervencion($valor){
        $this->edad_intervencion = $valor;
    }
    public function set_descripcion_intervencion($valor){
        $this->descripcion_intervencion = $valor;
    }
    public function set_accidentes($valor){
        $this->accidentes = $valor;
    }
    public function set_fecha_accidente($valor){
        $this->fecha_accidente = $valor;
    }
    public function set_edad_accidente($valor){
        $this->edad_accidente = $valor;
    }
    public function set_descripcion_accidente($valor){
        $this->descripcion_accidente = $valor;
    }
    public function set_antecedentes_tabaquismo($valor){
        $this->antecedentes_tabaquismo = $valor;
    }
    public function set_antecedentes_alcoholismo($valor){
        $this->antecedentes_alcoholismo = $valor;
    }

    public function registrar_antecedentes($cedula_bitacora,$modulo){
        try {

            if(

                !$this->evaluar_caracteres("/^[0-9\b]{1,50}$/",$this->trabajador)
            ){
            	http_response_code(400);
                return "Caracteres inválidos";
            }

            if($this->existe_antecedentes($this->trabajador)){
                http_response_code(400);
                return "Los antecedentes de este trabajador ya existen";
            }

            
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO antecedentes (id_trabajadores,ant_cardiovasculares,ant_pulmonares,ant_digestivos,ant_diabetes,ant_renales,alergias,otros,tratamiento,especificacion_tratamiento,int_quirurjico,fecha_intervencion,edad_intervencion,descripcion_intervencion,accidentes,fecha_accidente,edad_accidente,descripcion_accidente,ant_tabaquismo,ant_alcoholismo) VALUES (:trabajador, :ant_cardiovasculares,:ant_pulmonares,:ant_digestivos,:ant_diabetes,:ant_renales,:alergias,:otros,:tratamiento,:especificacion_tratamiento,:int_quirurjico,:fecha_intervencion,:edad_intervencion,:descripcion_intervencion,:accidentes,:fecha_accidente,:edad_accidente,:descripcion_accidente,:ant_tabaquismo,:ant_alcoholismo)";

            $stmt = $bd->prepare($sql);
            
            $stmt->execute(array(
                ":trabajador" => $this->trabajador,
                ":ant_cardiovasculares" => $this->antecedentes_cardiovasculares,
                ":ant_pulmonares" => $this->antecedentes_pulmonares,
                ":ant_digestivos" => $this->antecedentes_digestivos,
                ":ant_diabetes" => $this->antecedentes_digestivos,
                ":ant_diabetes" => $this->antecedentes_diabeticos,
                ":ant_renales" => $this->antecedentes_renales,
                ":alergias" => $this->alergias,
                ":otros" => $this->otros,
                ":tratamiento" => $this->tratamientos,
                ":especificacion_tratamiento" => $this->especificaciones_tratamiento,
                ":int_quirurjico" => $this->intervenciones,
                ":fecha_intervencion" => $this->fecha_intervencion,
                ":edad_intervencion" => $this->edad_intervencion,
                ":descripcion_intervencion" => $this->descripcion_intervencion,
                ":accidentes" => $this->accidentes,
                ":fecha_accidente" => $this->fecha_accidente,
                ":edad_accidente" => $this->edad_accidente,
                ":descripcion_accidente" => $this->descripcion_accidente,
                ":ant_tabaquismo" => $this->antecedentes_tabaquismo,
                ":ant_alcoholismo" => $this->antecedentes_alcoholismo
            ));

            $accion= "Ha registrado un antecedente";

            parent::registrar_bitacora($cedula_bitacora, $accion, $modulo);

            http_response_code(200);
            return "registro exitoso";
            
        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
    }

    public function listar_antecedentes(){

        try{
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT a.id, a.ant_cardiovasculares,
                b.id as id_trabajadores,
                a.ant_pulmonares, a.ant_digestivos, a.ant_diabetes, a.ant_renales,
                a.alergias, a.otros,
                a.tratamiento,a.especificacion_tratamiento,a.int_quirurjico,a.fecha_intervencion,a.edad_intervencion,a.descripcion_intervencion,a.accidentes,a.fecha_accidente,a.edad_accidente,a.descripcion_accidente,a.ant_tabaquismo,a.ant_alcoholismo, CONCAT(b.cedula,' ',b.nombre), b.cedula,
                b.nombre
                from antecedentes a INNER JOIN trabajadores b ON a.id_trabajadores = b.id";
            

            $stmt = $bd->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
        
    }

   public function modificar_antecedentes($cedula_bitacora,$modulo){
        try {
            
            if (!$this->existe_antecedentes($this->trabajador)) {
                http_response_code(400);
                return "Los antecedentes no existen";
            }
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "UPDATE antecedentes SET ant_cardiovasculares = :ant_cardiovasculares, ant_pulmonares = :ant_pulmonares, ant_digestivos = :ant_digestivos, ant_diabetes = :ant_diabetes, ant_renales = :ant_renales, alergias = :alergias, otros = :otros, tratamiento = :tratamiento, especificacion_tratamiento = :especificacion_tratamiento, int_quirurjico = :int_quirurjico, fecha_intervencion = :fecha_intervencion, edad_intervencion = :edad_intervencion, descripcion_intervencion = :descripcion_intervencion, accidentes = :accidentes, fecha_accidente = :fecha_accidente, edad_accidente = :edad_accidente, descripcion_accidente = :descripcion_accidente, ant_tabaquismo = :ant_tabaquismo, ant_alcoholismo = :ant_alcoholismo WHERE id_trabajadores = :trabajador";

            $stmt = $bd->prepare($sql);

            $stmt->execute(array(
                ":ant_cardiovasculares" => $this->antecedentes_cardiovasculares,
                ":ant_pulmonares" => $this->antecedentes_pulmonares,
                ":ant_digestivos" => $this->antecedentes_digestivos,
                ":ant_diabetes" => $this->antecedentes_diabeticos,
                ":ant_renales" => $this->antecedentes_renales,
                ":alergias" => $this->alergias,
                ":otros" => $this->otros,
                ":tratamiento" => $this->tratamientos,
                ":especificacion_tratamiento" => $this->especificaciones_tratamiento,
                ":int_quirurjico" => $this->intervenciones,
                ":fecha_intervencion" => $this->fecha_intervencion,
                ":edad_intervencion" => $this->edad_intervencion,
                ":descripcion_intervencion" => $this->descripcion_intervencion,
                ":accidentes" => $this->accidentes,
                ":fecha_accidente" => $this->fecha_accidente,
                ":edad_accidente" => $this->edad_accidente,
                ":descripcion_accidente" => $this->descripcion_accidente,
                ":ant_tabaquismo" => $this->antecedentes_tabaquismo,
                ":ant_alcoholismo" => $this->antecedentes_alcoholismo,
                ":trabajador" => $this->trabajador,
            ));

            $accion= "Ha modificado un antecedente";

            parent::registrar_bitacora($cedula_bitacora, $accion, $modulo);

            http_response_code(200);
            return "Modificación con exito";
        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
    }

    public function eliminar_antecedente($cedula_bitacora,$modulo){
        try {
            /*if(!$this->evaluar_caracteres("/^[0-9]{7,8}$/", $this->cedula)){
                http_response_code(400);
                return "Caracteres inválidos";
            }*/

            if (!$this->existe_antecedentes($this->trabajador)){
                http_response_code(400);
                return "Este antecedente No existe";
            }

            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "DELETE FROM antecedentes WHERE id_trabajadores = :trabajador";

            $stmt = $bd->prepare($sql);

            $stmt->execute(array(
                ":trabajador" => $this->trabajador
            ));

            $accion= "Ha eliminado un antecedente";

            parent::registrar_bitacora($cedula_bitacora, $accion, $modulo);

            http_response_code(200);
            return "eliminacion con exito";
            
        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
    }

    private function existe_antecedentes($trabajador){
        try {
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM antecedentes WHERE id_trabajadores = :trabajador";

            $stmt = $bd->prepare($sql);

            $stmt->execute(array(
                ":trabajador" => $trabajador,
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