<?php
	require_once("db_operaciones.php");


	$nombre="";
	if (isset($_REQUEST['funcion'])){
		$nombre=$_REQUEST['funcion'];
	}
	if($nombre==""){
		$pd = $db->operaciones();
	}
	if($nombre=="buscar"){
		$valor=$_REQUEST['valor'];
		$pd = $db->buscar($valor);
	}
	echo "<div class='container-fluid' style='background-color:".$_SESSION['cfondo']."; '>";
	echo "<br><h5>Operaciones</h5><hr>";
?>
		<div class="content table-responsive table-full-width">
			<table class="table-sm display compact hover" id="x_lista">
			<thead>
			<th>Operación</th>
			<th>#</th>
			<th>Fecha</th>
			<th>Cliente</th>
			<th>Razon</th>
			<th>Despacho</th>
			<th>Empresa</th>
			<th>Monto</th>
			<th>Estado</th>
			</tr>
			</thead>
			<tbody>
			<?php
				for($i=0;$i<count($pd);$i++){
					echo "<tr id=".$pd[$i]['idoperacion']." class='edit-t'>";
					echo "<td><center>";
					echo $pd[$i]["idoperacion"];
					echo "</center>";
					echo "</td>";

					echo "<td>";
						echo "<button class='btn btn-outline-secondary btn-sm' id='edit_persona' title='Editar' data-lugar='a_operaciones/editar'><i class='fas fa-pencil-alt'></i></button>";
					echo "</td>";

					echo "<td>";
					echo fecha($pd[$i]["fecha"]);
					echo "</td>";

					echo "<td>";
					echo $pd[$i]["cliente"];
					echo "</td>";

					echo "<td>";
					echo $pd[$i]["razoncli"];
					echo "</td>";

					echo "<td>";
					echo $pd[$i]["nombre"];
					echo "</td>";

					echo "<td>";
					echo $pd[$i]["razonemp"];
					echo "</td>";

					echo "<td align='right'>";
					echo moneda($pd[$i]["monto"]);
					echo "</td>";

					echo "<td>";
					if($pd[$i]["finalizar"]==1){
							echo "Finalizada";
					}
					else{
						echo "En proceso";
					}
					echo "</td>";
					echo "</tr>";
				}
			?>

			</tbody>
			</table>
		</div>
	</div>

<script>
	$(document).ready( function () {
		lista("x_lista");
	});
</script>
