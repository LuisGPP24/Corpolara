<?php 

    namespace modelo;

    use modelo\conexion as conexion;
    use PDO;
    use PDOException;
    
    class reportesEstadisticosModelo extends conexion{

    	public function obtenerNumeroSolicitudes(){

    		$sentencia = "SELECT COUNT(*) AS total FROM solicitudes";
            return select($sentencia)[0]->total;
        }

        public function obtenerNumeroTrabajadoresActivos(){

    		$sentencia = "SELECT COUNT(*) AS total FROM trabajadores WHERE personal_contratado ='activo'";
            return select($sentencia)[0]->total;
        }

        public function obtenerNumeroTrabajadoresJubilados(){

    		$sentencia = "SELECT COUNT(*) AS total FROM trabajadores WHERE personal_contratado ='jubilado'";
            return select($sentencia)[0]->total;
        }

        public function obtenerDineroAprobado(){

    		$sentencia = "SELECT SUM(monto_aprobado) as total_monto FROM solicitudes";
            return select($sentencia)[0]->total;
        }
    
    }
?>