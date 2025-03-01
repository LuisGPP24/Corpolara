<?php 

    namespace modelo;

    use modelo\conexion as conexion;
    use PDO;
    use PDOException;
    
    class facturasModelo extends conexion{

    private $id;
    private $codigo_registro;
    private $numero_factura;
    private $descripcion;
    private $monto;
    
    public function set_id($valor){
        $this->id = $valor;
    }
    public function set_codigo_registro($valor){
        $this->codigo_registro = $valor;
    }    
    public function set_numero_factura($valor){
        $this->numero_factura = $valor;
    }
    public function set_descripcion($valor){
        $this->descripcion = $valor;
    }
    public function set_monto($valor){
        $this->monto = $valor;
    }
    
    public function registrar_factura($cedula_bitacora,$modulo){
        try {

            if(

                !$this->evaluar_caracteres("/^[0-9]{1,20}$/",$this->codigo_registro)
                
            ){
            	http_response_code(400);
                return "Caraceteres inválidos";
            }
                      
            if($this->existe_factura($this->numero_factura)){
                http_response_code(400);
                return "Este numero de factura ya existe!!";
            }

            
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO facturas(id_solicitudes,numero_factura,descripcion,monto) VALUES (:solicitudes,:numero_factura,:descripcion,:monto)";

            $stmt = $bd->prepare($sql);
            
            $stmt->execute(array(

                ":solicitudes" => $this->codigo_registro,
                ":numero_factura" => $this->numero_factura,
                ":descripcion" => $this->descripcion,
                ":monto" => $this->monto
            ));

            $accion= "Ha registrado una nueva Factura";

            parent::registrar_bitacora($cedula_bitacora, $accion, $modulo);

            http_response_code(200);
            return "Registro exitoso";
            
        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
    }

    public function listar_facturas(){

        try{
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT a.id, b.id as id_solicitudes, a.numero_factura, a.descripcion, a.monto, b.nombre_solicitante, b.cedula_solicitante, b.codigo_registro  from facturas a INNER JOIN solicitudes b ON a.id_solicitudes = b.id";
            
            $stmt = $bd->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
        
    }

   public function modificar_factura($cedula_bitacora,$modulo){
        try {
            
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           
            $sql = "UPDATE facturas SET numero_factura = :numero_factura, descripcion = :descripcion, monto = :monto WHERE id = :id";

            $stmt = $bd->prepare($sql);

            $stmt->execute(array(
                ":numero_factura" => $this->numero_factura,
                ":descripcion" => $this->descripcion,
                ":monto" => $this->monto,
                ":id" => $this->id,
            ));

            $accion= "Ha modificado una Factura";

            parent::registrar_bitacora($cedula_bitacora, $accion, $modulo);

            http_response_code(200);
            return "Modificación con exito";
        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
    }

    public function eliminar_factura($cedula_bitacora,$modulo){
        try {
            /*if(!$this->evaluar_caracteres("/^[0-9]{7,8}$/", $this->cedula)){
                http_response_code(400);
                return "Caracteres inválidos";
            }*/

            /*if (!$this->existe_codigo($this->codigo_registro)){
                http_response_code(400);
                return "Este Registro No existe";
            }*/

            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "DELETE FROM facturas WHERE id = :id";

            $stmt = $bd->prepare($sql);

            $stmt->execute(array(
                ":id" => $this->id
            ));

            $accion= "Ha eliminado una Factura";

            parent::registrar_bitacora($cedula_bitacora, $accion, $modulo);

            http_response_code(200);
            return "eliminacion con exito";
            
        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
    }

    private function existe_factura($numero_factura){
        try {
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM facturas WHERE numero_factura = :numero_factura";

            $stmt = $bd->prepare($sql);

            $stmt->execute(array(
                ":numero_factura" => $numero_factura
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

            $sql = "SELECT id,codigo_registro, nombre_solicitante, tipo_solicitud from solicitudes where tipo_solicitud = 'reembolso'";

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