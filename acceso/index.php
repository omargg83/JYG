<?php
	include "../_ses.php";
	require_once("../control_db.php");
	$llave="";
	if (isset($_REQUEST['llave'])){$llave=trim($_REQUEST['llave']);}
	$cal = new Salud();
	$res=$cal->recuperar($llave);

	if(!is_array($res)){
		die();
	}
?>

<!DOCTYPE HTML>
<html lang="es">
<head>
	<title>Salud Pública</title>
	<link rel="icon" type="image/png" href="img/favicon.ico">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<script src="../librerias15/jquery-3.3.1.min.js" type="text/javascript"></script>
	<script src="../librerias15/jquery/jquery-ui.js"></script>
	
	<script src="../librerias15/swal/dist/sweetalert2.min.js"></script>
	<link rel="stylesheet" href="../librerias15/swal/dist/sweetalert2.min.css">

	<link rel="stylesheet" href="../librerias15/css/bootstrap.min.css">
	<script src="../librerias15/js/bootstrap.min.js"></script>
	
	<link rel="stylesheet" type="text/css" href="../librerias15/modulos.css"/>
	
	<link rel="stylesheet" href="../librerias15/fontawesome-free-5.8.1-web/css/all.css">	
	<script src="../librerias15/jQuery-MD5-master/jquery.md5.js"></script>
	
</head>


	<?php

		echo "<body style='background-color: black'>";
	?>

	<div id='data'>
		<form id='passx' data-lugar='../a_personal/personal_db' data-funcion='password'>
		<br>
		<br>
		<br>
			<div class='container'>
				<div class='logincard' style='
				-webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
				-moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
				box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);'>
						<input class="form-control" placeholder="Contraseña" type="hidden"  id="usuario" name="usuario" value='<?php echo $llave; ?>'>
						<br>
						<h5>RESTABLECER CONTRASEÑA</h5>
						<p class='input_title'>Escriba nueva contraseña:</p>
						<div class="form-group input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"> <i class="fas fa-user-circle"></i> </span>
							</div>
							<input class="form-control" placeholder="Contraseña" type="password"  id="pass1" name="pass1" required autocomplete="new-password">
						</div>
						
						<p class='input_title'>Repetir contraseña:</p>
						<div class="form-group input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
							</div>
							<input class="form-control" placeholder="Contraseña" type="password"  id="pass2" name="pass2" required autocomplete="new-password">
						</div>
						<button class="btn btn-secondary btn-block" type="submit"><i class='fa fa-check'></i>Aceptar</button>
						<center>http://spublicahgo.ddns.net</center>
				</div>
			</div>
		</form>
	</div>
</body>
</html>

<script type="text/javascript">
	$(document).on('submit','#passx',function(e){
		e.preventDefault();

		var usuario=document.getElementById("usuario").value;
		var pass1=$.md5(document.getElementById("pass1").value);
		var pass2=$.md5(document.getElementById("pass2").value);
		console.log(usuario);

		var parametros={
			"usuario":usuario,
			"pass1":pass1,
			"pass2":pass2,
			"function":"password_cambia"
		}; 
		
		
		$.ajax({
			url: "../acceso_db.php",
			type: "POST",
			data: parametros
		}).done(function(echo){
			console.log(echo);
			if (echo==1){
				window.location.replace("../");
			}
			else{
				Swal.fire({
					  type: 'error',
					  title: 'Contraseña incorrecta',
					  showConfirmButton: false,
					  timer: 1000
				})
			}

		});
	});
</script>