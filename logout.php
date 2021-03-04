<?php
    require_once('./bd/connecta_db.php');
    //require_once("login.php");

    session_start();

    $_SESSION = array();

    session_destroy();

    setcookie(session_name(),"",time()-3600,"/");

    $sql = "UPDATE users SET active = ? 
                WHERE username = ? or mail = ?";

    $preparadaUpdate = $db->prepare($sql);
    $preparadaUpdate->execute(array('0',$usermail,$usermail));

    if($preparadaUpdate)
    {
        header("Location: home.php");
        exit;
    }

    //Redirecció a Index
    header("Location: index.php");
    exit;
