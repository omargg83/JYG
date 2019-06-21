<?php
	require_once("db_operaciones.php");
	$pd = $db->operaciones();

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
			<th>Empresa</th>
			<th>Despacho</th>
			<th>Monto</th>
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
