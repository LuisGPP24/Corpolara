<?php 

    namespace modelo;

    use modelo\conexion as conexion;
    use PDO;
    use PDOException;
    class permisosModelo extends conexion{

    private $id;
    private $nombre;
    private $descripcion;
    private $id_rol;
    private $permisos;

    public function set_permisos($valor){
        $this->permisos = $valor;
    }
    public function set_id_rol($valor){
        $this->id_rol = $valor;
    }
    public function set_id($valor){
        $this->id = $valor;
    }    
    public function set_nombre($valor){
        $this->nombre = $valor;
    }
    public function set_descripcion($valor){
        $this->descripcion = $valor;
    }

    public function registrar_roles($cedula_bitacora,$id_modulo){
        try {

            if(

                !$this->evaluar_caracteres("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,50}$/", $this->nombre)
                
            ){
            	http_response_code(400);
                return "¡¡Coloque un nombre!!";
            }

            if(

                !$this->evaluar_caracteres("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{2,50}$/", $this->descripcion)
                
            ){
                http_response_code(400);
                return "¡¡Coloque una descripcion!!";
            }
            
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $bd->beginTransaction();

            $modulos = $this->getModulos();

            if(!$modulos){
                $bd->rollBack();
                http_response_code(500);
                return "No se pudo obtener los modulos";
            }
        
            $sql = "INSERT INTO roles(nombre,descripcion) VALUES (:nombre,:descripcion)";

            $stmt = $bd->prepare($sql);
            
            $stmt->execute(array(

                ":nombre" => $this->nombre,
                ":descripcion" => $this->descripcion

            ));

            $id_rol = $bd->lastInsertId();

            $sql = "INSERT INTO permisos(id_rol,id_modulos,acceso) VALUES (:id_rol,:id_modulos,:acceso)";
            $stmt = $bd->prepare($sql);
            
            foreach($modulos as $modulos){
                $stmt->execute(array(
                    ":id_rol" => $id_rol,
                    ":id_modulos" => $modulos["id"],
                    ":acceso" => 0
                ));
            }

            $accion= "Ha registrado un nuevo permiso";

            parent::registrar_bitacora($cedula_bitacora, $accion, $id_modulo);

            $bd->commit();            

            http_response_code(200);
            return "registro exitoso";

        } catch (PDOException $e) {
            $bd->rollBack();
            http_response_code(500);
            return $e->getMessage();
        }
    }

    public function getModulos(){
        try {
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * from modulos";

            $stmt = $bd->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
    }

    public function listar_roles(){

        try{
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * from roles";
            

            $stmt = $bd->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
        
    }

   public function modificar_rol($cedula_bitacora,$id_modulo){
        try {

            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           
            $sql = "UPDATE roles SET nombre = :nombre, descripcion = :descripcion WHERE id = :id";

            $stmt = $bd->prepare($sql);

            $stmt->execute(array(

                ":nombre" => $this->nombre,
                ":descripcion" => $this->descripcion,
                ":id" => $this->id
            ));

            $accion= "Ha modificado un permiso";

            parent::registrar_bitacora($cedula_bitacora, $accion, $id_modulo);

            http_response_code(200);
            return "Modificación con exito";
        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
    }

    public function eliminar_rol($cedula_bitacora,$id_modulo){
        try {

            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "DELETE FROM roles WHERE id = :id";

            $stmt = $bd->prepare($sql);

            $stmt->execute(array(
                ":id" => $this->id
            ));

            $accion= "Ha eliminado un permiso";

            parent::registrar_bitacora($cedula_bitacora, $accion, $id_modulo);

            http_response_code(200);
            return "eliminacion con exito";
            
        } catch (PDOException $e) {
            http_response_code(500);
            switch ($e->getCode()) {
                case '23000':
                    return "No se puede eliminar este rol porque usuarios lo tienen incorporado";
                    break;
                
                default:
                    return $e->getMessage();
                    break;
            }
            //return $e->getMessage();
        }
    }
   
    private function evaluar_caracteres($regex, $valor){
        $valor = trim($valor);
        $matches = preg_match_all($regex, $valor);

        return $matches > 0;
    }

    public function lista_permisos(){
        try {

            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * from modulos";


            $stmt = $bd->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
    }
    
    public function consulta_accesos(){
        try{

            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT id_modulos,acceso from permisos where id_rol = :id_rol";


            $stmt = $bd->prepare($sql);

            $stmt->execute([
                "id_rol" => $this->id_rol
            ]);

            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $dataJson = json_encode($resultado);
            
            return $dataJson;

        } catch (PDOException $e) {
            http_response_code(500);
            return json_encode($e->getMessage());
        }
    }

    public function guardar_permisos($cedula_bitacora,$id_modulo){
        
        try{
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $bd->beginTransaction();


            $sql = "SELECT id_modulos,acceso from permisos where id_rol = :id_rol";


            $stmt = $bd->prepare($sql);

            $stmt->execute([
                "id_rol" => $this->id_rol
            ]);

            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if(!$resultado){
                $bd->rollBack();
                http_response_code(500);
                return "No se pudo obtener los permisos de este rol";
            }

            $newPermisos = array();

            foreach ($this->permisos as $permiso) {
                foreach ($resultado as $actual) {

                    if ($permiso["id"] == $actual["id_modulos"] && $permiso["acceso"] != $actual["acceso"]) {
                        $newPermisos[] = $permiso;
                    }
                }
            }
            // Si hay cambios, actualizar en la base de datos
            if (!empty($newPermisos)) {
                $sql = "UPDATE permisos SET acceso = :acceso WHERE id_modulos = :id_modulos AND id_rol = :id_rol";
                $stmt = $bd->prepare($sql);

                foreach ($newPermisos as $permiso) {
                    $stmt->execute([
                        "acceso" => $permiso["acceso"],
                        "id_modulos" => $permiso["id"],
                        "id_rol" => $this->id_rol
                    ]);
                }
            }
            $bd->commit();

            $accion= "Ha actualizado los accesos de un permiso";

            parent::registrar_bitacora($cedula_bitacora, $accion, $id_modulo);

            http_response_code(200);
            return "permisos actualizados";

        } catch (PDOException $e) {
            $bd->rollBack();
            http_response_code(500);
            return $e->getMessage();
        }
    }


}
?>