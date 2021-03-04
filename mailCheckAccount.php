<?php

    require_once('./bd/connecta_db.php');
    require_once('./lib/controlUsuaris.php');

    $code = $_GET['code'];
    $email = $_GET['mail'];
    if(!empty($code) && !empty($email))
    {
        $verify = verificarCorreu($code,$email);
        if($verify)
        {
            activaCompte($email);
            header("Location: index.php");
            exit;
        }
    }
    else
    {
        echo "<h3>Ha habido un error en la activación de tu cuenta </h3>";
    }
    
    
