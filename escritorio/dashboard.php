<?php
	require_once("../control_db.php");

	echo "<div class='container-fluid'><br>";
	
		echo "<div class='alert alert-danger' style='opacity:.9'>";
		echo "<b>Nota:</b> Si el sistema presenta algún error favor de presionar juntas las teclas Control+ F5 (Ctrl+F5), ya que constantemente se están subiendo actualizaciones y esto permite tener la última versión actualizada..";
		echo "</div>";
	
	
	echo "</div>";
	
?>
	<div class='container-fluid'>
		<div class='row'>
			<div class='col-12 col-sm-12 col-md-12 col-lg-6 col-xl-4' style='opacity:.9'>
				<div class="alert alert-light" style='width:100%;height:300px; overflow:auto;'>
					<b><center>Cuentas de personal
					<?php 
						//if(array_key_exists('PERSONAL', $bdd->derecho) and $bdd->derecho['PERSONAL']['acceso']==1)
						echo "<a class='btn btn-outline-info btn-sm float-right' href='#a_personal/personal' title='ir'><i class='fas fa-glasses'></i></a></center></b>";
					?>
					<canvas id="personal" height='200' width='200'></canvas>
				</div>
			</div>
			
			<div class='col-12 col-sm-12 col-md-12 col-lg-6 col-xl-4' style='opacity:.9'>
				<div class="alert alert-light" style='width:100%;height:300px; overflow:auto;'>
					<b><center>C. de Entrada
					<?php 
						//if(array_key_exists('CORRESPONDENCIA', $bdd->derecho) and $bdd->derecho['CORRESPONDENCIA']['acceso']==1)
						echo "<a class='btn btn-outline-info btn-sm float-right' href='#a_corresp/entrada' title='ir'><i class='fas fa-glasses'></i></a>";
						echo "</center></b>";
					?>
					<canvas id="speedChart" height='400' width='200'></canvas>
				</div>
			</div>
			
			
		</div>
	</div>
<?php
	echo "<div class='container-fluid'><br>";
		echo "<div class='row'>";	
			echo "<div class='col-sm-4' style='opacity:.9'>";
				echo "<div class='alert alert-light'>";
				echo "<i class='fas  fa-arrow-circle-right'></i> <b>Misión</b>";
				echo "<p>Garantizar la protección delos datos de nuestros clientes definiendo, implementando y evaluando políticas, programas y servicios encaminados a la investigación, promoción, prevención, restauración y conservaci&oacute;n de los mismos, a través de una atención integral, basada en criterios de excelencia y calidad.</p>";
				echo "</div>";
			echo "</div>";
			
			echo "<div class='col-sm-4' style='opacity:.9'>";
				echo "<div class='alert alert-light'>";
				echo "<i class='fas fa-arrow-circle-down'></i> <b>Visión</b>";
				echo "<p>Ser un despacho lider que a través de políticas y estrategias norme y garantice el acceso a servicios con calidad para la atenci&oacute;n y preservaci&oacute;n de la salud en forma confiable, resolutiva e innovadora, contribuyendo as&iacute; al bienestar social de los hidalguenses. </p>";
				echo "</div>";
			echo "</div>";
			
			echo "<div class='col-sm-4' style='opacity:.9'>";
				echo "<div class='alert alert-light'>";
				echo "<i class='fas  fa-arrow-circle-right'></i> <b>Valores</b>";
				echo "<p>- Honestidad";
				echo "<br>- Lealtad";
				echo "<br>- Responsabilidad";
				echo "<br>- Compromiso";
				echo "<br>- Ética Profesional";
				echo "<br>- Humildad";
				echo "<br>- Respeto";
				echo "<br>- Calidad";
				echo "<br>- Espíritu de Servicio</p>";
				echo "</div>";
			echo "</div>";
		echo "</div>";
	echo "</div>";
	
?>
	<script type="text/javascript">
	
		$(document).ready(function(){
			//corres_grap();
			//comisi_grap();
			//comite_grap();
			//person_grap();
		});
		
		function corres_grap(){
			var parametros={
				"function":"correspondencia"
			}; 
			$.ajax({
				url: "escritorio/datos_orga.php",
				method: "GET",
				data: parametros,
				success: function(data) {
					var player = [];
					var score = [];
					var datos = JSON.parse(data);
					for (var x = 0; x < datos.length; x++) {
						player.push(datos[x].nombre + " "+ datos[x].total );
						score.push(datos[x].total);
					}
				  var chartdata = {
					labels: player,
					datasets : [
					  {
						label: 'Oficios pendientes por contestar',
						backgroundColor: 'rgba(255, 99, 132, 0.6)',
						borderColor: 'rgba(200, 200, 200, 0.75)',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: score
					  }
					]
				  };
				var ctx = $("#speedChart");
					  var barGraph = new Chart(ctx, {
						type: 'horizontalBar',
						data: chartdata,
						options: {
							legend: {
								"display": true
							},
							tooltips: {
								"enabled": false
							}
						}
					  });
				},
				error: function(data) {

				}
			  });
		};
		function comisi_grap(){
			var parametros={
				"function":"comision"
			}; 
			$.ajax({
				url: "escritorio/datos_orga.php",
				method: "GET",
				data: parametros,
				success: function(data) {
					var player = [];
					var score = [];
					var datos = JSON.parse(data);
					for (var x = 0; x < datos.length; x++) {
						player.push(datos[x].nombre + " "+ datos[x].total );
						score.push(datos[x].total);
					}

				  var chartdata = {
					labels: player,
					datasets : [
					  {
						label: 'Oficios de comision elaborados en el año',
						backgroundColor: 'rgba(255, 99, 132, 0.6)',
						borderColor: 'rgba(200, 200, 200, 0.75)',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: score
					  }
					]
				  };
				var ctx = $("#comision");
					  var barGraph = new Chart(ctx, {
						type: 'horizontalBar',
						data: chartdata,
						options: {
							legend: {
								"display": true
							},
							tooltips: {
								"enabled": false
							}
						}
					  });
				},
				error: function(data) {
				  
				}
			  });
		};
		function comite_grap(){
			var parametros={
				"function":"comite"
			}; 
			$.ajax({
				url: "escritorio/datos_orga.php",
				method: "GET",
				data: parametros,
				success: function(data) {
					var player = [];
					var score = [];
					var datos = JSON.parse(data);
					for (var x = 0; x < datos.length; x++) {
						player.push(datos[x].nombre + " "+ datos[x].total );
						score.push(datos[x].total);
					}
				  var chartdata = {
					labels: player,
					datasets : [
					  {
						label: 'Numero de fechas por comite',
						backgroundColor: 'rgba(255, 99, 132, 0.6)',
						borderColor: 'rgba(200, 200, 200, 0.75)',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: score
					  }
					]
				  };
				var ctx = $("#comite");
					  var barGraph = new Chart(ctx, {
						type: 'horizontalBar',
						data: chartdata,
						options: {
							legend: {
								"display": true
							},
							tooltips: {
								"enabled": false
							}
						}
					  });
				},
				error: function(data) {
				  
				}
			  });
		};
		function person_grap(){
			var parametros={
				"function":"personal"
			}; 
			$.ajax({
				url: "escritorio/datos_orga.php",
				method: "GET",
				data: parametros,
				success: function(data) {
					var player = [];
					var score = [];
					var validado = [];
					var datos = JSON.parse(data);
					for (var x = 0; x < datos.length; x++) {
						player.push(datos[x].nombre + " "+ datos[x].total );
						score.push(datos[x].total);
						validado.push(datos[x].validado);
					}
				  var chartdata = {
					labels: player,
					datasets : [
					  {
						label: 'Número de personal',
						backgroundColor: 'rgba(255, 99, 132, 0.6)',
						borderColor: 'rgba(200, 200, 200, 0.75)',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: score
					  },
					  {
						label: 'Personal validado',
						backgroundColor: 'rgba(139, 185, 221, 1.0)',
						borderColor: 'rgba(200, 200, 200, 0.75)',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: validado
					  }
					]
				  };
				var ctx = $("#personal");
					  var barGraph = new Chart(ctx, {
						type: 'horizontalBar',
						data: chartdata,
						options: {
							legend: {
								"display": true
							},
							tooltips: {
								"enabled": true
							}
						}
					  });
				},
				error: function(data) {
				  
				}
			  });
		};
    </script>
	
	