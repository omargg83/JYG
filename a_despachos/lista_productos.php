<?php
  require_once("db_despachos.php");

  $id=$_REQUEST['id'];
	$pd = $db->productos($id);

	echo "<div class='container-fluid' style='background-color:".$_SESSION['cfondo']."; '>";
	echo "<br><h5>Productos</h5><hr>";
?>
		<div class="content table-responsive table-full-width">
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
					echo "<td>".$pd[$i]["pventa"]."</td>";
					echo "</tr>";
				}
			?>

			</tbody>
			</table>
		</div>
	</div>

<script>
	$(document).ready( function () {
		lista("x_lista3");
	});
</script>
