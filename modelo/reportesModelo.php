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

    public function setTrabajador($valor){
        $this->trabajador = $valor;
    }
    public function setSolicitante($valor){
        $this->solicitante = $valor;
    }
    public function setCategoria($valor){
        $this->categoria = $valor;
    }


    public function lista_solicitantes(){
        try {

            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT DISTINCT cedula_solicitante as cedula, nombre_solicitante as nombre from solicitudes where id_trabajadores = :id_trabajadores";

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

    public function lista_categorias(){
        try {

            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT DISTINCT id, tipo_solicitud as solicitud from solicitudes where cedula_solicitante = :solicitante and tipo_solicitud IN ('funeraria', 'estudios', 'farmacia')";

            $stmt = $bd->prepare($sql);
            $stmt->execute([":solicitante" => $this->solicitante]);

            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

            
            http_response_code(200);
            return json_encode($resultado);
        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
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

    private function getInfoCategoria(){
        try {
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM solicitudes WHERE id = :id_categoria";         

            $stmt = $bd->prepare($sql);
            $stmt->execute([":id_categoria" => $this->categoria]);

            $categoria = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$categoria) {
                return null;
            }

            return $categoria;
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
            $getInfoCategoria = $this->getInfoCategoria();

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

            if (!$getInfoCategoria) {
                http_response_code(400);
                echo json_encode(["error" => "No se encontro la Categoria"]);
                return;
            }

            $dompdf = new Dompdf();

            $path_img_aps = "assets/img/logo-aps.jpg";

            $img_logo = $this->image_to_base64($path_img_aps);

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
                                    &nbsp;
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
                                    &nbsp;
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
                                    V-
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
                                    &nbsp;
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
                                    &nbsp;
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
                                    &nbsp;
                                </span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style='width:101.4pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                            <p style='margin-top:0pt; margin-bottom:0pt; font-size:12pt;'>
                                <span style='font-family:Arial;'>
                                    Teléfono:
                                </span>
                            </p>
                        </td>
                        <td style='width:101.4pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                            <p style='margin-top:0pt; margin-bottom:0pt; font-size:12pt;'>
                                <span style='font-family:Arial;'>
                                    &nbsp;
                                </span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style='width:101.4pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                            <p style='margin-top:0pt; margin-bottom:0pt; font-size:12pt;'>
                                <span style='font-family:Arial;'>
                                    Patología:
                                </span>
                            </p>
                        </td>
                        <td style='width:101.4pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                            <p style='margin-top:0pt; margin-bottom:0pt; font-size:12pt;'>
                                <span style='font-family:Arial;'>
                                    &nbsp;
                                </span>
                            </p>
                        </td>
                    </tr>            
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
