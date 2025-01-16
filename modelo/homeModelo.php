<?php 

    class homeModelo {

        private $nombre;

        public function set_nombre($valor)
        {
            $this->nombre = $valor;
        }

        public function saludar(){
            return $this->nombre;
        }


    }

?>