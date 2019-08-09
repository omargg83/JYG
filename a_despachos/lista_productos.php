<?php
  require_once("db_despachos.php");

  $id=$_REQUEST['id'];
	$pd = $db->productos($id);
?>

		<table class="table-sm display compact hover" id="x_lista3">
		<thead>
		<th>#</th>
		<th>-</th>
		<th>Producto</th>
		<th>Porcentaje</th>
		</tr>
		</thead>
		<tbody>
		<?php
			for($i=0;$i<count($pd);$i++){
				echo "<tr id=".$pd[$i]['idproducto']." class='edit-t'>";
				echo "<td>";
				echo $i+1;
				echo "</td>";
				echo "<td>";

				echo "<div class='btn-group'>";
          echo "<button type='button' class='btn btn-outline-secondary btn-sm' id='winmodal_cargo' data-id='".$pd[$i]['idproducto']."' data-id2='$id' data-lugar='a_despachos/form_producto' title='Editar Operador'><i class='fas fa-pencil-alt'></i></button>";
				echo "</div>";

				echo "</td>";
				echo "<td>";
				echo $pd[$i]["producto"];
				echo "</td>";
				echo "<td>".$pd[$i]["pventa"]." %</td>";
				echo "</tr>";
			}
		?>

		</tbody>
		</table>


<script>
	$(document).ready( function () {
		lista("x_lista3");
	});
</script>
