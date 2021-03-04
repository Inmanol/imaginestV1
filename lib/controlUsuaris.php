<?php

    function insertarNuevoUsu($mail, $user, $pass, $firstname, $lastname, $active)
    {
        require_once('./bd/connecta_db.php');

        $activationCode = hash('sha256', random_int(1, 1000));
        $hoy = getdate();
        $hora = date("H:i:s");
        $sql = "INSERT INTO users (email, username, passHash, userFirstName, userLastName, creationDate, lastSignIn, active, activationCode) 
        VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $insert = $db->prepare($sql);
        $insert->execute(array($mail, $user, $pass, $firstname, $lastname, $hoy, $hora, $active, $activationCode)); 

        if(!$insert)
        {
            echo "<script> alert('No se ha podido insertar este usuario'); </script>";
        }

    }

    function usuarioEnSesion($usermail)
    {
        require_once('./bd/connecta_db.php');

        $sql = "SELECT username FROM users WHERE username = '$usermail' or email = '$usermail'";
        $usuario = $db->query($sql);
        if($usuario) return $usuario;
        else echo "Este usuario no existe";
        
    }

    function checkUserRegis($user,$mail){
        require_once('./bd/connecta_db.php');

        try{
            $sql = "SELECT count(username) FROM users WHERE email = '$mail' or username = '$user'";
            $exis = $db->query($sql);
            $res = $exis->fetch();

        }catch(PDOException $e){
            echo 'Error amb la BDs: ' . $e->getMessage();
        }
        return ($res[0]==1 ? true : false);
    }

    function checkUserLogin($usermail){
        require_once('./bd/connecta_db.php');

        try{
            $sql = "SELECT mail, username, passHash FROM users WHERE username = '$usermail' or email = '$usermail'";
            $exis = $db->query($sql);
            $res = $exis->fetch();

        }catch(PDOException $e){
            echo 'Error amb la BDs: ' . $e->getMessage();
        }
        return ($res[0]==1 ? true : false);
    }

    function verificarCorreu($code,$email)
    {
        require_once('./bd/connecta_db.php');

        try{
            $sql = "SELECT mail, activationCode FROM users WHERE email = '$email' and activationCode = '$code'";
            $exis = $db->query($sql);
            $res = $exis->fetch();

        }catch(PDOException $e){
            echo 'Error amb la BDs: ' . $e->getMessage();
        }
        return ($res[0]==1 ? true : false);
    }

    function activaCompte($email)
    {
        require_once('./bd/connecta_db.php');

        try{
            $sql = "SELECT email FROM users WHERE email = '$email'";
            $exis = $db->query($sql);
            if($exis)
            {
                $data = getdate();
                $sql = "UPDATE users SET activationDate = '$data' and activationCode = '1' 
                    WHERE email = '$email'";
                $update = $db->query($sql);
                if(!$update) echo "No se ha podido activar esta cuenta";
            }

        }catch(PDOException $e){
            echo 'Error amb la BDs: ' . $e->getMessage();
        }
        
    }

    function checkUserChangePass($usermail){
        require_once('./bd/connecta_db.php');

        try{
            $sql = "SELECT email, username, passHash FROM users WHERE username = '$usermail' or email = '$usermail'";
            $exis = $db->query($sql);
            $res = $exis->fetch();

        }catch(PDOException $e){
            echo 'Error amb la BDs: ' . $e->getMessage();
        }
        return ($res[0]==1 ? true : false);
    }

    