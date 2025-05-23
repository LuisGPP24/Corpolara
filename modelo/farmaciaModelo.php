<?php 

    namespace modelo;

    use modelo\conexion as conexion;
    use PDO;
    use PDOException;
    
    class FarmaciaModelo extends conexion{

    private $id;
    private $codigo_registro;
    private $ente;
    private $descripcion_solicitud;
    private $fecha_nacimiento;
    private $parentesco;
    private $patologia;
    private $proveedor;
    
    public function set_id($valor){
        $this->id = $valor;
    }
    public function set_codigo_registro($valor){
        $this->codigo_registro = $valor;
    }    
    public function set_ente($valor){
        $this->ente = $valor;
    }
    public function set_descripcion_solicitud($valor){
        $this->descripcion_solicitud = $valor;
    }
    public function set_fecha_nacimiento($valor){
        $this->fecha_nacimiento = $valor;
    }
    public function set_parentesco($valor){
        $this->parentesco = $valor;
    }
    public function set_patologia($valor){
        $this->patologia = $valor;
    }
    public function set_proveedor($valor){
        $this->proveedor = $valor;
    }
    
    public function registrar_farmacia($cedula_bitacora,$id_modulo){
        try {
                      
            if($this->existe_codigo($this->codigo_registro)){
                http_response_code(400);
                return "Este registro ya existe!!";
            }

            
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO farmacia(id_solicitudes,ente,descripcion_solicitud,fecha_nacimiento,parentesco,patologia,proveedor) VALUES (:solicitudes,:ente,:descripcion_solicitud,:fecha_nacimiento,:parentesco,:patologia,:proveedor)";

            $stmt = $bd->prepare($sql);
            
            $stmt->execute(array(

                ":solicitudes" => $this->codigo_registro,
                ":ente" => $this->ente,
                ":descripcion_solicitud" => $this->descripcion_solicitud,
                ":fecha_nacimiento" => $this->fecha_nacimiento,
                ":parentesco" => $this->parentesco,
                ":patologia" => $this->patologia,
                ":proveedor" => $this->proveedor

            ));

            $accion= "Ha registrado una solicitud de farmacia";

            parent::registrar_bitacora($cedula_bitacora, $accion, $id_modulo);

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

            $sql = "SELECT a.id, b.id as id_solicitudes, a.ente, a.descripcion_solicitud, a.patologia, a.fecha_nacimiento, a.parentesco, a.proveedor, b.codigo_registro, b.id_trabajadores, b.nombre_solicitante, b.cedula_solicitante, b.fecha_registro, b.tipo_solicitud, b.telefono_solicitante, c.nombre, c.cedula from farmacia a INNER JOIN solicitudes b ON a.id_solicitudes = b.id INNER JOIN trabajadores c ON b.id_trabajadores = c.id";
            
            $stmt = $bd->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
        
    }

   public function modificar_farmacia($cedula_bitacora,$id_modulo){
        try {
            
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           
            $sql = "UPDATE farmacia SET ente = :ente, descripcion_solicitud = :descripcion_solicitud, fecha_nacimiento = :fecha_nacimiento, parentesco = :parentesco, patologia = :patologia, proveedor = :proveedor WHERE id = :id";

            $stmt = $bd->prepare($sql);

            $stmt->execute(array(
                ":ente" => $this->ente,
                ":descripcion_solicitud" => $this->descripcion_solicitud,
                ":fecha_nacimiento" => $this->fecha_nacimiento,
                ":parentesco" => $this->parentesco,
                ":patologia" => $this->patologia,
                ":proveedor" => $this->proveedor,
                ":id" => $this->id,
            ));

            $accion= "Ha modificado una solicitud de farmacia";

            parent::registrar_bitacora($cedula_bitacora, $accion, $id_modulo);

            http_response_code(200);
            return "Modificación con exito";
        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
    }

    public function eliminar_registro($cedula_bitacora,$id_modulo){
        try {

            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "DELETE FROM farmacia WHERE id = :id";

            $stmt = $bd->prepare($sql);

            $stmt->execute(array(
                ":id" => $this->id
            ));

            $accion= "Ha eliminado una solicitud de farmacia";

            parent::registrar_bitacora($cedula_bitacora, $accion, $id_modulo);

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

            $sql = "SELECT * FROM farmacia WHERE id_solicitudes = :solicitudes";

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

            $sql = "SELECT id,codigo_registro, nombre_solicitante, tipo_solicitud from solicitudes where tipo_solicitud = 'farmacia'";

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