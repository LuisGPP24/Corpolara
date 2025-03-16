<?php

namespace modelo;

use modelo\conexion as conexion;
use PDO;
use PDOException;
use Dompdf\Dompdf;
use Dompdf\Options;

    class ReportesModelo extends conexion{

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
    public function generarReporte(){

        try {
            $bd = $this->conecta();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $solicitudes = $this->listarSolicitudes();

            if (!$solicitudes) {
                echo json_encode(["error" => "No hay solicitudes"]);
                return;
            }

            $dompdf = new Dompdf();

            $html = '<img src="assets/img/imagen.jpg" style="width:225px">';
            $html = '<h1>Reporte de Solicitudes</h1><p>Contenido del reporte aquí...</p>';
            
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
   
}
