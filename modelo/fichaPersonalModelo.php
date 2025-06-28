<?php

namespace modelo;

use modelo\conexion as conexion;
use PDO;
use PDOException;
use Dompdf\Dompdf;
use Dompdf\Options;

class FichaPersonalModelo extends conexion{

    private $trabajador;
    private $solicitante;

    public function setTrabajador($valor)
    {
        $this->trabajador = $valor;
    }
    public function setSolicitante($valor)
    {
        $this->solicitante = $valor;
    }

    public function lista_solicitantes(){
        try {

            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT DISTINCT cedula_solicitante as cedula,nombre_solicitante as nombre from solicitudes where id_trabajadores = :id_trabajadores ";

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

    public function consulta_trabajadores(){

        try {

            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //$sql = "SELECT id,cedula, nombre from trabajadores ORDER BY `Cedula` ASC";

            $sql = "SELECT * FROM `trabajadores` ORDER BY CAST(cedula AS UNSIGNED) ASC";

            $stmt = $bd->prepare($sql);
            $stmt->execute();

            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($resultado) {
                http_response_code(200);
                return $resultado;
            } else {
                http_response_code(200);
                return null;
            }
        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
    }

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

            $sql = "SELECT cedula_solicitante as cedula, nombre_solicitante as nombre FROM solicitudes WHERE cedula_solicitante = :cedula LIMIT 1";

            $stmt = $bd->prepare($sql);
            $stmt->execute([":cedula" => $this->solicitante]);

            $trabajador = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$trabajador) {
                return null;
            }

            return $trabajador;
        } catch (PDOException $e) {
            return null;
        }
    }

    private function getMontos(){
        try{
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT SUM(monto_aprobado) as monto_total_bs, SUM(monto_divisas) as monto_total_divisa FROM solicitudes WHERE id_trabajadores = :id_trabajadores and cedula_solicitante = :solicitante and estatus = 'aprobado'";

            $stmt = $bd->prepare($sql);
            $stmt->execute([":id_trabajadores" => $this->trabajador, ":solicitante" => $this->solicitante]);

            $montos = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$montos) {
                return null;
            }

            return $montos;
        } catch(PDOException $e){
            return null;
        }
    }

    private function getMontos_farmacia(){
        try{
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT SUM(monto_aprobado) as monto_total_bs_farmacia, SUM(monto_divisas) as monto_total_divisas_farmacia FROM solicitudes WHERE cedula_solicitante = :cedula and tipo_solicitud = 'farmacia' and estatus = 'aprobado'";

            $stmt = $bd->prepare($sql);
            $stmt->execute([":cedula" => $this->solicitante]);

            $montos_farmacia = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$montos_farmacia) {
                return null;
            }

            return $montos_farmacia;
        } catch(PDOException $e){
            return null;
        }
    }

    private function getMontos_aps(){
        try{
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT SUM(monto_aprobado) as monto_total_bs_aps, SUM(monto_divisas) as monto_total_divisas_aps FROM solicitudes WHERE cedula_solicitante = :cedula and tipo_solicitud in ('estudios', 'consultas', 'ecografias', 'examenes') and estatus = 'aprobado'";

            $stmt = $bd->prepare($sql);
            $stmt->execute([":cedula" => $this->solicitante]);

            $montos_aps = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$montos_aps) {
                return null;
            }

            return $montos_aps;
        } catch(PDOException $e){
            return null;
        }
    }

    private function getMontos_reembolso(){
        try{
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT SUM(monto_aprobado) as monto_total_bs_reembolso, SUM(monto_divisas) as monto_total_divisas_reembolso FROM solicitudes WHERE cedula_solicitante = :cedula and tipo_solicitud = 'reembolso' and estatus = 'aprobado'";

            $stmt = $bd->prepare($sql);
            $stmt->execute([":cedula" => $this->solicitante]);

            $montos_reembolso = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$montos_reembolso) {
                return null;
            }

            return $montos_reembolso;
        } catch(PDOException $e){
            return null;
        }
    }

    private function getMontos_funeraria(){
        try{
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT SUM(monto_aprobado) as monto_total_bs_funeraria, SUM(monto_divisas) as monto_total_divisas_funeraria FROM solicitudes WHERE cedula_solicitante = :cedula and tipo_solicitud = 'funeraria' and estatus = 'aprobado'";

            $stmt = $bd->prepare($sql);
            $stmt->execute([":cedula" => $this->solicitante]);

            $montos_funeraria = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$montos_funeraria) {
                return null;
            }

            return $montos_funeraria;
        } catch(PDOException $e){
            return null;
        }
    }

    public function generarReporte(){

        try {
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $infoTrabajador = $this->getInfoTrabajador();
            $infoSolicitante = $this->getInfoSolicitante();
            $solicitudes = $this->listarSolicitudes();
            $getMontos = $this->getMontos();
            $getMontosFarmacia = $this->getMontos_farmacia();
            $getMontoAps = $this->getMontos_aps();
            $getMontoReembolso = $this->getMontos_reembolso();
            $getMontoFuneraria = $this->getMontos_funeraria();

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
            
            if (!$solicitudes) {
                http_response_code(400);
                echo json_encode(["error" => "No hay solicitudes"]);
                return;
            }
            
            if (!$getMontos) {
                http_response_code(400);
                echo json_encode(["error" => "No hay montos totales"]);
                return;
            }

            if (!$getMontosFarmacia) {
                http_response_code(400);
                echo json_encode(["error" => "No hay montos totales de farmacia"]);
                return;
            }

            // Habilitar imágenes remotas
            // $options = new Options();
            // $options->set('isRemoteEnabled', true);
            $dompdf = new Dompdf();

            $path_img_aps = "assets/img/logo-aps.jpg";
            $path_img_institucional = "assets/img/institucional.jpg";


            $img_logo = $this->image_to_base64($path_img_aps);
            $img_institucional = $this->image_to_base64($path_img_institucional);

            $nombre_trabajador = $infoTrabajador["nombre"];
            $cedula_trabajador = $infoTrabajador["cedula"];
            $fecha_nacimiento_trabajador = $infoTrabajador["fecha"];
            $telefono_trabajador = $infoTrabajador["telefono"];
            $estado_civil_trabajador = $infoTrabajador["estado_civil"];
            $genero_trabajador = $infoTrabajador["genero"];
            $fecha_ingreso_trabajador = $infoTrabajador["fecha_registro"];

            $cedula_solicitante = $infoSolicitante["cedula"];
            $nombre_solicitante = $infoSolicitante["nombre"];

            $monto_total_bs = $getMontos["monto_total_bs"] ?? 0;
            $monto_total_divisa = $getMontos["monto_total_divisa"] ?? 0;

            $monto_total_Bs_farmacia = $getMontosFarmacia["monto_total_bs_farmacia"] ?? 0;
            $monto_total_divisa_farmacia = $getMontosFarmacia["monto_total_divisas_farmacia"] ?? 0;

            $monto_total_Bs_aps = $getMontoAps["monto_total_bs_aps"] ?? 0;
            $monto_total_divisa_aps = $getMontoAps["monto_total_divisas_aps"] ?? 0;

            $monto_total_Bs_reembolso = $getMontoReembolso["monto_total_bs_reembolso"] ?? 0;
            $monto_total_divisa_reembolso = $getMontoReembolso["monto_total_divisas_reembolso"] ?? 0;

            $monto_total_Bs_funeraria = $getMontoFuneraria["monto_total_bs_funeraria"] ?? 0;
            $monto_total_divisa_funeraria = $getMontoFuneraria["monto_total_divisas_funeraria"] ?? 0;

            $poliza = 600;
            //PARA EL PORCENTAJE DE POLIZAS

            $porcentaje_farmacia = $this->obtener_porcentaje($monto_total_divisa_farmacia, $poliza);

            //PARA EL PORCENTAJE DE POLIZAS APS

            $porcentajeAPS = $this->obtener_porcentaje($monto_total_divisa_aps, $poliza);

            //PARA EL PORCENTAJE DE POLIZAS REEMBOLSO

            $porcentajeReembolso = $this->obtener_porcentaje($monto_total_divisa_reembolso, $poliza);

            //PARA EL PORCENTAJE DE POLIZAS REEMBOLSO

            $porcentajeFuneraria = $this->obtener_porcentaje($monto_total_divisa_funeraria, $poliza);

            $tabla_solicitudes = "";
            
            foreach($solicitudes as $solicitud){
                $tabla_solicitudes .= "<tr>";

                $tabla_solicitudes .= "<td style='border: 0.75pt solid #000; padding: 5px;text-align: center; font-family: Arial; font-size: 10pt;'>".$solicitud["codigo_registro"]."</td>";
                $tabla_solicitudes .= "<td style='border: 0.75pt solid #000; padding: 5px;text-align: center; font-family: Arial; font-size: 10pt;'>".$solicitud["fecha_registro"]."</td>";
                $tabla_solicitudes .= "<td style='border: 0.75pt solid #000; padding: 5px;text-align: center; font-family: Arial; font-size: 10pt;'>".$solicitud["tipo_solicitud"]."</td>";
                $tabla_solicitudes .= "<td style='border: 0.75pt solid #000; padding: 5px;text-align: center; font-family: Arial; font-size: 10pt;'>".$solicitud["descripcion_solicitud"]."</td>";
                $tabla_solicitudes .= "<td style='border: 0.75pt solid #000; padding: 5px;text-align: center; font-family: Arial; font-size: 10pt;'>".$solicitud["remitido"]."</td>";
                $tabla_solicitudes .= "<td style='border: 0.75pt solid #000; padding: 5px;text-align: center; font-family: Arial; font-size: 10pt;'>".$solicitud["estatus"]."</td>";
                $tabla_solicitudes .= "<td style='border: 0.75pt solid #000; padding: 5px;text-align: center; font-family: Arial; font-size: 10pt;'>".$solicitud["monto_aprobado"]." bs</td>";
                $tabla_solicitudes .= "<td style='border: 0.75pt solid #000; padding: 5px;text-align: center; font-family: Arial; font-size: 10pt;'>".$solicitud["monto_divisas"]." $</td>";
                $tabla_solicitudes .= "</tr>";
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
        <div>    

            <p style='margin-top:0pt; margin-bottom:10pt; text-align:center; line-height:115%; font-size:16pt;'>
                <span style='font-family:Arial;'>
                    CALCULO DE POLIZA POR SEGURO MIRANDAS
                </span>
            </p>

            <p style='margin-top:0pt; margin-bottom:10pt; text-align:justify; line-height:115%; font-size:12pt;'>

                <span style='font-family:Arial;'>                    
                    TITULAR: $nombre_trabajador
                </span>

                <span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </span>

                <span style='font-family:Arial;'> 
                    Codigo de expediente: $fecha_ingreso_trabajador
                </span>
            </p>

            <table cellspacing='0' cellpadding='0' style='border: 0.75pt solid #000; border-collapse: collapse; width: 100%;'>
                <tbody>
                    <!-- Fila de encabezados -->
                    <tr>
                        <td style='width:20%; border: 0.75pt solid #000; padding: 5px; text-align: center; font-family: Arial; font-size: 12pt;'>C.I.</td>
                        <td style='width:20%; border: 0.75pt solid #000; padding: 5px; text-align: center; font-family: Arial; font-size: 12pt;'>ESTADO CIVIL</td>
                        <td style='width:20%; border: 0.75pt solid #000; padding: 5px; text-align: center; font-family: Arial; font-size: 12pt;'>SEXO</td>
                        <td style='width:20%; border: 0.75pt solid #000; padding: 5px; text-align: center; font-family: Arial; font-size: 12pt;'>F.N.</td>
                        <td style='width:20%; border: 0.75pt solid #000; padding: 5px; text-align: center; font-family: Arial; font-size: 12pt;'>TELEFONO</td>
                    </tr>
                    <!-- Fila de datos -->
                    <tr>
                        <td style='width:20%; border: 0.75pt solid #000; padding: 5px;text-align: center; font-family: Arial; font-size: 10pt;'>$cedula_trabajador</td>
                        <td style='width:20%; border: 0.75pt solid #000; padding: 5px;text-align: center; font-family: Arial; font-size: 10pt;'>$estado_civil_trabajador</td>
                        <td style='width:20%; border: 0.75pt solid #000; padding: 5px;text-align: center; font-family: Arial; font-size: 10pt;'>$genero_trabajador</td>
                        <td style='width:20%; border: 0.75pt solid #000; padding: 5px;text-align: center; font-family: Arial; font-size: 10pt;'>$fecha_nacimiento_trabajador</td>
                        <td style='width:20%; border: 0.75pt solid #000; padding: 5px;text-align: center; font-family: Arial; font-size: 10pt;'>$telefono_trabajador</td>
                    </tr>
                </tbody>
            </table>


            <br>

            <p style='margin-top:0pt; margin-bottom:10pt; line-height:115%; font-size:12pt;'>
                <span style='font-family:Arial;'>
                    ASEGURADO: $nombre_solicitante
                </span>
                <span style='font-family:Arial;'>
                    CEDULA: $cedula_solicitante
                </span>
            </p>

            <table cellspacing='0' cellpadding='0' style='border-collapse: collapse; width: 100%;'>
                <tbody>
                    <!-- Fila de encabezados -->
                    <tr>
                        <td style='border: 0.75pt solid #000; padding: 5px; background-color:#b6dde8; text-align:center; font-size:12pt; font-family:Arial;'>C.D.R.</td>
                        <td style='border: 0.75pt solid #000; padding: 5px; background-color:#b6dde8; text-align:center; font-size:12pt; font-family:Arial;'>Fecha del registro</td>
                        <td style='border: 0.75pt solid #000; padding: 5px; background-color:#b6dde8; text-align:center; font-size:12pt; font-family:Arial;'>Tipo de solicitud</td>
                        <td style='border: 0.75pt solid #000; padding: 5px; background-color:#b6dde8; text-align:center; font-size:12pt; font-family:Arial;'>Descripcion de la solicitud</td>
                        <td style='border: 0.75pt solid #000; padding: 5px; background-color:#b6dde8; text-align:center; font-size:12pt; font-family:Arial;'>Remitido a</td>
                        <td style='border: 0.75pt solid #000; padding: 5px; background-color:#b6dde8; text-align:center; font-size:12pt; font-family:Arial;'>Estatus</td>
                        <td style='border: 0.75pt solid #000; padding: 5px; background-color:#b6dde8; text-align:center; font-size:12pt; font-family:Arial;'>Monto en bs.</td>
                        <td style='border: 0.75pt solid #000; padding: 5px; background-color:#b6dde8; text-align:center; font-size:12pt; font-family:Arial;'>Monto en divisas</td>
                    </tr>

                    <!-- Fila de datos -->
                    $tabla_solicitudes

                    <!-- Fila con montos -->
                    <tr>
                        <td colspan='6' style='padding: 5px;'>&nbsp;</td>
                        <td style='border: 0.75pt solid #000; padding: 5px; text-align:center;background-color:#b6dde8;'>".$monto_total_bs. " bs</td>
                        <td style='border: 0.75pt solid #000; padding: 5px; text-align:center;background-color:#b6dde8;'>" . $monto_total_divisa . " $</td>
                    </tr>
                </tbody>
            </table>

            <br>

            <table cellspacing='0' cellpadding='0' style='border-collapse: collapse; width: 100%;'>
                <tbody>
                    <tr>
                        <td style='width:101.4pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top; background-color:#b6dde8;'>
                            <p style='margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:12pt;'>
                                <span style='font-family:Arial;'>
                                    Consumos por polizas
                                </span>
                            </p>
                        </td>
                        <td style='width:101.4pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top; background-color:#b6dde8;'>
                            <p style='margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:12pt;'>
                                <span style='font-family:Arial;'>
                                    Monto en bs.
                                </span>
                            </p>
                        </td>
                        <td style='width:101.45pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top; background-color:#b6dde8;'>
                            <p style='margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:12pt;'>
                                <span style='font-family:Arial;'>
                                    Monto en divisas
                                </span>
                            </p>
                        </td>
                        <td style='width:101.45pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top; background-color:#b6dde8;'>
                            <p style='margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:12pt;'>
                                <span style='font-family:Arial;'>
                                    Consumido por %
                                </span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style='width:101.4pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                            <p style='margin-top:0pt; margin-bottom:0pt; font-size:12pt;'>
                                <span style='font-family:Arial;'>
                                    Farmacia
                                </span>
                            </p>
                        </td>
                        <td style='width:101.4pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                            <p style='margin-top:0pt; margin-bottom:0pt; text-align: center; font-size:12pt;'>
                                <span style='font-family:Arial;'>
                                ".$monto_total_Bs_farmacia. " Bs.                               
                                </span>
                            </p>
                        </td>
                        <td style='width:101.45pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                            <p style='margin-top:0pt; margin-bottom:0pt; text-align: center; font-size:12pt;'>
                                <span style='font-family:Arial;'>
                                ".$monto_total_divisa_farmacia. " $
                                </span>
                            </p>
                        </td>
                        <td style='width:101.45pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                            <p style='margin-top:0pt; margin-bottom:0pt; text-align: center; font-size:12pt;'>
                                <span style='font-family:Arial;'>
                                ". $porcentaje_farmacia. " %
                                </span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style='width:101.4pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                            <p style='margin-top:0pt; margin-bottom:0pt; font-size:12pt;'>
                                <span style='font-family:Arial;'>
                                    Atencion Medica Primaria de salud
                                </span>
                            </p>
                        </td>
                        <td style='width:101.4pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                            <p style='margin-top:0pt; margin-bottom:0pt; text-align: center; font-size:12pt;'>
                                <span style='font-family:Arial;'>
                                ".$monto_total_Bs_aps. " Bs.
                                </span>
                            </p>
                        </td>
                        <td style='width:101.45pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                            <p style='margin-top:0pt; margin-bottom:0pt; text-align: center; font-size:12pt;'>
                                <span style='font-family:Arial;'>
                                ".$monto_total_divisa_aps. " $
                                </span>
                            </p>
                        </td>
                        <td style='width:101.45pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                            <p style='margin-top:0pt; margin-bottom:0pt; text-align: center; font-size:12pt;'>
                                <span style='font-family:Arial;'>
                                ". $porcentajeAPS. " %
                                </span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style='width:101.4pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                            <p style='margin-top:0pt; margin-bottom:0pt; font-size:12pt;'>
                                <span style='font-family:Arial;'>
                                    Reembolso
                                </span>
                            </p>
                        </td>
                        <td style='width:101.4pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                            <p style='margin-top:0pt; margin-bottom:0pt; text-align: center; font-size:12pt;'>
                                <span style='font-family:Arial;'>
                                ".$monto_total_Bs_reembolso. " Bs.
                                </span>
                            </p>
                        </td>
                        <td style='width:101.45pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                            <p style='margin-top:0pt; margin-bottom:0pt; text-align: center; font-size:12pt;'>
                                <span style='font-family:Arial;'>
                                ".$monto_total_divisa_reembolso. " $
                                </span>
                            </p>
                        </td>
                        <td style='width:101.45pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                            <p style='margin-top:0pt; margin-bottom:0pt; text-align: center; font-size:12pt;'>
                                <span style='font-family:Arial;'>
                                ". $porcentajeReembolso. " %
                                </span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style='width:101.4pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                            <p style='margin-top:0pt; margin-bottom:0pt; font-size:12pt;'>
                                <span style='font-family:Arial;'>
                                    Poliza funeraria
                                </span>
                            </p>
                        </td>
                        <td style='width:101.4pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                            <p style='margin-top:0pt; margin-bottom:0pt; text-align: center; font-size:12pt;'>
                                <span style='font-family:Arial;'>
                                ".$monto_total_Bs_funeraria. " Bs.
                                </span>
                            </p>
                        </td>
                        <td style='width:101.45pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                            <p style='margin-top:0pt; margin-bottom:0pt; text-align: center; font-size:12pt;'>
                                <span style='font-family:Arial;'>
                                ".$monto_total_divisa_funeraria. " $
                                </span>
                            </p>
                        </td>
                        <td style='width:101.45pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                            <p style='margin-top:0pt; margin-bottom:0pt; text-align: center; font-size:12pt;'>
                                <span style='font-family:Arial;'>
                                ". $porcentajeFuneraria. " %
                                </span>
                            </p>
                        </td>
                    </tr>            
                </tbody>
            </table>

            <br>

            <br>

            <table cellspacing='0' cellpadding='0' style='border: 0.75pt solid rgb(0, 0, 0); border-collapse: collapse; width: 100%;'>
                <tbody>
                    <tr style='height:14.2pt;'>
                        <td style='width:138.8pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                            <p style='margin-top:0pt; margin-bottom:10pt; text-align:center; line-height:115%; font-size:8pt;'>
                                <span style='font-family:Arial;'>
                                    ELABORADO POR
                                </span>
                            </p>
                        </td>
                        <td style='width:156.85pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                            <p style='margin-top:0pt; margin-bottom:10pt; text-align:center; line-height:115%; font-size:8pt;'>
                                <span style='font-family:Arial;'>
                                    JEFE DE UNIDAD DE ATENCION PRIMARIA
                                </span>
                            </p>
                        </td>
                        <td style='width:120.85pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                            <p style='margin-top:0pt; margin-bottom:10pt; text-align:center; line-height:115%; font-size:8pt;'>
                                <span style='font-family:Arial;'>
                                    COORDINADOR DE TALENTO HUMANO
                                </span>
                            </p>
                        </td>
                    </tr>
                    <tr style='height:64.3pt;'>
                        <td style='width:138.8pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                            <p style='margin-top:0pt; margin-bottom:10pt; line-height:115%; font-size:30pt;'>
                                <span style='font-family:Arial;'>
                                    &nbsp;
                                </span>
                            </p>
                        </td>
                        <td style='width:156.85pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                            <p style='margin-top:0pt; margin-bottom:10pt; line-height:115%; font-size:12pt;'>
                                <span style='font-family:Arial;'>
                                    &nbsp;
                                </span>
                            </p>
                        </td>
                        <td style='width:120.85pt; border-top-style:solid; border-top-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;'>
                            <p style='margin-top:0pt; margin-bottom:10pt; line-height:115%; font-size:12pt;'>
                                <span style='font-family:Arial;'>
                                    &nbsp;
                                </span>
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <br>
            </div>
            <footer>
                <img src='$img_institucional' style = 'width : 100%; height: 200px;'>
            </footer>    

    </body>
</html>";
            
            $dompdf->loadHtml(utf8_decode($html));
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

            $solicitudes = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!$solicitudes) {
                return null;
            }

           return $solicitudes;
        } catch (PDOException $e) {
            return null;
        }
    }

    private function obtener_porcentaje ($total_divisa, $poliza) {
        
        if ($total_divisa == 0 || $poliza == 0) {
            return 0;
        }

        $porcentajeFuneraria = ($total_divisa / $poliza) * 100;

        $porcentaje_formateado_funeraria = number_format($porcentajeFuneraria, 2); 

        return $porcentaje_formateado_funeraria;
    }

    private function image_to_base64($image_path){
        $imagenData = base64_encode(file_get_contents($image_path));
        $imagenTipo = mime_content_type($image_path);
        $imagen_logo = "data:$imagenTipo;base64,$imagenData";
        return $imagen_logo;
    }
   
}
