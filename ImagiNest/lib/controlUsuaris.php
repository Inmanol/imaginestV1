<?php

    function insertarNuevoUsu($mail,$user,$pass,$firstname,$lastname)
    {
        require_once('./bd/connecta_db.php');

        base64_encode($pass);
        $hoy = getdate();
        $hora = date("H:i:s");
        $sql = "INSERT INTO users(mail,username,passHash,userFirstName,userLastName,creationDate,lastSignIn) 
            VALUES(?,?,?,?,?,?,?)";

        $preparadaInsert = $db->prepare($sql);
        $preparadaInsert->execute(array($mail,$user,$pass,$firstname,$lastname,$hoy,$hora)); 
    }

    function usuarioEnSesion($usermail)
    {
        require_once('./bd/connecta_db.php');

        $sql = 'SELECT username FROM users WHERE username = ? or mail = ?';
        $usuario = $db->prepare($sql);
        $usuario->execute(array($usermail,$usermail));

        return $usuario;
    }

    function checkUser($user,$mail){
        require_once('./bd/connecta_db.php');

        try{
            $sql = "SELECT count(username) FROM users WHERE mail = '$mail' or username = '$user'";
            $exis = $db->query($sql);
            $res = $exis->fetch();

        }catch(PDOException $e){
            echo 'Error amb la BDs: ' . $e->getMessage();
        }
        return ($res[0]==1 ? true : false);
    }