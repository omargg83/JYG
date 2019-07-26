<?php
	require_once("../control_db.php");
	$db = new Sagyc();

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
			<div class='col-1'>
				<div class='alert alert-success' style='opacity:.7;font-size:12px'>
					<?php
					echo "<center>Operaciones: <br>".$row[0]['finalizada']." Finalizadas</center>";
				 	?>
		 		</div>
			</div>
			<div class='col-1'>
				<div class='alert alert-success' style='opacity:.7;font-size:12px'>
					<?php
					echo "<center>Operaciones: <br>".$row[0]['proceso']." proceso</center>";
				 	?>
		 		</div>
			</div>

			<div class='col-1'>
				<div class='alert alert-success' style='opacity:.7;font-size:12px'>
					<?php
					echo "<center>Facturas:<br>".$fact[0]['total']."</center>";
				 	?>
		 		</div>
			</div>

			<div class='col-1'>
				<div class='alert alert-success' style='opacity:.7;font-size:12px'>
					<?php
					echo "<center>Retornos:<br>".$ret[0]['total']."</center>";
				 	?>
		 		</div>
			</div>

			<div class='col-1'>
				<div class='alert alert-success' style='opacity:.7;font-size:12px'>
					<?php
					echo "<center>Prospectos:<br>".$pros[0]['total']."</center>";
					?>
				</div>
			</div>

			<div class='col-1'>
				<div class='alert alert-success' style='opacity:.7;font-size:12px'>
					<?php
					echo "<center>Clientes:<br>".$cli[0]['total']."</center>";
				 	?>
		 		</div>
			</div>


		</div>



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
	</div>

	<script type="text/javascript">

		$(document).ready(function(){
			setTimeout(reporte1, 1000);
			setTimeout(reporte2, 2000);
			setTimeout(reporte3, 3000);
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
						backgroundColor: 'rgba(255, 99, 132, 0.6)',
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
						backgroundColor: 'rgba(255, 99, 132, 0.6)',
						borderColor: 'rgba(200, 200, 200, 0.75)',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: score
						}
					]
					};
				var ctx = $("#reporte2");
				var barGraph = new Chart(ctx, {
						type: 'bar',
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
						label: 'Operaciones por mes',
						backgroundColor: 'rgba(255, 99, 132, 0.6)',
						borderColor: 'rgba(200, 200, 200, 0.75)',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: score
						}
					]
					};
				var ctx = $("#reporte3");
				var barGraph = new Chart(ctx, {
						type: 'bar',
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
</script>
