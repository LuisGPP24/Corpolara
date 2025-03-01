<?php 

    namespace modelo;

    use modelo\conexion as conexion;
    use PDO;
    use PDOException;
    
    class FunerariaModelo extends conexion{

    private $id;
    private $codigo_registro;
    private $ente;
    private $defuncion_paciente;
    
    public function set_id($valor){
        $this->id = $valor;
    }
    public function set_codigo_registro($valor){
        $this->codigo_registro = $valor;
    }    
    public function set_ente($valor){
        $this->ente = $valor;
    }
    public function set_defuncion_paciente($valor){
        $this->defuncion_paciente = $valor;
    }
    
    public function registrar_funeraria($cedula_bitacora,$modulo){
        try {
                      
            if($this->existe_codigo($this->codigo_registro)){
                http_response_code(400);
                return "Este registro ya existe!!";
            }
            
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO funeraria(id_solicitudes,ente,defuncion_paciente) VALUES (:solicitudes,:ente,:defuncion_paciente)";

            $stmt = $bd->prepare($sql);
            
            $stmt->execute(array(

                ":solicitudes" => $this->codigo_registro,
                ":ente" => $this->ente,
                ":defuncion_paciente" => $this->defuncion_paciente
            ));

            $accion= "Ha registrado una solicitud de Funeraria";

            parent::registrar_bitacora($cedula_bitacora, $accion, $modulo);

            http_response_code(200);
            return "registro exitoso";
            
        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
    }

    public function listar_solicitudes(){

        try{
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT a.id, b.id as id_solicitudes, a.ente, a.defuncion_paciente, b.codigo_registro, b.id_trabajadores, b.nombre_solicitante, b.cedula_solicitante, b.tipo_solicitud, b.telefono_solicitante, c.nombre, c.cedula from funeraria a INNER JOIN solicitudes b ON a.id_solicitudes = b.id INNER JOIN trabajadores c ON b.id_trabajadores = c.id";
            
            $stmt = $bd->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
        
    }

   public function modificar_funeraria($cedula_bitacora,$modulo){
        try {
            
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           
            $sql = "UPDATE funeraria SET ente = :ente, defuncion_paciente = :defuncion_paciente WHERE id = :id";

            $stmt = $bd->prepare($sql);

            $stmt->execute(array(
                ":ente" => $this->ente,
                ":defuncion_paciente" => $this->defuncion_paciente,
                ":id" => $this->id
            ));

            $accion= "Ha modificado una solicitud de Funeraria";

            parent::registrar_bitacora($cedula_bitacora, $accion, $modulo);

            http_response_code(200);
            return "Modificación con exito";
        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
    }

    public function eliminar_registro($cedula_bitacora,$modulo){
        try {

            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "DELETE FROM funeraria WHERE id = :id";

            $stmt = $bd->prepare($sql);

            $stmt->execute(array(
                ":id" => $this->id
            ));

            $accion= "Ha eliminado una solicitud de Funeraria";

            parent::registrar_bitacora($cedula_bitacora, $accion, $modulo);

            http_response_code(200);
            return "eliminacion con exito";
            
        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
    }

    private function existe_codigo($codigo_registro){
        try {
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM funeraria WHERE id_solicitudes = :solicitudes";

            $stmt = $bd->prepare($sql);

            $stmt->execute(array(
                ":solicitudes" => $codigo_registro,
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

    public function consulta_solicitudes(){

        try{

            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT id,codigo_registro, nombre_solicitante, tipo_solicitud from solicitudes where tipo_solicitud = 'funeraria'";

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