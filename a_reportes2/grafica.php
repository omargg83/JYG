<?php
	require_once("db_.php");
?>
		<div class='row' >
			<div style='background-color: white;opacity:.8;' class='col-12'>
				<canvas id="reporte1" height='70' width='600px' >
				</canvas>
			</div>
		</div>
		<br>
	</div>

<script type="text/javascript">

$(document).ready(function(){
	setTimeout(reporte4, 1000);
});

function reporte4(){
	var MONTHS = ['-','Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
	var parametros={
		"function":"reporte4"
	};
	$.ajax({
		url: "a_reportes2/db_.php",
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
				label: 'Gastos por mes',
				backgroundColor:'rgba(255, 99, 132, 0.6)',
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
						text: 'Gastos por mes'

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
