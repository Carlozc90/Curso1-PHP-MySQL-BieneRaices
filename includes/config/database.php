<?php

function conectarDB() : mysqli{
    $db = new mysqli('localhost','root','root','bienes_raices',3306);

    if(!$db){
        echo "Error no se pudo conectar";
        exit;
    }

    return $db;
}