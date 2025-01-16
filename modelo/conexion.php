<?php 

class conexion {

    private $usuario = "root"; 
    private $contrasena = ""; 
    private $local = "localhost"; 
    private $nombrebd = "bdluis"; 

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


}



?>