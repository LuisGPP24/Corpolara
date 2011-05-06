<?php 

    namespace modelo;

    use modelo\conexion as conexion;
    use PDO;
    use PDOException;
    
    class bitacoraModelo extends conexion{

        
    public function listar_bitacora(){

        try{
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);          

            $sql = "SELECT a.accion, DATE_FORMAT(a.fecha_registro, '%d/%m/%Y') as fecha_registro, TIME_FORMAT(a.hora_registro, '%r') as hora_registro, b.nombre as nombre_modulo, c.nombre as nombre_usuario, c.cedula from bitacora a INNER JOIN modulos b ON a.id_modulos = b.id INNER JOIN usuarios c ON a.cedula_usuario = c.cedula";
            
            $stmt = $bd->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }        
    }

    public function vaciar_bitacora($cedula_bitacora,$id_modulo){
        
        try{
            $co = $this->conecta();
            $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            
           $stmt = $co->prepare("TRUNCATE TABLE bitacora;");

            $stmt->execute();
            
            $rowCount = $stmt->rowCount();

                
            header('Content-Type: text/plain');
                
            if ($rowCount == 0) {
                
                $accion= "Ha vaciado la tabla de bitácoras";

                parent::registrar_bitacora($cedula_bitacora, $accion, $id_modulo);    
                
                http_response_code(200);
                return 'Tabla vaciada correcctamente';
            }else{
                    
                http_response_code(500);
                return 'Error al vaciar la tabla';
            }

        }catch(Exception $e) {
            header('Content-Type: text/plain');
            http_response_code(500);
            return $e->getMessage();
        }
    }
}
?>