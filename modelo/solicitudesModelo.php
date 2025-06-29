<?php 

    namespace modelo;

    use modelo\conexion as conexion;
    use PDO;
    use Dompdf\Dompdf;
    use PDOException;
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
    private $monto_divisas;
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
    public function set_monto_divisas($valor){
        $this->monto_divisas = $valor;
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

    public function registrar_solicitud($cedula_bitacora,$id_modulo){
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

            $sql = "INSERT INTO solicitudes(codigo_registro,numero_registro,id_trabajadores,cedula_solicitante,nombre_solicitante,telefono_solicitante,tipo_solicitud,sub_tipo_solicitud,estado_solicitud,descripcion_solicitud,financiado,remitido,monto,monto_aprobado,monto_divisas,fecha_registro,condicion,estatus,observacion) VALUES (:codigo,:numero_registro,:trabajador,:cedula,:nombre,:telefono,:tipo_solicitud,:sub_tipo_solicitud,:estado_solicitud,:descripcion,:financiado,:remitido,:monto_solicitado,:monto_aprobado,:monto_divisas,:fecha_registro,:condicion,:estatus,:observacion)";

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
                ":monto_divisas" => $this->monto_divisas,
                ":fecha_registro" => $this->fecha_registro,
                ":condicion" => $this->condicion,
                ":estatus" => $this->estatus,
                ":observacion" => $this->observacion

            ));

            $accion= "Ha registrado una nueva Solicitud";

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

            $sql = "SELECT a.id,
                b.id as id_trabajadores,
                a.codigo_registro, a.numero_registro, a.cedula_solicitante, a.nombre_solicitante,
                a.telefono_solicitante, a.tipo_solicitud ,a.sub_tipo_solicitud,a.estado_solicitud,a.descripcion_solicitud,a.financiado,a.remitido,a.monto,a.monto_aprobado,a.monto_divisas,a.fecha_registro,a.condicion,a.estatus,a.observacion,b.nombre from solicitudes a INNER JOIN trabajadores b ON a.id_trabajadores = b.id ORDER BY `id` DESC";
            

            $stmt = $bd->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
        
    }

   public function modificar_solicitud($cedula_bitacora,$id_modulo){
        try {

            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           
            $sql = "UPDATE solicitudes SET cedula_solicitante = :cedula, nombre_solicitante = :nombre, telefono_solicitante = :telefono, tipo_solicitud = :tipo_solicitud, sub_tipo_solicitud = :sub_tipo_solicitud, estado_solicitud = :estado_solicitud, descripcion_solicitud = :descripcion, financiado = :financiado, remitido = :remitido, monto = :monto_solicitado, monto_aprobado = :monto_aprobado, monto_divisas = :monto_divisas, fecha_registro = :fecha_registro, condicion = :condicion, estatus = :estatus, observacion = :observacion WHERE id = :id";

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
                ":monto_divisas" => $this->monto_divisas,
                ":fecha_registro" => $this->fecha_registro,
                ":condicion" => $this->condicion,
                ":estatus" => $this->estatus,
                ":observacion" => $this->observacion,
                ":id" => $this->id,
            ));

            $accion= "Ha modificado una Solicitud";

            parent::registrar_bitacora($cedula_bitacora, $accion, $id_modulo);

            http_response_code(200);
            return "Modificación con exito";
        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
    }

    public function eliminar_solicitud($cedula_bitacora,$id_modulo){
        try {

            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "DELETE FROM solicitudes WHERE id = :id";

            $stmt = $bd->prepare($sql);

            $stmt->execute(array(
                ":id" => $this->id
            ));

            $accion= "Ha eliminado una Solicitud";

            parent::registrar_bitacora($cedula_bitacora, $accion, $id_modulo);

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

            $sql = "SELECT * FROM `trabajadores` ORDER BY CAST(cedula AS UNSIGNED) ASC";

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

    public function exportar_excel(){

        try{

            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT `codigo_registro`,`numero_registro`,`cedula_solicitante`,`nombre_solicitante`,`telefono_solicitante`,`tipo_solicitud`,`sub_tipo_solicitud`,`estado_solicitud`,`descripcion_solicitud`,`financiado`,`remitido`,`monto`,`monto_aprobado`,`monto_divisas`,`fecha_registro`,`condicion`,`estatus`,`observacion` FROM `solicitudes`";

            $stmt = $bd->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($result) {
                http_response_code(200);
                echo json_encode(["success" => true, "data" => $result]);
            } else {
                http_response_code(400);
                echo json_encode(["success" => false, "message" => "No hay datos disponibles"]);
            }
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(["success" => false, "message" => "Error: " . $e->getMessage()]);
        }
    }

    public function exportar_pdf(){

        try{
            if (!$this->id) {
                http_response_code(400);
                return json_encode(["error" => "ID de solicitud no proporcionado"]);
            }

            //!validar ID
            if (!is_numeric($this->id)) {
                http_response_code(400);
                return json_encode(["error" => "ID de solicitud inválido"]);
            }

            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT s.codigo_registro, s.numero_registro, s.fecha_registro ,t.nombre as nombre_trabajador,t.cedula as cedula_trabajador, s.nombre_solicitante,s.cedula_solicitante, s.telefono_solicitante FROM solicitudes s INNER JOIN trabajadores t ON s.id_trabajadores = t.id WHERE s.id = :id";

            $stmt = $bd->prepare($sql);
            $stmt->execute(array(
                ":id" => $this->id,
            ));
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$result) {
                http_response_code(400);
                return json_encode(["error" => "No hay datos disponibles"]);
            }

            $codigo_registro = $result['codigo_registro'];
            $numero_registro = $result['numero_registro'];
            $fecha_registro = $result['fecha_registro'];
            $nombre_trabajador = $result['nombre_trabajador'];
            $cedula_trabajador = $result['cedula_trabajador'];
            $nombre_solicitante = $result['nombre_solicitante'];
            $cedula_solicitante = $result['cedula_solicitante'];
            $telefono_solicitante = $result['telefono_solicitante'];

            if (!$codigo_registro || !$numero_registro || !$fecha_registro || !$nombre_trabajador || !$cedula_trabajador || !$nombre_solicitante || !$cedula_solicitante || !$telefono_solicitante) {
                http_response_code(400);
                return json_encode(["error" => "Faltan datos para generar el PDF"]);
            }

            $dompdf = new Dompdf();
            
            $path_img_aps = "assets/img/logo-aps.jpg";
            $path_img_institucional = "assets/img/institucional.jpg";

            $img_logo = $this->image_to_base64($path_img_aps);
            $img_institucional = $this->image_to_base64($path_img_institucional);
            

            $html = "
                <!DOCTYPE html>
                    <html lang='es'>

                    <head>
                        <meta charset='UTF-8'>
                        <title>Planilla de Atención</title>
                        <style>
                            body {
                                font-family: Arial, sans-serif;
                                margin: 15px;
                                font-size: 12pt;
                            }

                            table {
                                width: 100%;
                                border-collapse: collapse;
                                table-layout: fixed;
                            }

                            td,
                            th {
                                border: 0.75pt solid #000;
                                padding: 5pt;
                                vertical-align: middle;
                                word-wrap: break-word;
                            }

                            p {
                                margin: 0;
                            }

                            .checkbox {
                                display: inline-block;
                                width: 17px;
                                height: 17px;
                                border: 0.75pt solid #000;
                                margin-right: 5px;
                                vertical-align: middle;
                            }

                            .title {
                                background-color: #dbe5f1;
                                text-align: center;
                            }

                            @media screen and (max-width: 768px) {
                                body {
                                    font-size: 10pt;
                                }
                            }
                        </style>
                    </head>

                    <body>

                        <header>
                            <img src='$img_logo' alt='Logo' style='width:200px;'>
                        </header>

                        <table>
                            <tr>
                                <td colspan='3'><strong>PLANILLA DE ATENCION:$codigo_registro</strong></td>
                                <td colspan='3'><strong>NRO:$numero_registro</strong></td>
                                <td colspan='2'><strong>FECHA:&nbsp;$fecha_registro</strong></td>
                            </tr>

                            <tr>
                                <td colspan='8'><strong>Datos del Titular: $nombre_trabajador</strong></td>
                            </tr>

                            <tr>
                                <td colspan='8'><strong>C.I.: V-$cedula_trabajador</strong></td>
                            </tr>

                            <tr>
                                <td colspan='8'><strong>Datos del Beneficiario: $nombre_solicitante</strong></td>
                            </tr>

                            <tr>
                                <td colspan='8'><strong>C.I.: V-$cedula_solicitante</strong></td>
                            </tr>

                            <tr>
                                <td colspan='8'><strong>Telefono: $telefono_solicitante</strong></td>
                            </tr>

                            <tr>
                                <td colspan='8'><strong>Correo Electronico:</strong></td>
                            </tr>

                            <tr>
                                <td colspan='8'><strong>Ente:&nbsp;</strong>CORPORACION DE DESARROLLO JACINTO LARA</td>
                            </tr>

                            <tr>
                                <td colspan='8'><strong>Patologia:</strong></td>
                            </tr>

                            <tr>
                                <td colspan='2'><strong>Solicitud de:</strong></td>
                                <td>
                                    <span class='checkbox'></span><strong>Consulta M&eacute;dica</strong>
                                </td>
                                <td colspan='2'>
                                    <span class='checkbox'></span><strong>Estudios M&eacute;dicos</strong>
                                </td>
                                <td colspan='2'>
                                    <span class='checkbox'></span><strong>Medicamentos</strong>
                                </td>
                                <td>
                                    <span class='checkbox'></span><strong>Otros: __________________</strong>
                                </td>
                            </tr>

                            <tr>
                                <td colspan='8' style='height:91.25pt; vertical-align:top;'>
                                    <p><strong>Especifique:</strong></p>
                                    <p><strong>________________________________________________________________________________________________________________________________________________________________________</strong>
                                    </p>
                                    <p><strong>Documentos Consignados:</strong></p>
                                    <p>
                                        ___Copia de C.I. y Carnet del titular, ___ Copia de C.I. beneficiario, ___Copia de P.N. Titular,
                                        ___Copia de P.N. Beneficiario, ___Orden Medica, ___Indicaciones, ___Informe Medico, _____ Informe
                                        medico Actualizado, ___Factura Original, ___ Informe o Resultado de estudios realizados
                                    </p>
                                    <br>
                                    <p style='text-align:right;'><strong>PROCESADO POR: ___________________________</strong></p>
                                </td>
                            </tr>

                            <tr class='title'>
                                <td colspan='8'><strong>PARA SER LLENADO UNA VEZ FINALIZADO EL PROCESO DE SOLICITUD</strong></td>
                            </tr>

                            <tr style='height:101.5pt;'>
                                <td colspan='4'>
                                    <p><strong>Estatus: ______________________________</strong></p>
                                    <p><strong>Monto Consumido: Bs. _________________</strong></p>
                                    <p><strong>Fecha Aprobacion: ____________________</strong></p>
                                </td>
                                <td colspan='4'>
                                    <p><strong>En caso de ser Devuelto o Rechazado indique el motivo:</strong></p>
                                    <p><strong>____________________________________</strong></p>
                                    <p><strong>____________________________________</strong></p>
                                </td>
                            </tr>
                        </table>

                        <br>
                        <p><strong>CENTRO REMITIDO: ______________________________________________________________</strong></p>
                        <br>
                        <p><strong>Observaciones:</strong></p>
                        <p>___________________________________________________________________________________</p>
                        <p>___________________________________________
                        </p>


                    </body>

                    </html>
            ";

            // <footer>
            // <img src='$img_institucional' alt='INSTITUCIONAL.png' style='width:100%; max-width:686px;'>
            // </footer>

            $dompdf->loadHtml($html);

            $dompdf->setPaper('letter', 'portrait');
            $dompdf->render();

            // Obtener contenido en base64
            $pdfOutput = $dompdf->output();
            $base64Pdf = base64_encode($pdfOutput);
            ob_end_clean();
            http_response_code(200);

            echo json_encode(["pdf" => $base64Pdf]);
        } catch (PDOException $e) {
            http_response_code(500);
            return json_encode(["error" => "Error: " . $e->getMessage()]);
        }
    }
    private function image_to_base64($image_path)
    {
        $imagenData = base64_encode(file_get_contents($image_path));
        $imagenTipo = mime_content_type($image_path);
        $imagen_logo = "data:$imagenTipo;base64,$imagenData";
        return $imagen_logo;
    }
}
?>