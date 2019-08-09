<?php
	require_once("db_.php");

	$pd = $db->metas_factura();
	echo "<div class='container-fluid' style='background-color:".$_SESSION['cfondo']."; '>";
	echo "<br><h5>Metas de facturación</h5><hr>";
?>
		<div class="content table-responsive table-full-width">
			<table class="table-sm display compact hover" id="x_lista">
				<thead>
					<th>-</th>
			<th>Mes</th>
			<th>Año</th>
			<th>Meta</th>

			</tr>
			</thead>
			<tbody>
			<?php
				foreach ($pd as $key) {
					echo "<tr id=".$key['id']." class='edit-t'>";

					echo "<td>";
						echo "<button class='btn btn-outline-secondary btn-sm' id='edit_persona' title='Editar' data-lugar='a_metas/editar'><i class='fas fa-pencil-alt'></i></button>";
					echo "</td>";

					echo "<td>";
					if($key["mes"]==1) echo "Enero";
					if($key["mes"]==2) echo "Febrero";
					if($key["mes"]==3) echo "Marzo";
					if($key["mes"]==4) echo "Abril";
					if($key["mes"]==5) echo "Mayo";
					if($key["mes"]==6) echo "Junio";
					if($key["mes"]==7) echo "Julio";
					if($key["mes"]==8) echo "Agosto";
					if($key["mes"]==9) echo "Septiembre";
					if($key["mes"]==10) echo "Octubre";
					if($key["mes"]==11) echo "Noviembre";
					if($key["mes"]==12) echo "Diciembre";
					echo "</td>";

					echo "<td>";
					echo $key["anio"];
					echo "</td>";

					echo "<td>";
					echo number_format($key["meta"],2);
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
