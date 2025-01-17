<?php
try {
    //inicializacion de instancia env
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();
    
    define('LOCAL', $_ENV['local']);
    define('NOMBREBD', $_ENV['nombrebd']);
    define('USUARIO', $_ENV['usuario']);
    define('CONTRASENA', $_ENV['contrasena']);
} catch (\Throwable $th) {
    die('Error: no existe .env');
}
