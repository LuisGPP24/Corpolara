<?php 

    namespace modelo;

    use modelo\conexion as conexion;
    use PDO;
    use PDOException;
    
    class ExpedientesModelo extends conexion{

    private $id;
    private $cedula;
    private $trabajador;
    private $fecha_registro;
    private $expediente;
    
    public function set_id($valor){
        $this->id = $valor;
    }
    public function set_cedula($valor){
        $this->cedula = $valor;
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
    
    public function registrar_expediente($cedula_bitacora,$id_modulo) {
    try {

        if (!$this->evaluar_caracteres("/^[A-Za-z0-9áéíóúÁÉÍÓÚñÑs]{1,100}$/", $this->trabajador)) {
            http_response_code(400);
            return "Elija a un trabajador";
        }

        if(

        !$this->evaluar_caracteres("/^(19|20)(((([02468][048])|([13579][26]))-02-29)|(\d{2})-((02-((0[1-9])|1\d|2[0-8]))|((((0[13456789])|1[012]))-((0[1-9])|((1|2)\d)|30))|(((0[13578])|(1[02]))-31)))$/",$this->fecha_registro)
        ){
            http_response_code(400);
            return "Coloque una fecha valida";
        }

        
        if ($this->existe_registro($this->trabajador)) {
            http_response_code(400);
            return "El registro de este trabajador ya existe!!";
        }


        
        if (!empty($this->expediente) ) {
            
            if($this->expediente['size'] === 0) {
                http_response_code(400);
                return "El campo archivo está vacío";
            }else{
                
                $bd = $this->conecta();
                $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                
                $sql = "INSERT INTO expedientes(id_trabajadores, fecha_registro) VALUES (:trabajador, :fecha_registro)";
                $stmt = $bd->prepare($sql);
                $stmt->execute(array(
                    ":trabajador" => $this->trabajador,
                    ":fecha_registro" => $this->fecha_registro
                ));
                move_uploaded_file($this->expediente['tmp_name'], 'assets/expedientes/' . $this->expediente['name'] );
            }
            
        } else{
            http_response_code(400);
            return "No se ha seleccionado ningún archivo";
        }

        $accion= "Ha registrado un nuevo expediente";

        parent::registrar_bitacora($cedula_bitacora, $accion, $id_modulo);

        http_response_code(200);
        return "Registro exitoso";

    } catch (PDOException $e) {
        http_response_code(500);
        return $e->getMessage();
    }
}

    
    public function listar_expediente(){

        try{
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT a.id, b.id as id_trabajadores, a.fecha_registro, b.nombre, b.cedula, b.unidad_organizativa from expedientes a INNER JOIN trabajadores b ON a.id_trabajadores = b.id";
            
            $stmt = $bd->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
        
    }

    public function eliminar_registro($cedula_bitacora,$id_modulo){
        try {

            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "DELETE FROM expedientes WHERE id = :id";

            $stmt = $bd->prepare($sql);

            $stmt->execute(array(
                ":id" => $this->id
            ));

            $accion= "Ha eliminado un expediente";

            parent::registrar_bitacora($cedula_bitacora, $accion, $id_modulo);

            $cedula = $this->cedula;

            if (!unlink("assets/expedientes/expediente-$cedula.pdf")) {
                http_response_code(400);
                return "Fallo en eliminar";
            }
            
            http_response_code(200);
            return "El expediente fue eliminado con éxito";
            
        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
    }

    private function existe_registro($trabajador){
        try {
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM expedientes WHERE id_trabajadores = :trabajador";

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


        }catch(PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
    }
}
?>