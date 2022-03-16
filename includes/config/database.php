<?php

function conectarDB() : mysqli{
    $db = new mysqli( $_ENV['BD_HOST'] ,$_ENV['BD_USER'],$_ENV['BD_PASS'],$_ENV['BD_NOMBRE'],$_ENV['BD_PORT']);

    if(!$db){
        echo "Error no se pudo conectar";
        exit;
    }

    return $db;
}