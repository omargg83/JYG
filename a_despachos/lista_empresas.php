<?php
	require_once("db_despachos.php");
	$db = new Despachos();
  $id=$_REQUEST['id'];
	$pd = $db->empresas_lista($id);

?>

			<table class="table table-sm" id="x_lista2">
			<thead>
			<th>-</th>
			<th>Cliente</th>
			<th>Contacto</th>
			<th>Correo</th>
			</tr>
			</thead>
			<tbody>
			<?php
				foreach ($pd as $key ) {
					echo "<tr id=".$key['idempresa']." class='edit-t'>";

					echo "<td>";

					echo "<div class='btn-group'>";
						echo "<button type='button' class='btn btn-outline-secondary btn-sm' id='winmodal_cargo' data-id='".$key['idempresa']."' data-id2='$id' data-lugar='a_despachos/form_empresa' title='Editar Operador'><i class='fas fa-pencil-alt'></i></button>";
					echo "</div>";

					echo "</td>";
					echo "<td>";
					echo $key["razon"];
					echo "</td>";
					echo "<td>".$key["rfc"]."</td>";
					echo "<td>".$key["giro"]."</td>";
					echo "</tr>";
				}
			?>

			</tbody>
			</table>


<script>
	$(document).ready( function () {
		lista("x_lista2");
	});
</script>
