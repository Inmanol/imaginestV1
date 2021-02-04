<?php

    require_once('./bd/connecta_db.php');
    require_once('./lib/controlUsuaris.php');
    require_once('login.php');
    session_start();

    if(isset($_SESSION['usuari'])){
        header("Location: logout.php");
        exit;
    }/*else{
        //Assignem el nom de la cookie en funció del usuari (via hash per privacitat)
        $usu = usuarioEnSesion($usermail);
        $_SESSION['usuari'] = $usu;
    }*/
    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="initial-scale=1, maximum-scale=1">
        <title>Home</title>
        <link rel="stylesheet" type="text/css" href="./css/main.css" />
        <link rel="icon" href="./img/iconoImaginest.png" />
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body>
        <div id="container2">
            <div class="row">
                <div class="col-lg-12 col-md-8 home-box">
                    <div class="col-lg-12 home-title">
                        <?php
                            
                            echo "<h2>BENVINGUT " . $_SESSION['usuari'] . "</h2>"; 
                        ?>
                    </div>
                    <div class="col-lg-12 loginbttm">
                        <a href="logout.php" class="btn btn-outline-primary">LOGOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
