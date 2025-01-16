<?php 

    require_once("conexion.php");
    class trabajadoresModelo extends conexion{

    private $id;
    private $fecha_registro;
    private $personal_contratado;
    private $unidad_organizativa;
    private $cedula;
    private $nombre;
    private $fecha_nacimiento;
    private $pais;
    private $estado;
    private $municipio;
    private $telefono;
    private $correo;
    private $direccion;
    private $cuenta;
    private $profesion;
    private $genero;
    private $talla_camisa;
    private $talla_calzado;
    private $talla_pantalon;
    private $tipo_sangre;
    private $vacunas;
    private $covid;

    public function set_id($valor){
        $this->id = $valor;
    }
    public function set_fecha_registro($valor){
        $this->fecha_registro = $valor;
    }
    public function set_personal_contratado($valor){
        $this->personal_contratado = $valor;
    }
    public function set_unidad_organizativa($valor){
        $this->unidad_organizativa = $valor;
    }
    public function set_cedula($valor){
        $this->cedula = $valor;
    }
    public function set_nombre($valor){
        $this->nombre = $valor;
    }
    public function set_fecha_nacimiento($valor){
        $this->fecha_nacimiento = $valor;
    }
    public function set_pais($valor){
        $this->pais = $valor;
    }
    public function set_estado($valor){
        $this->estado = $valor;
    }
    public function set_municipio($valor){
        $this->municipio = $valor;
    }
    public function set_telefono($valor){
        $this->telefono = $valor;
    }
    public function set_correo($valor){
        $this->correo = $valor;
    }
    public function set_direccion($valor){
        $this->direccion = $valor;
    }
    public function set_cuenta($valor){
        $this->cuenta = $valor;
    }
    public function set_profesion($valor){
        $this->profesion = $valor;
    }
    public function set_genero($valor){
        $this->genero = $valor;
    }
    public function set_talla_camisa($valor){
        $this->talla_camisa = $valor;
    }
    public function set_talla_calzado($valor){
        $this->talla_calzado = $valor;
    }
    public function set_talla_pantalon($valor){
        $this->talla_pantalon = $valor;
    }
    public function set_tipo_sangre($valor){
        $this->tipo_sangre = $valor;
    }
    public function set_vacunas($valor){
        $this->vacunas = $valor;
    }
    public function set_covid($valor){
        $this->covid = $valor;
    }

    public function registrar_trabajador(){
        try {

            if(
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
            }

            if($this->existe_trabajador($this->cedula)){
                http_response_code(400);
                return "El trabajador ya existe";
            }

            
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO trabajadores (fecha_registro,personal_contratado,cedula,nombre,unidad_organizativa,fecha,pais,estado,municipio,telefono,correo,direccion,cuenta,profesion,genero,talla_camisa,talla_calzado,talla_pantalon,tipo_sangre,vacunas,covid) VALUES (:fecha_registro, :personal_contratado,:cedula,:nombre,:unidad_organizativa,:fecha,:pais,:estado,:municipio,:telefono,:correo,:direccion,:cuenta,:profesion,:genero,:talla_camisa,:talla_calzado,:talla_pantalon,:tipo_sangre,:vacunas,:covid)";

            $stmt = $bd->prepare($sql);
            
            $stmt->execute(array(
                ":fecha_registro" => $this->fecha_registro,
                ":personal_contratado" => $this->personal_contratado,
                ":cedula" => $this->cedula,
                ":nombre" => $this->nombre,
                ":unidad_organizativa" => $this->unidad_organizativa,
                ":fecha" => $this->fecha_nacimiento,
                ":pais" => $this->pais,
                ":estado" => $this->estado,
                ":municipio" => $this->municipio,
                ":telefono" => $this->telefono,
                ":correo" => $this->correo,
                ":direccion" => $this->direccion,
                ":cuenta" => $this->cuenta,
                ":profesion" => $this->profesion,
                ":genero" => $this->genero,
                ":talla_camisa" => $this->talla_camisa,
                ":talla_calzado" => $this->talla_calzado,
                ":talla_pantalon" => $this->talla_pantalon,
                ":tipo_sangre" => $this->tipo_sangre,
                ":vacunas" => $this->vacunas,
                ":covid" => $this->covid,
            ));

            http_response_code(200);
            return "registro exitoso";
            
        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
    }

    public function listar_trabajador(){

        try{
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM trabajadores";

            $stmt = $bd->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
        
    }

    public function modificar_trabajador(){
        try {
            /*if (
                !$this->evaluar_caracteres("/^[0-9]{7,8}$/", $this->cedula) ||
                !$this->evaluar_caracteres("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,50}$/", $this->nombre) ||
                !$this->evaluar_caracteres("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $this->correo)
            ) {
                http_response_code(400);
                return "Caracteres inválidos";
            }*/

            if (!$this->existe_trabajador($this->cedula)) {
                http_response_code(400);
                return "Trabajador no existe";
            }
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "UPDATE trabajadores SET fecha_registro = :fecha_registro, personal_contratado = :personal_contratado, nombre = :nombre,  unidad_organizativa = :unidad_organizativa, fecha = :fecha, pais = :pais, estado = :estado, municipio = :municipio, telefono = :telefono, correo = :correo, direccion = :direccion, cuenta = :cuenta, profesion = :profesion, genero = :genero, talla_camisa = :talla_camisa, talla_calzado = :talla_calzado, talla_pantalon = :talla_pantalon, tipo_sangre = :tipo_sangre, vacunas = :vacunas, covid = :covid WHERE cedula = :cedula";

            $stmt = $bd->prepare($sql);

            $stmt->execute(array(
                ":fecha_registro" => $this->fecha_registro,
                ":personal_contratado" => $this->personal_contratado,
                ":nombre" => $this->nombre,
                ":unidad_organizativa" => $this->unidad_organizativa,
                ":fecha" => $this->fecha_nacimiento,
                ":pais" => $this->pais,
                ":estado" => $this->estado,
                ":municipio" => $this->municipio,
                ":telefono" => $this->telefono,
                ":correo" => $this->correo,
                ":direccion" => $this->direccion,
                ":cuenta" => $this->cuenta,
                ":profesion" => $this->profesion,
                ":genero" => $this->genero,
                ":talla_camisa" => $this->talla_camisa,
                ":talla_calzado" => $this->talla_calzado,
                ":talla_pantalon" => $this->talla_pantalon,
                ":tipo_sangre" => $this->tipo_sangre,
                ":vacunas" => $this->vacunas,
                ":covid" => $this->covid,
                ":cedula" => $this->cedula, 
                
            ));

            http_response_code(200);
            return "Modificación con exito";
        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
    }

    public function eliminar_trabajador(){
        try {
            if(!$this->evaluar_caracteres("/^[0-9]{7,8}$/", $this->cedula)){
                http_response_code(400);
                return "Caracteres inválidos";
            }

            if (!$this->existe_trabajador($this->cedula)){
                http_response_code(400);
                return "Usuario No existe";
            }

            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "DELETE FROM trabajadores WHERE cedula = :cedula";

            $stmt = $bd->prepare($sql);

            $stmt->execute(array(
                ":cedula" => $this->cedula
            ));

            http_response_code(200);
            return "eliminacion con exito";
            
        } catch (PDOException $e) {
            http_response_code(500);
            switch ($e->getCode()) {
            	case '23000':
            		return "No se puede eliminar este trabajador por tener registros en otros modulos";
            		break;
            	
            	default:
            		return $e->getMessage();
            		break;
            }
            //return $e->getMessage();
        }
    }

    private function existe_trabajador($cedula){
        try {
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM trabajadores WHERE cedula = :cedula";

            $stmt = $bd->prepare($sql);

            $stmt->execute(array(
                ":cedula" => $cedula,
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