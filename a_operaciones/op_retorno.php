<?php
	require_once("db_operaciones.php");
	if (isset($_REQUEST['id'])){
		$id=$_REQUEST['id'];
		$operacion = $db->operacion_edit($id);
		$idempresa=$operacion['idempresa'];
	}
	$fact = $db->retorno($id);
	echo "<div class='container-fluid' style='background-color:".$_SESSION['cfondo']."; '>";
	echo "<h5>Retorno</h5>";
?>
		<div class="content table-responsive table-full-width">
			<table class="table table-sm datatable">
			<thead>
			<th>-</th>
			<th>Fecha</th>
			<th>Tipo</th>
			<th>Monto</th>
			</tr>
			</thead>
			<tbody>
			<?php
				for($i=0;$i<count($fact);$i++){
					echo "<tr id=".$fact[$i]['idretorno']." class='edit-t'>";

					echo "<td>";
						echo "<div class='btn-group'>";
							echo "<button type='button' class='btn btn-outline-secondary btn-sm' id='winmodal_cargo' data-id='".$fact[$i]['idretorno']."' data-id2='$id' data-id3='$idempresa' data-lugar='a_operaciones/form_retorno'><i class='fas fa-pencil-alt'></i></button>";
							echo "<button class='btn btn-outline-secondary btn-sm' id='eliminar_retorno' data-lugar='a_operaciones/db_operaciones' data-destino='a_operaciones/op_retorno' data-id='".$fact[$i]['idretorno']."' data-funcion='borrar_retorno' data-div='retornos' data-iddest='$id'><i class='far fa-trash-alt'></i></button>";
						echo "</div>";
					echo "</td>";

					echo "<td>";
					echo $fact[$i]["fecha"];
					echo "</td>";



					echo "<td>";
					echo $fact[$i]["idproducto"];
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
