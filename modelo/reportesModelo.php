<?php

namespace modelo;

use modelo\conexion as conexion;
use PDO;
use PDOException;
use Dompdf\Dompdf;
use Dompdf\Options;

class ReportesModelo extends conexion {

    private $trabajador;
    private $solicitante;
    private $categoria;
    private $id_solicitud;

    public function setTrabajador($valor){
        $this->trabajador = $valor;
    }
    public function setSolicitante($valor){
        $this->solicitante = $valor;
    }
    public function setCategoria($valor){
        $this->categoria = $valor;
    }

    public function setIdSolicitud($valor){
        $this->id_solicitud = $valor;
    }
    public function getIdSolicitud(){
        return $this->id_solicitud;
    }

    public function getSolicitudes(){
        try {

            if ($this->categoria == null || $this->categoria == '') {
                return json_encode(["error" => " No se ha seleccionado una categoria"]);
            }

            $nombre_tabla = '';

            switch ($this->categoria) {
                case 'funeraria':
                    $nombre_tabla = "funeraria";
                    break;
                case 'estudios':
                    $nombre_tabla = "estudios_medicos";
                    break;
                case 'farmacia':
                    $nombre_tabla = "farmacia";
                    break;
                default:
                    return json_encode(["error" => "Categoria no valida"]);
            }

            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $descripcion_solicitud = $nombre_tabla == 'funeraria' ? 'A.descripcion_solicitud' : 'C.descripcion_solicitud';

            $sql = "SELECT 
            C.id as id,
            A.codigo_registro as codigo,
            A.numero_registro as numero, 
            A.cedula_solicitante as cedula_solicitante, 
            A.nombre_solicitante as nombre_solicitante, 
            $descripcion_solicitud as descripcion,
            A.fecha_registro as fecha,
            B.cedula as cedula_trabajador , 
            B.nombre as nombre_trabajador 
            FROM solicitudes A 
            INNER JOIN trabajadores as B ON A.id_trabajadores = B.id 
            INNER JOIN $nombre_tabla as C ON A.id = C.id_solicitudes WHERE A.id_trabajadores = :id_trabajadores AND A.cedula_solicitante = :solicitante ORDER BY A.fecha_registro desc";

            $stmt = $bd->prepare($sql);
            $stmt->execute([
                ":id_trabajadores" => $this->trabajador,
                ":solicitante" => $this->solicitante,
            ]);

            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($resultado) {
                http_response_code(200);
                return json_encode($resultado);
            } else {
                http_response_code(404);
                return json_encode(["error" => "No se encontraron solicitudes"]);
            }
        } catch (PDOException $e) {
            http_response_code(500);
            return json_encode(["error" => $e->getMessage()]);
        }
    }


    public function lista_solicitantes(){
        try {

            if ($this->categoria == null || $this->categoria == '') {
                return json_encode(["error" => " No se ha seleccionado una categoria"]);
            }

            $nombre_tabla = '';

            switch ($this->categoria) {
                case 'funeraria':
                    $nombre_tabla = "funeraria";
                    break;
                case 'estudios':
                    $nombre_tabla = "estudios_medicos";
                    break;
                case 'farmacia':
                    $nombre_tabla = "farmacia";
                    break;
                default :
                    return json_encode(["error" => "Categoria no valida"]);
            }

            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT DISTINCT B.cedula_solicitante as cedula, B.nombre_solicitante as nombre from $nombre_tabla INNER JOIN solicitudes as B ON $nombre_tabla.id_solicitudes = B.id where B.id_trabajadores = :id_trabajadores";

            $stmt = $bd->prepare($sql);
            $stmt->execute([":id_trabajadores" => $this->trabajador]);

            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

            
            http_response_code(200);
            return json_encode($resultado);
        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
    }

    public function lista_trabajadores(){
        try {

            
            if($this->categoria == null || $this->categoria == ''){
                return json_encode(["error" => " No se ha seleccionado una categoria"]);
            }

            $nombre_tabla = '';

            switch ($this->categoria) {
                case 'funeraria':
                    $nombre_tabla = "funeraria";
                    break;
                case 'estudios':
                    $nombre_tabla = "estudios_medicos";
                    break;
                case 'farmacia':
                    $nombre_tabla = "farmacia";
                    break;
                    default:
                    return json_encode(["error" => "Categoria no valida"]);
                }
                $bd = $this->conecta();
                $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = 
            "SELECT DISTINCT A.id, A.nombre 
            from $nombre_tabla as C 
            INNER JOIN solicitudes as B ON C.id_solicitudes = B.id 
            INNER JOIN trabajadores as A ON B.id_trabajadores = A.id;";

            $stmt = $bd->prepare($sql);
            $stmt->execute();

            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

            
            http_response_code(200);
            return json_encode($resultado); 
        } catch (PDOException $e) {
            http_response_code(500);
            return json_encode($e->getMessage());
        }
    }

    //PARA LAS VALIDACIONES

    private function getInfoTrabajador(){
        try {
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM trabajadores WHERE id = :id";

            $stmt = $bd->prepare($sql);
            $stmt->execute([":id" => $this->trabajador]);

            $trabajador = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$trabajador) {
                return null;
            }

            return $trabajador;
        } catch (PDOException $e) {
            return null;
        }
    }

    private function getInfoSolicitante(){
        try {
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM solicitudes WHERE cedula_solicitante = :solicitante";

            $stmt = $bd->prepare($sql);
            $stmt->execute([":solicitante" => $this->solicitante]);

            $Infosolicitante = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$Infosolicitante) {
                return null;
            }

            return $Infosolicitante;
        } catch (PDOException $e) {
            return null;
        }
    }

    public function infoSolicitud()
    {
        try {

            if ($this->categoria == null || $this->categoria == '') {
                return null;
            }

            $nombre_tabla = '';

            switch ($this->categoria) {
                case 'funeraria':
                    $nombre_tabla = "funeraria";
                    break;
                case 'estudios':
                    $nombre_tabla = "estudios_medicos";
                    break;
                case 'farmacia':
                    $nombre_tabla = "farmacia";
                    break;
            }

            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM $nombre_tabla WHERE id = :id_solicitud";

            $stmt = $bd->prepare($sql);
            $stmt->execute([":id_solicitud" => $this->id_solicitud]);

            $infoSolicitud = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$infoSolicitud) {
                return null;
            }

            return $infoSolicitud;
        } catch (PDOException $e) {
            return null;
        }
    }

    public function generarReporte(){
        try {
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $infoTrabajador = $this->getInfoTrabajador();
            $infoSolicitante = $this->getInfoSolicitante();
            $infoSolicitud  = $this->infoSolicitud();
            
            $nombre_tabla = '';

            switch ($this->categoria) {
                case 'funeraria':
                    $nombre_tabla = "funeraria";
                    break;
                case 'estudios':
                    $nombre_tabla = "estudios_medicos";
                    break;
                case 'farmacia':
                    $nombre_tabla = "farmacia";
                    break;
            }
            

            if (!$infoTrabajador) {
                http_response_code(400);
                echo json_encode(["error" => "No se encontro el trabajador"]);
                return;
            }

            if (!$infoSolicitante) {
                http_response_code(400);
                echo json_encode(["error" => "No se encontro el solicitante"]);
                return;
            }
            if (!$infoSolicitud) {
                http_response_code(400);
                echo json_encode(["error" => "No se encontro la solicitud"]);
                return;
            }

            $dompdf = new Dompdf();

            $path_img_aps = "assets/img/logo-aps.jpg";

            $img_logo = $this->image_to_base64($path_img_aps);

            $ente = $infoSolicitud['ente'] ?? '';
            $nombre_trabajador = $infoTrabajador['nombre'] ?? '';
            $cedula_trabajador = $infoTrabajador['cedula'] ?? '';

            $nombre_solicitante = $infoSolicitante['nombre_solicitante'] ?? '';
            $cedula_solicitante = $infoSolicitante['cedula_solicitante'] ?? '';
            $telefono_solicitante = $infoSolicitante['telefono_solicitante'] ?? '';
            
            $fecha_nacimiento = $infoSolicitud['fecha_nacimiento'] ?? '';
            $patologia = $infoSolicitud['patologia'] ?? '';
            $parentesco = $infoSolicitud['parentesco'] ?? '';
            $proveedor = $infoSolicitud['proveedor'] ?? '';

            $defuncion_paciente = $infoSolicitud['defuncion_paciente'] ?? '';

            $rowsFarmacia = "
            <tr>
                <td style='width:101.4pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                    <p style='margin-top:0pt; margin-bottom:0pt; font-size:12pt;'>
                        <span style='font-family:Arial;'>
                            Patologia:
                        </span>
                    </p>
                </td>
                <td style='width:101.4pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                    <p style='margin-top:0pt; margin-bottom:0pt; font-size:12pt;'>
                        <span style='font-family:Arial;'>
                            $patologia
                        </span>
                    </p>
                </td>
            </tr> 
            <tr>
                <td style='width:101.4pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                    <p style='margin-top:0pt; margin-bottom:0pt; font-size:12pt;'>
                        <span style='font-family:Arial;'>
                            F. Nacimiento: 
                        </span>
                    </p>
                </td>
                <td style='width:101.4pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                    <p style='margin-top:0pt; margin-bottom:0pt; font-size:12pt;'>
                        <span style='font-family:Arial;'>
                            $fecha_nacimiento
                        </span>
                    </p>
                </td>
            </tr>
            <tr>
                <td style='width:101.4pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                    <p style='margin-top:0pt; margin-bottom:0pt; font-size:12pt;'>
                        <span style='font-family:Arial;'>
                            Parentesco: 
                        </span>
                    </p>
                </td>
                <td style='width:101.4pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                    <p style='margin-top:0pt; margin-bottom:0pt; font-size:12pt;'>
                        <span style='font-family:Arial;'>
                            $parentesco
                        </span>
                    </p>
                </td>
            </tr>
            <tr>
                <td style='width:101.4pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                    <p style='margin-top:0pt; margin-bottom:0pt; font-size:12pt;'>
                        <span style='font-family:Arial;'>
                            Proveedor: 
                        </span>
                    </p>
                </td>
                <td style='width:101.4pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                    <p style='margin-top:0pt; margin-bottom:0pt; font-size:12pt;'>
                        <span style='font-family:Arial;'>
                            $proveedor
                        </span>
                    </p>
                </td>
            </tr>";

            $rowsEstudios ="<tr>
                <td style='width:101.4pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                    <p style='margin-top:0pt; margin-bottom:0pt; font-size:12pt;'>
                        <span style='font-family:Arial;'>
                            Patologia: 
                        </span>
                    </p>
                </td>
                <td style='width:101.4pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                    <p style='margin-top:0pt; margin-bottom:0pt; font-size:12pt;'>
                        <span style='font-family:Arial;'>
                            $patologia
                        </span>
                    </p>
                </td>
            </tr>";

            $rowsFuneraria = "
            <tr>
                <td style='width:101.4pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                    <p style='margin-top:0pt; margin-bottom:0pt; font-size:12pt;'>
                        <span style='font-family:Arial;'>
                            Defuncion del paciente: 
                        </span>
                    </p>
                </td>
                <td style='width:101.4pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                    <p style='margin-top:0pt; margin-bottom:0pt; font-size:12pt;'>
                        <span style='font-family:Arial;'>
                            $defuncion_paciente
                        </span>
                    </p>
                </td>
            </tr>";

            $rowsTable = "";
            switch ($this->categoria) {
                case 'farmacia':
                    $rowsTable = $rowsFarmacia;
                    break;
                case 'estudios':
                    $rowsTable = $rowsEstudios;
                    break;
                case 'funeraria':
                    $rowsTable = $rowsFuneraria;
                    break;
            }

            $html = "<!DOCTYPE html>

            <html lang='es'>

                <head>
                    <meta charset='utf8'>
                </head>
                <body>

                <header>
                    <img src='$img_logo' style='width:200px'>
                </header>

                 <center><h1>Planilla de atencion</h1></center>

                 <table cellspacing='0' cellpadding='0' style='border-collapse: collapse; width: 100%;'>
                <tbody>                    
                    <tr>
                        <td style='width:101.4pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                            <p style='margin-top:0pt; margin-bottom:0pt; font-size:12pt;'>
                                <span style='font-family:Arial;'>
                                    Ente: 
                                </span>
                            </p>
                        </td>
                        <td style='width:101.4pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                            <p style='margin-top:0pt; margin-bottom:0pt; font-size:12pt;'>
                                <span style='font-family:Arial;'>
                                    $ente
                                </span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style='width:101.4pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                            <p style='margin-top:0pt; margin-bottom:0pt; font-size:12pt;'>
                                <span style='font-family:Arial;'>
                                    Datos del Titular:
                                </span>
                            </p>
                        </td>
                        <td style='width:101.4pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                            <p style='margin-top:0pt; margin-bottom:0pt; font-size:12pt;'>
                                <span style='font-family:Arial;'>
                                    $nombre_trabajador
                                </span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style='width:101.4pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                            <p style='margin-top:0pt; margin-bottom:0pt; font-size:12pt;'>
                                <span style='font-family:Arial;'>
                                    Cedula de indentidad:
                                </span>
                            </p>
                        </td>
                        <td style='width:101.4pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                            <p style='margin-top:0pt; margin-bottom:0pt; font-size:12pt;'>
                                <span style='font-family:Arial;'>
                                    V-$cedula_trabajador
                                </span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style='width:101.4pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                            <p style='margin-top:0pt; margin-bottom:0pt; font-size:12pt;'>
                                <span style='font-family:Arial;'>
                                    Datos del beneficiario:
                                </span>
                            </p>
                        </td>
                        <td style='width:101.4pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                            <p style='margin-top:0pt; margin-bottom:0pt; font-size:12pt;'>
                                <span style='font-family:Arial;'>
                                    $nombre_solicitante
                                </span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style='width:101.4pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                            <p style='margin-top:0pt; margin-bottom:0pt; font-size:12pt;'>
                                <span style='font-family:Arial;'>
                                    Cedula de identidad:
                                </span>
                            </p>
                        </td>
                        <td style='width:101.4pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                            <p style='margin-top:0pt; margin-bottom:0pt; font-size:12pt;'>
                                <span style='font-family:Arial;'>
                                    V-$cedula_solicitante
                                </span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style='width:101.4pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                            <p style='margin-top:0pt; margin-bottom:0pt; font-size:12pt;'>
                                <span style='font-family:Arial;'>
                                    Solicitud:
                                </span>
                            </p>
                        </td>
                        <td style='width:101.4pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                            <p style='margin-top:0pt; margin-bottom:0pt; font-size:12pt;'>
                                <span style='font-family:Arial;'>
                                    $nombre_tabla
                                </span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style='width:101.4pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                            <p style='margin-top:0pt; margin-bottom:0pt; font-size:12pt;'>
                                <span style='font-family:Arial;'>
                                    Telefono:
                                </span>
                            </p>
                        </td>
                        <td style='width:101.4pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                            <p style='margin-top:0pt; margin-bottom:0pt; font-size:12pt;'>
                                <span style='font-family:Arial;'>
                                    $telefono_solicitante
                                </span>
                            </p>
                        </td>
                    </tr>
                    $rowsTable           
                </tbody>
            </table>

                </body>
            

            </html>";
            
            $dompdf->loadHtml(utf8_decode($html));
            $dompdf->setPaper('letter', 'portrait');
            $dompdf->render();

            // Obtener contenido en base64
            $pdfOutput = $dompdf->output();
            $base64Pdf = base64_encode($pdfOutput);

            echo json_encode(["pdf" => $base64Pdf]);
        } catch (PDOException $e) {
            echo json_encode(["error" => $e->getMessage()]);
        }
    }

    public function listarSolicitudes(){

        try {
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM solicitudes WHERE id_trabajadores = :id_trabajadores and cedula_solicitante = :solicitante";

            $stmt = $bd->prepare($sql);

            $stmt->execute(array(
                ":id_trabajadores" => $this->trabajador,
                ":solicitante" => $this->solicitante,
                
            ));

            $reporte = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$reporte) {
                return null;
            }

           return $reporte;
        } catch (PDOException $e) {
            return null;
        }
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


        }catch(PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
    }

    private function image_to_base64($image_path){
        $imagenData = base64_encode(file_get_contents($image_path));
        $imagenTipo = mime_content_type($image_path);
        $imagen_logo = "data:$imagenTipo;base64,$imagenData";
        return $imagen_logo;
    }
   
}
