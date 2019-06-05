<nav class="navbar navbar-expand-sm navbar-dark fixed-top bg-dark">
		<button class="btn btn-outline-secondary" type="button" id="sidebarCollapse">
		  <span class="navbar-toggler-icon"></span>
		</button>
		
		<img src='img/Escudo.png' width='40' height='30' alt=''>
		<img src='img/SSH.png' width='40' height='30' alt=''>

		<a class="navbar-brand" href="#escritorio/dashboard" style='font-size:10px'>Sistema Administrativo de Salud Pública</a>
		
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#principal" aria-controls="principal" aria-expanded="false" aria-label="Toggle navigation">
			<i class="fab fa-rocketchat"></i>
		</button>
		
		<div class="collapse navbar-collapse" id="principal">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item dropdown">
					<a class="nav-link navbar-brand" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					</a>
				</li>
			</ul> 
		
			<ul class="nav navbar-nav navbar-right">
			<?php
				echo '<ul class="nav navbar-nav navbar-right" id="chatx"></ul>';
				$directory="fondo/";
				$dirint = dir($directory);
				echo "<ul class='nav navbar-nav navbar-right'>";
					echo "<li class='nav-item dropdown'>";
						echo "<a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fas fa-desktop'></i>Fondos</a>";
						echo "<div class='dropdown-menu' aria-labelledby='navbarDropdown' style='width: 200px;max-height: 400px !important;overflow: scroll;overflow-x: scroll;overflow-x: hidden;'>";
							while (($archivo = $dirint->read()) !== false){
								if ($archivo != "." && $archivo != ".." && $archivo != "" && substr($archivo,-4)==".jpg"){
									echo "<a class='dropdown-item' href='#' id='fondocambia' title='Click para aplicar el fondo'><img src='$directory".$archivo."' alt='Fondo' class='rounded' style='width:140px;height:80px'></a>";
								}
							}
						echo "</div>";
					echo "</li>";
				echo "</ul>";
				$dirint->close();
			?>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<?php
							if (file_exists("a_personal/papeles/".trim($_SESSION['foto']))){
								echo "<img src='a_personal/papeles/".trim($_SESSION['foto'])."' class='rounded-circle' width='20px' height='20px'>";
							}
							else{
								echo "<img src='a_personal/Screenshot_1.png' alt='Cuenta' class='rounded-circle' width='20px' height='20px'>";
							}
							echo "  ".$_SESSION['nick'];
						?>
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					  <?php
						echo "<a class='dropdown-item' id='winmodal_pass' data-id='".$_SESSION['idpersona']."' data-lugar='a_personal/form_pass' title='Cambiar contraseña' ><i class='fas fa-key'></i>Contraseña</a>";
						if($_SESSION['administrador']==1){
							echo "<a class='dropdown-item' id='winmodal_pass' data-id='".$_SESSION['idpersona']."' data-lugar='a_personal/form_pass' title='Cambiar contraseña' ><i class='fas fa-key'></i>Usuario</a>";
						}
					  ?>
					</div>
				</li>
			</ul> 

			<ul class='nav navbar-nav navbar-right'>
				<li class="nav-item">
					<a class="nav-link pull-left" href="acceso/salir.php">
						<i class="fas fa-door-open" style="color:red;"></i>Salir
					</a>
				</li>
			</ul>
		</div>
	</nav>