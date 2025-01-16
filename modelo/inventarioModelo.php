<?php 

    require_once("conexion.php");
    class InventarioModelo extends conexion{

    private $id;
    private $codigo;
    private $insumo;
    private $cantidad;
    private $fecha;

    public function set_id($valor){
        $this->id = $valor;
    }
    public function set_codigo($valor){
        $this->codigo = $valor;
    }
    public function set_insumo($valor){
        $this->insumo = $valor;
    }
    public function set_cantidad($valor){
        $this->cantidad = $valor;
    }
    public function set_fecha($valor){
        $this->fecha = $valor;
    }

    public function registrar_insumo(){
        try {

            /*if(
                !$this->evaluar_caracteres("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,50}$/",$this->personal_contratado)||
                !$this->evaluar_caracteres("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,50}$/",$this->unidad_organizativa)||
                !$this->evaluar_caracteres("/^[0-9]{7,8}$/",$this->cedula)||
                !$this->evaluar_caracteres("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,30}$/",$this->nombre)||
                !$this->evaluar_caracteres("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,30}$/",$this->pais)||
                !$this->evaluar_caracteres("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,50}$/",$this->estado)||
                !$this->evaluar_caracteres("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,50}$/",$this->municipio)||
                !$this->evaluar_caracteres("/^[0-9]{1,20}$/",$this->telefono)||
                !$this->evaluar_caracteres("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/",$this->correo)||
                !$this->evaluar_caracteres("/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ#.,\s]{1,50}$/",$this->direccion)||
                !$this->evaluar_caracteres("/^[0-9]{1,30}$/",$this->cuenta)||
                !$this->evaluar_caracteres("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,50}$/",$this->profesion)||
                !$this->evaluar_caracteres("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,20}$/",$this->genero)||
                !$this->evaluar_caracteres("/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ]{1,20}$/",$this->talla_camisa)||
                !$this->evaluar_caracteres("/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ]{1,20}$/",$this->talla_calzado)||
                !$this->evaluar_caracteres("/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ]{1,20}$/",$this->talla_pantalon)||
                !$this->evaluar_caracteres("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ$#*.,+\s]{1,20}$/",$this->tipo_sangre)||
                !$this->evaluar_caracteres("/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ$#*.,\s]{1,20}$/",$this->vacunas)||
                !$this->evaluar_caracteres("/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ$#*.,\s]{1,20}$/",$this->covid)
            ){
            	http_response_code(400);
                return "Caracteres inválidos";
            }*/

            if($this->existe_insumo($this->codigo)){
                http_response_code(400);
                return "El código ya existe";
            }

            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO inventario (codigo_insumo,nombre_insumo,cantidad,fecha_caducidad) VALUES (:codigo_insumo, :nombre_insumo,:cantidad,:fecha_caducidad)";

            $stmt = $bd->prepare($sql);
            
            $stmt->execute(array(
                ":codigo_insumo" => $this->codigo,
                ":nombre_insumo" => $this->insumo,
                ":cantidad" => $this->cantidad,
                ":fecha_caducidad" => $this->fecha
            ));

            http_response_code(200);
            return "registro exitoso";
            
        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
    }

    public function listar_insumos(){

        try{
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM inventario";

            $stmt = $bd->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
        
    }

    public function modificar_insumo(){
        try {
            /*if (
                !$this->evaluar_caracteres("/^[0-9]{7,8}$/", $this->cedula) ||
                !$this->evaluar_caracteres("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,50}$/", $this->nombre) ||
                !$this->evaluar_caracteres("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $this->correo)
            ) {
                http_response_code(400);
                return "Caracteres inválidos";
            }*/

            if (!$this->existe_insumo($this->codigo)) {
                http_response_code(400);
                return "El insumo no existe";
            }
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "UPDATE inventario SET codigo_insumo = :codigo_insumo, nombre_insumo = :nombre, cantidad = :cantidad,  fecha_caducidad = :fecha_caducidad WHERE id = :id";

            $stmt = $bd->prepare($sql);

            $stmt->execute(array(
                ":codigo_insumo" => $this->codigo,
                ":nombre" => $this->insumo,
                ":cantidad" => $this->cantidad,
                ":fecha_caducidad" => $this->fecha,
                ":id" => $this->id
                
            ));

            http_response_code(200);
            return "Modificación con exito";
        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
    }

    public function eliminar_insumo(){
        try {
            /*if(!$this->evaluar_caracteres("/^[0-9]{7,8}$/", $this->cedula)){
                http_response_code(400);
                return "Caracteres inválidos";
            }

            if (!$this->existe_trabajador($this->cedula)){
                http_response_code(400);
                return "Usuario No existe";
            }*/

            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "DELETE FROM inventario WHERE id = :id";

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

    private function existe_insumo($codigo){
        try {
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM inventario WHERE codigo_insumo = :codigo";

            $stmt = $bd->prepare($sql);

            $stmt->execute(array(
                ":codigo" => $codigo,
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

    }

?>