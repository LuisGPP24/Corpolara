<?php 

    namespace modelo;

    use modelo\conexion as conexion;
    use PDO;
    use PDOException;
    
    class salidaInsumosModelo extends conexion{

    private $id;
    private $fecha;
    private $insumo;
    private $trabajador;
    private $cantidad;
    private $entregado;
    
    public function set_id($valor){
        $this->id = $valor;
    }
    public function set_fecha($valor){
        $this->fecha = $valor;
    }    
    public function set_insumo($valor){
        $this->insumo = $valor;
    }
    public function set_trabajador($valor){
        $this->trabajador = $valor;
    }
    public function set_cantidad($valor){
        $this->cantidad = $valor;
    }
    public function set_entregado($valor){
        $this->entregado = $valor;
    }
    
    public function registrar_salida(){
        try {

            if(

                !$this->evaluar_caracteres("/^[A-Za-z0-9áéíóúÁÉÍÓÚñÑ\s]{1,100}$/",$this->trabajador)||
                !$this->evaluar_caracteres("/^[A-Za-z0-9áéíóúÁÉÍÓÚñÑ\s]{1,100}$/",$this->insumo)||
                !$this->evaluar_caracteres("/^[0-9]{1,20}$/",$this->cantidad)
                
            ){
            	http_response_code(400);
                return "Caraceteres inválidos";
            }                    
                        
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO salida_insumos (id_trabajadores, id_inventario, fecha, cantidad, entregado_por) VALUES (:trabajadores,:inventario,:fecha,:cantidad,:entregado)";

            $stmt = $bd->prepare($sql);
            
            $stmt->execute(array(

                ":trabajadores" => $this->trabajador,
                ":inventario" => $this->insumo,
                ":fecha" => $this->fecha,
                ":cantidad" => $this->cantidad,
                ":entregado" => $this->entregado

            ));

            $resultado_descuento = $this->descontar_insumo($this->insumo, $this->cantidad);

            http_response_code(200);
            return "registro exitoso";
            
        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
    }

    public function listar_inventario(){

        try{
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT a.id, b.id as id_inventario, c.id as id_trabajadores, a.fecha, a.cantidad, a.entregado_por, b.nombre_insumo, c.nombre, c.cedula, c.unidad_organizativa from salida_insumos a INNER JOIN inventario b ON a.id_inventario = b.id INNER JOIN trabajadores c ON a.id_trabajadores = c.id";
            
            $stmt = $bd->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
        
    }

   public function modificar_farmacia(){
        try {
            /*if (
                !$this->evaluar_caracteres("/^[0-9]{7,8}$/", $this->cedula) ||
                !$this->evaluar_caracteres("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,50}$/", $this->nombre) ||
                !$this->evaluar_caracteres("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $this->correo)
            ) {
                http_response_code(400);
                return "Caracteres inválidos";
            }*/
            
            
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

            http_response_code(200);
            return "Modificación con exito";
        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
    }

    public function eliminar_registro(){
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

            $sql = "DELETE FROM salida_insumos WHERE id = :id";

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

    private function evaluar_caracteres($regex, $valor){
        $valor = trim($valor);
        $matches = preg_match_all($regex, $valor);

        return $matches > 0;
    }

    public function consulta_trabajadores(){

        try{

            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * from trabajadores";

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

    public function consulta_inventario(){

        try{

            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * from inventario";

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

    public function descontar_insumo($insumo,$cantidad){

        try{
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "UPDATE inventario SET cantidad = cantidad - :cantidad where id = :inventario";

            $stmt = $bd->prepare($sql);          

            $stmt->execute(array(

                ":inventario" => $this->insumo,
                ":cantidad" => $this->cantidad

            ));

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
        
    }

}
?>