<?php

    require_once('./bd/connecta_db.php');
    require_once('./lib/controlUsuaris.php');

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $usu = checkUser($_POST['user'], $_POST['email']);
        if($usu){
            $error = true;
        }else{
            $passHash = password_hash($_POST['pass'], PASSWORD_DEFAULT);
            insertarNuevoUsu($_POST['email'],$_POST['user'],$passHash,$_POST['firstname'],$_POST['lastname']);
            header("Location: login.php");
            exit;
        }
    }
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="initial-scale=1, maximum-scale=1">
        <title>Portal Login del treballador</title>
        <link rel="stylesheet" type="text/css" href="./css/main.css" />
        <link rel="icon" href="./img/iconoImaginest.png" />
        <!--<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
        <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <?php
                if(isset($error)){
                    echo "<script> alert('Aquest usuari ja existeix'); </script>";
                }
            ?>
            <div class="row">
                <div class="col-lg-3 col-md-2"></div>
                    <div class="col-lg-6 col-md-8 login-box">
                        <div class="col-lg-12 login-key">
                           <i class="fa fa-key" aria-hidden="true"></i>
                        </div>
                        <div class="col-lg-12 login-title">
                            REGISTER PANEL
                        </div>

                        <div class="col-lg-12 login-form">
                            <div class="col-lg-12 login-form">
                                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="return codificarForm()">
                                    <div class="form-group">
                                        <label class="form-control-label">USUARIO</label>
                                        <input type="text" name="user" class="form-control" require>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">E-MAIL</label>
                                        <input type="email" name="email" class="form-control" require>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">NOMBRE</label>
                                        <input type="text" name="firstname" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">APELLIDOS</label>
                                        <input type="text" name="lastname" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">CONTRASEÑA</label>
                                        <input type="password" name="pass" class="form-control" require>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">VERIFICAR CONTRASEÑA</label>
                                        <input type="password" name="passwordverify" class="form-control" require>
                                    </div>

                                    <div class="col-lg-12 loginbttm">
                                        <div class="col-lg-6 login-btm login-text">
                                        <!-- Error Message -->
                                        </div>
                                        <div class="col-lg-6 login-btm login-button">
                                            <button type="submit" class="btn btn-outline-primary">REGISTER</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                <div class="col-lg-3 col-md-2"></div>
            </div>
        </div>
        </div>
    </body>
</html>