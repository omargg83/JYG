<?php
	require_once("db_operaciones.php");
	$db = new Operaciones();

	if (isset($_REQUEST['id'])){
		$id=$_REQUEST['id'];
	}
	$fact = $db->facturas($id);
	echo "<div class='container-fluid' style='background-color:".$_SESSION['cfondo']."; '>";
	echo "<h5>Facturas</h5>";
	echo "<button type='button' class='btn btn-outline-secondary btn-sm' id='winmodal_cargo' data-id='0' data-id2='$id' data-lugar='a_operaciones/form_factura'><i class='fas fa-file-invoice'></i>Nueva</button>";
	echo "<hr>";

?>
		<div class="content table-responsive table-full-width">
			<table class="table table-sm">
			<thead>
			<th>#</th>
			<th>-</th>
			<th>Fecha</th>
			<th>Monto</th>
			</tr>
			</thead>
			<tbody>
			<?php
				for($i=0;$i<count($fact);$i++){
					echo "<tr id=".$fact[$i]['idfactura']." class='edit-t'>";

					echo "<td>";
					echo $i+1;
					echo "</td>";

					echo "<td>";
					echo "<div class='btn-group'>";
					echo "<button type='button' class='btn btn-outline-secondary btn-sm' id='winmodal_cargo' data-id='".$fact[$i]['idfactura']."' data-id2='$id' data-lugar='a_operaciones/form_factura'><i class='fas fa-pencil-alt'></i></button>";
					echo "</div>";
					echo "</td>";

					echo "<td>";
					echo $fact[$i]["fecha"];
					echo "</td>";


					echo "<td>";
					echo moneda($fact[$i]["monto"]);
					echo "</td>";

					echo "</tr>";
				}
			?>
			</tbody>
			</table>
		</div>
	</div>
