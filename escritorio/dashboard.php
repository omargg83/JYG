<?php
	require_once("../control_db.php");

?>
	<div class='container-fluid'>

		<div style='background-color: white;opacity:.8;'>
			<canvas id="reporte1" height='80' width='600px' >
			</canvas>
		</div>
	</div>

	<script type="text/javascript">

		$(document).ready(function(){
			setTimeout(corres_grap, 2000);
		/*	setTimeout(corres_grap, 4000);
			setTimeout(comite_grap, 6000);
			setTimeout(comisi_grap, 8000);*/
		});

		function corres_grap(){
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
						player.push(datos[x].nombre);
						score.push(datos[x].total);
					}
				  var chartdata = {
					labels: player,
					datasets : [
					  {
						label: 'Operaciones por dia',
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
