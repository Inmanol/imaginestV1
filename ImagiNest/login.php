<?php

    function checkUserLogin($usermail,$pass){
        require_once('./bd/connecta_db.php');
        $usu = false;
        base64_decode($pass);
        try{
            $sql = 'SELECT mail, username, passHash FROM users WHERE username = $usermail or mail = $usermail';
            $usuaris = $db->query($sql);
            if(($usuaris['mail'] == $usermail || $usuaris['username'] == $usermail) && password_verify($pass,password_hash($usuaris['passHash'],PASSWORD_DEFAULT))){
                $usu = true;
            }
        }catch(PDOException $e){
            echo 'Error amb la BDs: ' . $e->getMessage();
        }
        return $usu;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $usu = checkUserLogin($_POST['usermail'], $_POST['pass']);
        if($usu){
            session_start();
            $_SESSION['usuari'] = $usuaris['username'];

            $sql = "UPDATE users SET active = ? WHERE username = ? or mail = ?";

            $preparadaUpdate = $db->prepare($sql);
            $preparadaUpdate->execute(array('1',$usermail,$usermail));

            if($preparadaUpdate)
            {
                $login = true;
                header("Location: home.php");
                exit;
            }   
        }else $error = true;
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
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

    <body>  

        <div class="container">
            <?php
                if(isset($login)){
                    echo "<script> alert('Login correcte!'); </script>";
                }else if(isset($error)){
                    echo "<script> alert('L'usuari/correo o la contrasenya són incorrectes'); </script>";
                }
            ?>
            <div class="row">
                <div class="col-lg-3 col-md-2"></div>
                    <div class="col-lg-6 col-md-8 login-box">
                        <div class="col-lg-12 login-key">
                           <i class="fas fa-lightbulb" aria-hidden="true"></i>
                           <h1 class="login-name">IMAGINEST</h1>
                        </div>
                        <div class="col-lg-12 login-title">
                            LOGIN PANEL
                        </div>

                        <div class="col-lg-12 login-form">
                            <div class="col-lg-12 login-form">
                                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="return codificarForm()">
                                    <div class="form-group">
                                        <label class="form-control-label">USERNAME</label>
                                        <input type="text" name="usermail" class="form-control" require value="<?php if(isset($usermail)) echo $usermail;?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">PASSWORD</label>
                                        <input type="password" name="pass" class="form-control" require>
                                    </div>

                                    <div class="col-lg-12 loginbttm">
                                        <div class="col-lg-7 login-btm login-text">      
                                            <input type="checkbox" id="checkbox-2-1" class="checkbox" checked="checked"/>
                                            <span id="remember">Remember me</span>
                                            <span id="forgotten">Forgotten password</span>
                                        </div>
                                        <div class="col-lg-5 login-btm login-button">
                                            <input type="submit" class="btn btn-outline-primary" value="LOGIN">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 loginbttm">
                                        <div class="col-lg-9 login-btm login-text">
                                            <p id="signin">Don't have account yet?</p>
                                        </div>
                                        <div class="col-lg-3 login-btm login-button">
                                            <a href="register.php" class="btn btn-outline-primary">SIGNIN</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="forgotten-container">
                                <h1>Forgotten</h1>
                                    <input type="email" name="email" placeholder="E-mail">
                                    <a href="#" class="orange-btn">Obtener nueva contraseña</a>
                            </div>
                        </div>
                <div class="col-lg-3 col-md-2"></div>
            </div>
        </div>
        </div>
    </body>
</html>