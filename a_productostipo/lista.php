<?php 
	require_once("db_tipo.php");
	$pers = new Tipo();
	$pd = $pers->tipos();
	echo "<div class='container-fluid' style='background-color:".$_SESSION['cfondo']."; '>";
	echo "<br><h5>Tipo de productos</h5><hr>";
?>	
		<div class="content table-responsive table-full-width">
			<table class="table-sm display compact hover" id="x_lista">
			<thead>
			<th>#</th>
			<th>-</th>
			<th>Cliente</th>
			</tr>
			</thead>
			<tbody>
			<?php
				for($i=0;$i<count($pd);$i++){
					echo "<tr id=".$pd[$i]['idtipo']." class='edit-t'>";
					echo "<td>";
					echo $i+1;
					echo "</td>";
					echo "<td>";
					
					echo "<div class='btn-group'>";
					echo "<button class='btn btn-outline-secondary btn-sm' id='edit_persona' title='Editar' data-lugar='a_productostipo/editar'><i class='fas fa-pencil-alt'></i></button>";
					echo "</div>";

					echo "</td>";
					echo "<td>";
					echo $pd[$i]["tipo"];
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