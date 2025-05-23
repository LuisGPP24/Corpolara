<?php 

    namespace modelo;

    use modelo\conexion as conexion;
    use PDO;
    use PDOException;
    
    class reportesEstadisticosModelo extends conexion{

        public function obtener_trabadores() {
            try{

                $bd = $this->conecta();
                $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT 
                            SUM(CASE WHEN personal_contratado = 'activo' THEN 1 ELSE 0 END) AS trabajadores_activos,
                            SUM(CASE WHEN personal_contratado = 'jubilado' THEN 1 ELSE 0 END) AS trabajadores_jubilados
                        FROM trabajadores;";

                $stmt = $bd->prepare($sql);

                $stmt->execute();

                return $stmt->fetch(PDO::FETCH_ASSOC);


                
                
            } catch (PDOException $e) {
                http_response_code(500);
                return ["trabajadores_activos" => 0, "trabajadores_jubilados" => 0 ];
            }
        }
        public function obtener_solicitudes() {
            try{

                $bd = $this->conecta();
                $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT COUNT(id) as solicitudes FROM solicitudes;";

                $stmt = $bd->prepare($sql);

                $stmt->execute();

                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

                return $resultado['solicitudes'] ?? 0;
                
            } catch (PDOException $e) {
                http_response_code(500);
                return 0;
            }
        }
        public function obtener_bolivares_solicitudes() {
            try{

                $bd = $this->conecta();
                $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT SUM(monto_aprobado) as monto_aprobado FROM solicitudes;";

                $stmt = $bd->prepare($sql);

                $stmt->execute();

                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

                return $resultado['monto_aprobado'] ?? 0;
                
                
            } catch (PDOException $e) {
                http_response_code(500);
                return 0;
            }
        }
        
        public function obtener_solicitudes_por_status(){

            try {

                $bd = $this->conecta();
                $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT estatus, COUNT(estatus) as cantidad FROM `solicitudes` GROUP by estatus;";

                $stmt = $bd->prepare($sql);

                $stmt->execute();

                $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

                return json_encode($resultado);
            } catch (PDOException $e) {
                http_response_code(500);
                return 0;
            }
        }


        public function obtener_solicitudes_por_tipo(){

            try {

                $bd = $this->conecta();
                $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT tipo_solicitud, COUNT(tipo_solicitud) as cantidad FROM `solicitudes` GROUP by tipo_solicitud;";

                $stmt = $bd->prepare($sql);

                $stmt->execute();

                $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

                return json_encode($resultado);
            } catch (PDOException $e) {
                http_response_code(500);
                return 0;
            }
        }   	
    
    }
?>