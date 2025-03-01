<?php 
namespace modelo;
use PDO;
use PDOException;
class conexion {

    private $usuario = USUARIO; 
    private $contrasena = CONTRASENA; 
    private $local = LOCAL; 
    private $nombrebd = NOMBREBD; 

    protected function conecta(){
		try{
			$pdo = new PDO("mysql:host={$this->local};dbname={$this->nombrebd}", $this->usuario , $this->contrasena);

			$pdo->exec("SET NAMES 'utf8'");
			return $pdo;
		}catch (PDOException $e) {
			print "¡Error!: " . $e->getMessage() . "<br/>";
			die();
		}
	}

	protected function val_string($pattern,$value){

		$value = trim($value);
        $matches = preg_match_all($pattern, $value);

        return $matches > 0;
	}

	protected function registrar_bitacora($cedula, $accion, $id_modulos){

        $sql = "INSERT INTO bitacora (cedula_usuario, id_modulos, fecha_registro, hora_registro, accion) 
        VALUES(:cedula, :id, CURDATE(), CURTIME(), :accion)";

        $stmt = $this->conecta()->prepare($sql);

        $stmt->execute(array(
            ":cedula" => $cedula,
            ":id" => $id_modulos,
            ":accion" => $accion
        ));
    }


}
?>