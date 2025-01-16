<?php 

    require_once("conexion.php");
    class SolicitudesModelo extends conexion{

    private $id;
    private $codigo;
    private $numero_registro;
    private $trabajador;
    private $cedula;
    private $nombre;
    private $telefono;
    private $tipo_solicitud;
    private $sub_tipo_solicitud;
    private $estado_solicitud;
    private $descripcion;
    private $financiado;
    private $remitido;
    private $monto_solicitado;
    private $monto_aprobado;
    private $fecha_registro;
    private $condicion;
    private $estatus;
    private $observacion;

    public function set_id($valor){
        $this->id = $valor;
    }
    public function set_codigo($valor){
        $this->codigo = $valor;
    }
    public function set_numero_registro($valor){
        $this->numero_registro = $valor;
    }
    public function set_trabajador($valor){
        $this->trabajador = $valor;
    }
    public function set_cedula($valor){
        $this->cedula = $valor;
    }
    public function set_nombre($valor){
        $this->nombre = $valor;
    }
    public function set_telefono($valor){
        $this->telefono = $valor;
    }
    public function set_tipo_solicitud($valor){
        $this->tipo_solicitud = $valor;
    }
    public function set_sub_tipo_solicitud($valor){
        $this->sub_tipo_solicitud = $valor;
    }
    public function set_estado_solicitud($valor){
        $this->estado_solicitud = $valor;
    }
    public function set_descripcion($valor){
        $this->descripcion = $valor;
    }
    public function set_financiado($valor){
        $this->financiado = $valor;
    }
    public function set_remitido($valor){
        $this->remitido = $valor;
    }
    public function set_monto_solicitado($valor){
        $this->monto_solicitado = $valor;
    }
    public function set_monto_aprobado($valor){
        $this->monto_aprobado = $valor;
    }
    public function set_fecha_registro($valor){
        $this->fecha_registro = $valor;
    }
    public function set_condicion($valor){
        $this->condicion = $valor;
    }
    public function set_estatus($valor){
        $this->estatus = $valor;
    }
    public function set_observacion($valor){
        $this->observacion = $valor;
    }

    public function registrar_solicitud(){
        try {

            if(

                !$this->evaluar_caracteres("/^[0-9\b]{1,50}$/",$this->trabajador)||
                !$this->evaluar_caracteres("/^[0-9\b]{1,50}$/",$this->codigo)||
                !$this->evaluar_caracteres("/^[0-9\b]{1,50}$/",$this->numero_registro)
                
            ){
            	http_response_code(400);
                return "Caraceteres inválidos";
            }

            
            if($this->existe_codigo($this->codigo)){
                http_response_code(400);
                return "Este codigo de solicitud ya existe!!";
            }

            if($this->existe_registro($this->numero_registro)){
                http_response_code(400);
                return "Este numero de registro ya existe!!";
            }

            
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO solicitudes(codigo_registro,numero_registro,id_trabajadores,cedula_solicitante,nombre_solicitante,telefono_solicitante,tipo_solicitud,sub_tipo_solicitud,estado_solicitud,descripcion_solicitud,financiado,remitido,monto,monto_aprobado,fecha_registro,condicion,estatus,observacion) VALUES (:codigo,:numero_registro,:trabajador,:cedula,:nombre,:telefono,:tipo_solicitud,:sub_tipo_solicitud,:estado_solicitud,:descripcion,:financiado,:remitido,:monto_solicitado,:monto_aprobado,:fecha_registro,:condicion,:estatus,:observacion)";

            $stmt = $bd->prepare($sql);
            
            $stmt->execute(array(

                ":codigo" => $this->codigo,
                ":numero_registro" => $this->numero_registro,
                ":trabajador" => $this->trabajador,
                ":cedula" => $this->cedula,                               
                ":nombre" => $this->nombre,
                ":telefono" => $this->telefono,
                ":tipo_solicitud" => $this->tipo_solicitud,
                ":sub_tipo_solicitud" => $this->sub_tipo_solicitud,
                ":estado_solicitud" => $this->estado_solicitud,
                ":descripcion" => $this->descripcion,
                ":financiado" => $this->financiado,
                ":remitido" => $this->remitido,
                ":monto_solicitado" => $this->monto_solicitado,
                ":monto_aprobado" => $this->monto_aprobado,
                ":fecha_registro" => $this->fecha_registro,
                ":condicion" => $this->condicion,
                ":estatus" => $this->estatus,
                ":observacion" => $this->observacion

            ));

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

            $sql = "SELECT a.id,
                b.id as id_trabajadores,
                a.codigo_registro, a.numero_registro, a.cedula_solicitante, a.nombre_solicitante,
                a.telefono_solicitante, a.tipo_solicitud ,a.sub_tipo_solicitud,a.estado_solicitud,a.descripcion_solicitud,a.financiado,a.remitido,a.monto,a.monto_aprobado,a.fecha_registro,a.condicion,a.estatus,a.observacion,b.nombre from solicitudes a INNER JOIN trabajadores b ON a.id_trabajadores = b.id";
            

            $stmt = $bd->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
        
    }

   public function modificar_solicitud(){
        try {
            /*if (
                !$this->evaluar_caracteres("/^[0-9]{7,8}$/", $this->cedula) ||
                !$this->evaluar_caracteres("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,50}$/", $this->nombre) ||
                !$this->evaluar_caracteres("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $this->correo)
            ) {
                http_response_code(400);
                return "Caracteres inválidos";
            }
            
            if (!$this->existe_antecedentes($this->trabajador)) {
                http_response_code(400);
                return "Los antecedentes no existen";
            }*/

            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           
            $sql = "UPDATE solicitudes SET cedula_solicitante = :cedula, nombre_solicitante = :nombre, telefono_solicitante = :telefono, tipo_solicitud = :tipo_solicitud, sub_tipo_solicitud = :sub_tipo_solicitud, estado_solicitud = :estado_solicitud, descripcion_solicitud = :descripcion, financiado = :financiado, remitido = :remitido, monto = :monto_solicitado, monto_aprobado = :monto_aprobado, fecha_registro = :fecha_registro, condicion = :condicion, estatus = :estatus, observacion = :observacion WHERE id = :id";

            $stmt = $bd->prepare($sql);

            $stmt->execute(array(
                ":cedula" => $this->cedula,
                ":nombre" => $this->nombre,
                ":telefono" => $this->telefono,
                ":tipo_solicitud" => $this->tipo_solicitud,
                ":sub_tipo_solicitud" => $this->sub_tipo_solicitud,
                ":estado_solicitud" => $this->estado_solicitud,
                ":descripcion" => $this->descripcion,
                ":financiado" => $this->financiado,
                ":remitido" => $this->remitido,
                ":monto_solicitado" => $this->monto_solicitado,
                ":monto_aprobado" => $this->monto_aprobado,
                ":fecha_registro" => $this->fecha_registro,
                ":condicion" => $this->condicion,
                ":estatus" => $this->estatus,
                ":observacion" => $this->observacion,
                ":id" => $this->id,
            ));

            http_response_code(200);
            return "Modificación con exito";
        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
    }

    public function eliminar_solicitud(){
        try {
            /*if(!$this->evaluar_caracteres("/^[0-9]{7,8}$/", $this->cedula)){
                http_response_code(400);
                return "Caracteres inválidos";
            }*/

            /*if (!$this->existe_codigo($this->codigo)){
                http_response_code(400);
                return "Esta Solicitud No existe";
            }*/

            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "DELETE FROM solicitudes WHERE id = :id";

            $stmt = $bd->prepare($sql);

            $stmt->execute(array(
                ":id" => $this->id
            ));

            http_response_code(200);
            return "eliminacion con exito";
            
        } catch (PDOException $e) {
            http_response_code(500);
            switch ($e->getCode()) {
                case '23000':
                    return "No se puede eliminar este registro por tener información en otros modulos";
                    break;
                
                default:
                    return $e->getMessage();
                    break;
            }
            //return $e->getMessage();
        }
    }

    private function existe_codigo($codigo){
        try {
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM solicitudes WHERE codigo_registro = :codigo";

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

    private function existe_registro($numero_registro){
        try {
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM solicitudes WHERE numero_registro = :numero_registro";

            $stmt = $bd->prepare($sql);

            $stmt->execute(array(
                ":numero_registro" => $numero_registro,
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


        }catch(Exception $e) {
            http_response_code(500);
            return $e->getMessage();
        }
    }
}
?>