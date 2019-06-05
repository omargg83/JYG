<?php
	session_start();
	
	class objx {
		public $activo = 0;
		public $texto = "";
	}
	$myObj = new objx;

	if($_SESSION['autoriza'] == '1' and strlen($_SESSION['idpersona'])>0) {
		$myObj->activo = 1;
		$myObj->texto = "nada";
		$myJSON = json_encode($myObj);
		echo $myJSON;
	} 
	else {
		$myObj->activo = 0;
		$myObj->texto="<form id='acceso' action=''>
			<div class='container'>
				<h1 class='welcome text-center'></h1>
				<div class='card card-container'>
					<h2 class='login_title text-center'>Salud Pública</h2>
						<hr><center><img src='img/SSH.png' width='250px'></center>
						
						<p class='input_title'>Usuario:</p>
						<div class='form-group input-group'>
							<div class='input-group-prepend'>
								<span class='input-group-text'> <i class='fas fa-user-circle'></i> </span>
							</div>
							<input class='form-control' placeholder='Introduzca usuario' type='text'  id='userAcceso' name='userAcceso' required>
						</div>
						
						<p class='input_title'>Contraseña:</p>
						<div class='form-group input-group'>
							<div class='input-group-prepend'>
								<span class='input-group-text'> <i class='fa fa-lock'></i> </span>
							</div>
							<input class='form-control' placeholder='Contraseña' type='password'  id='passAcceso' name='passAcceso' required>
						</div>
						
						<br>
						<button class='btn btn-secondary btn-block' type='submit'><i class='fa fa-check'></i>Aceptar</button>
				</div>
			</div>
		</form>";
		$myJSON = json_encode($myObj);
		echo $myJSON;
	}	
?>