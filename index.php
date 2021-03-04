<?php

	session_start();

	if(isset($_SESSION['usuari']))
	{
		header("location: home.php");
		exit();
	}

	require_once('./bd/connecta_db.php');
	//require_once('./lib/controlUsuaris.php');
    if($_SERVER["REQUEST_METHOD"] == "POST"){
		$usermail = filter_input(INPUT_POST,'usermail');
        $sql = "SELECT mail, username, passHash FROM users WHERE username = '$usermail' or email = '$usermail'";
        $exis = $db->query($sql);
        if($exis){

            $_SESSION['usuari'] = $usuaris['username'];

            $sql = "UPDATE users SET active = ? WHERE username = ? or email = ?";

            $preparadaUpdate = $db->prepare($sql);
            $preparadaUpdate->execute(array('1',$usermail,$usermail));

            if($preparadaUpdate)
            {
                header("Location: home.php");
                exit;
            }   
        }else $error = true;
    }else
	{
		if(isset($_GET['activationCode']) && isset($_GET['email'])) require_once('control/activacionRegis.php');

	}
?>	

<!DOCTYPE html>
<html lang="es">
<head>
	<title>ImagiNest</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/bombi.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	<?php
		if(isset($login)){
			echo "<script> alert('Login correcto!'); </script>";
		}else if(isset($error)){
			echo "<script> alert('El usuario/correo o la contraseña son incorrectas'); </script>";
		}
		if(isset($activado))
		{
			echo "<script> alert('Tu cuenta se ha activado con exito'); </script>";
		}
	?>
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<span class="login100-form-logo">
						<i class="zmdi zmdi-landscape"></i>
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Log in
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="usermail" placeholder="Username">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">
							Remember me
						</label>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
						<!--<input id="log" type="submit" class="login100-form-btn" value="Login">-->
					</div>

					<div class="text-center p-t-30">
						<a class="txt1" href="changePasswordHTML.php">
							Forgot Password?
						</a>
					</div>
					<div class="text-center p-t-30">
						<p class="txt1">Don't have account yet?</p>
					</div>
					<div class="container-login100-form-btn">
						<a href="register.php" class="login100-form-btn">Singin</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>