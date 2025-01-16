<?php 

    require_once("conexion.php");
    class ExpedienteModelo extends conexion{

    private $id;
    private $trabajador;
    private $fecha_registro;
    private $expediente;

    
    public function set_id($valor){
        $this->id = $valor;
    }
    public function set_trabajador($valor){
        $this->trabajador = $valor;
    }    
    public function set_fecha_registro($valor){
        $this->fecha_registro = $valor;
    }
    public function set_expediente($valor){
        $this->expediente = $valor;
    }
    
    public function registrar_expediente(){
        try {

            /*if(

                !$this->evaluar_caracteres("/^[A-Za-z0-9áéíóúÁÉÍÓÚñÑ\s]{1,100}$/",$this->ente)||
                !$this->evaluar_caracteres("/^[A-Za-z0-9áéíóúÁÉÍÓÚñÑ\s]{1,100}$/",$this->descripcion_solicitud)||
                !$this->evaluar_caracteres("/^[A-Za-z0-9áéíóúÁÉÍÓÚñÑ\s]{1,100}$/",$this->patologia)
                
            ){
            	http_response_code(400);
                return "Caraceteres inválidos";
            }
                      
            if($this->existe_codigo($this->codigo_registro)){
                http_response_code(400);
                return "Este registro ya existe!!";
            }*/

            
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO expedientes(id_trabajadores,fecha_registro,nombre_foto) VALUES ('$trabajador','$fecha_registro','$expediente')";

            /*$stmt = $bd->prepare($sql);
            
            $stmt->execute(array(

                ":trabajadores" => $this->trabajador,
                ":fecha_registro" => $this->fecha_registro,
                ":nombre_foto" => $this->expediente
            ));*/

            $sql_query = mysqli_query($bd,$sql);

            http_response_code(200);
            return "registro exitoso";
            
        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
    }

    public function listar_expediente(){

        try{
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT a.id, b.id as id_trabajadores, a.fecha_registro, a.expediente, b.nombre, b.cedula, b.unidad_organizativa from expediente a INNER JOIN trabajadores b ON a.id_trabajadores = b.id";
            
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

            $sql = "DELETE FROM farmacia WHERE id = :id";

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

    public function consulta_trabajadores(){

        try{

            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT id,nombre, cedula, unidad_organizativa from trabajadores";

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