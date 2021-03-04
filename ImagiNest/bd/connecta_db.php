<?php
    $cadena_connexio = 'mysql:dbname=imaginest;host=localhost';
    $usuari = 'root';
    $passwd = 'root';
    try{
        //Ens connectem a la BDs
        $db = new PDO($cadena_connexio, $usuari, $passwd, array(PDO::ATTR_PERSISTENT => true));
    }catch(PDOException $e){
        echo 'Error amb la BDs: ' . $e->getMessage();
        exit();
    }