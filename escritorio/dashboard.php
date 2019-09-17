<?php
	require_once("../control_db.php");
	$db = new Sagyc();
if ($_SESSION['tipousuario']=='administrativo'){
	$sql="select SUM(finalizar=1) as finalizada, SUM(finalizar=0) as proceso from operaciones";
	$row=$db->general($sql);

	$sql="select count(idfactura) as total from facturas";
	$fact=$db->general($sql);

	$sql="select count(idretorno) as total from retorno";
	$ret=$db->general($sql);

	$sql="select count(idcliente) as total from clientes where prospecto=0";
	$cli=$db->general($sql);

	$sql="select count(idcliente) as total from clientes where prospecto=1";
	$pros=$db->general($sql);


?>
<div class='container-fluid'>
	<div class='row'>
		<div class='col-2'>
				 <div class="card text-center text-white bg-dark border-light mb-3" style="max-width: 13rem;">
		<div class="card-header">Operaciones Cerradas</div>
		<div class="card-body">
		<h5 class="card-title">
			<?php
			echo "<center>".$row[0]['finalizada']."</center>";
			?></h5>

		</div>
				</div>
		</div>

		<div class='col-2'>
				 <div class="card text-center text-white bg-dark border-light mb-3" style="max-width: 13rem;">
		<div class="card-header font-size:12px">Operaciones Activas</div>
		<div class="card-body">
		<h5 class="card-title">
			<?php
			echo "<center>".$row[0]['proceso']."</center>";
			?></h5>

		</div>
				</div>
		</div>

		<div class='col-2'>
				 <div class="card text-center text-white bg-dark border-light mb-3" style="max-width: 13rem;">
		<div class="card-header">Facturas Emitidas</div>
			<div class="card-body">
				<h5 class="card-title">
					<?php
					echo "<center>".$fact[0]['total']."</center>";
					?></h5>

				</div>
				</div>
		</div>

		<!--
		<div class='col-2'>
				 <div class="card text-center text-white bg-dark border-light mb-3" style="max-width: 13rem;">
		<div class="card-header">Retornos Realizados</div>
			<div class="card-body">
				<h5 class="card-title">
					<?php
				//	echo "<center>".$ret[0]['total']."</center>";
					?></h5>

				</div>
				</div>
		</div>
		-->

		<div class='col-2'>
				 <div class="card text-center text-white bg-dark border-light mb-3" style="max-width: 13rem;">
		<div class="card-header">Total de Prospectos</div>
			<div class="card-body">
				<h5 class="card-title">
					<?php
					echo "<center>".$pros[0]['total']."</center>";
					?></h5>

				</div>
				</div>
		</div>

		<div class='col-2'>
				 <div class="card text-center text-white bg-dark border-light mb-3" style="max-width: 13rem;">
		<div class="card-header">Total de Clientes</div>
			<div class="card-body">
				<h5 class="card-title">
					<?php
					echo "<center>".$cli[0]['total']."</center>";
					?></h5>

				</div>
				</div>
		</div>

</div>
</div>

	<div class='container-fluid'>

		<div class='row'>
			<div style='background-color: white;opacity:.8;' class='col-12'>
				<canvas id="reporte1" height='70' width='600px' >
				</canvas>
			</div>
		</div>
		<br>

		<div class='row'>
			<div style='background-color: white;opacity:.8;' class='col-12'>
				<canvas id="reporte2" height='70' width='600px' >
				</canvas>
			</div>
		</div>
		<br>

		<div class='row'>
			<div style='background-color: white;opacity:.8;' class='col-12'>
				<canvas id="reporte3" height='70' width='600px' >
				</canvas>
			</div>
		</div>
		<br>

		<div class='row'>
			<div style='background-color: white;opacity:.8;' class='col-12'>
				<canvas id="reporte4" height='70' width='600px' >
				</canvas>
			</div>
		</div>
		<br>

	</div>


	<script type="text/javascript">

		$(document).ready(function(){
			setTimeout(reporte1, 1000);
			setTimeout(reporte2, 2000);
			setTimeout(reporte3, 3000);
			setTimeout(reporte4, 4000);
		});

		function reporte1(){
			var MONTHS = ['-','Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
			var parametros={
				"function":"reporte1"
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
						player.push(MONTHS[datos[x].mes]);
						score.push(datos[x].total);
					}
				  var chartdata = {
					labels: player,
					datasets : [
					  {
						label: 'Operaciones por mes',
						backgroundColor: ['#abd2de','rgba(119, 136, 153)','#abd2de','rgba(119, 136, 153)'
						,'#abd2de','rgba(119, 136, 153)','#abd2de','rgba(119, 136, 153)','#abd2de','rgba(119, 136, 153)'
						,'#abd2de','rgba(119, 136, 153)'],
						borderColor: 'rgba(200, 200, 200, 0.75)',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: score
					  }
					]
				  };
				var ctx = $("#reporte1");
				var barGraph = new Chart(ctx, {
						type: 'bar',
						data: chartdata,
						options: {
							title: {
								display: true,
								fontSize:20,
								text: 'Operaciones por mes'
							},

							legend: {
								"display": true
							},
							tooltips: {
								"enabled": true
							},
							scales: {
			            yAxes: [{
			                ticks: {
			                    suggestedMin: 0
			                }
			            }]
			        }
						}
					  });
				},
				error: function(data) {

				}
			 });
		};
		function reporte2(){
			var MONTHS = ['-','Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
			var parametros={
				"function":"reporte2"
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
						player.push(MONTHS[datos[x].mes]);
						score.push(datos[x].total);
					}
					var chartdata = {
					labels: player,
					datasets : [
						{
						label: 'Facturas por mes',
						backgroundColor: ['#abd2de','rgba(255, 159, 64, 0.6)','rgba(75, 192, 192, 0.6)','rgba(54, 162, 235, 0.6)'
						,'rgba(153, 102, 255, 0.6)','rgba(201, 203, 207, 0.6)','rgba(255, 99, 132, 0.6)','rgba(255, 159, 64, 0.6)','rgba(75, 192, 192, 0.6)',
						'rgba(54, 162, 235, 0.6)','rgba(201, 203, 207, 0.6)','rgba(255, 159, 64, 0.6)'],
						borderColor: 'rgba(200, 200, 200, 0.75)',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: score
						}
					]
					};
				var ctx = $("#reporte2");
				var barGraph = new Chart(ctx, {
						type: 'polarArea',
						data: chartdata,
						options: {
							title: {
								display: true,
								fontSize:20,
								text: 'Facturas por mes'

							},

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
		function reporte3(){
			var MONTHS = ['-','Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
			var parametros={
				"function":"reporte3"
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
						player.push(MONTHS[datos[x].mes]);
						score.push(datos[x].total);
					}
					var chartdata = {
					labels: player,
					datasets : [
						{
						label: 'Retornos por mes',
						backgroundColor:'#abd2de',
						borderColor: 'rgba(200, 200, 200, 0.75)',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: score
						}
					]
					};
				var ctx = $("#reporte3");
				var barGraph = new Chart(ctx, {
						type: 'line',
						data: chartdata,
						options: {

							title: {
								display: true,
								fontSize:20,
								text: 'Retornos por mes'

							},
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

		function reporte4(){
			var MONTHS = ['-','Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
			var parametros={
				"function":"reporte4",
			};
			var parametros2={
				"function":"reporte5",
			};


			$.ajax({
				url: "escritorio/datos_orga.php",
				method: "GET",
				data: parametros,
				data2: parametros2,

				success: function(data) {
					var player = [];
					var score = [];
					var score2 = [];
					var datos = JSON.parse(data);
					var datos2 = JSON.parse(data);
					for (var x = 0; x < datos.length; x++) {
						player.push(MONTHS[datos[x].mes]);
						score.push(datos[x].total);
					}

				  var chartdata = {
					labels: player,
					datasets : [
					  {
						label: 'Metas',

						borderColor: 'rgba(200, 200, 200, 0.75)',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: score
					},
					{

					label: 'Monto Facturas',
					backgroundColor: ['#abd2de','rgba(255, 159, 64, 0.6)','rgba(75, 192, 192, 0.6)','rgba(54, 162, 235, 0.6)'
					,'rgba(153, 102, 255, 0.6)','rgba(201, 203, 207, 0.6)','rgba(255, 99, 132, 0.6)','rgba(255, 159, 64, 0.6)','rgba(75, 192, 192, 0.6)',
					'rgba(54, 162, 235, 0.6)','rgba(201, 203, 207, 0.6)','rgba(255, 159, 64, 0.6)'],
					borderColor: 'rgba(200, 200, 200, 0.75)',
					hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
					hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data2: score2

				},
					]
				  };
				var ctx = $("#reporte4");
				var mixedChart  = new Chart(ctx, {
						type: 'bar',
						data: chartdata,

						options: {
							title: {
								display: true,
								fontSize:20,
								text: 'Metas por mes'
							},

							legend: {
								"display": true
							},
							tooltips: {
								"enabled": true
							},
							scales: {
			            yAxes: [{
			                ticks: {
			                    suggestedMin: 0
			                }
			            }]
			        }
						}
					  });

				},

				error: function(data) {

				}
			 });
		};

</script>

	<?php
	}
?>
