<?php
	require_once("db_clientes.php");
	$db = new Clientes();
	
	$id=$_REQUEST['id'];
	$pd=$db->razon($id);
	
	echo "<table class='table table-sm' id='x_lista'>";
	echo "<thead><tr><th>#</th><th>#</th><th>Razon social</th></tr></thead>";
	echo "<tbody>";
	for($i=0;$i<count($pd);$i++){
		echo "<tr id=".$pd[$i]['idrazon']." class='edit-t'>";
		echo "<td>";
		echo $i+1;
		echo "</td>";

		echo "<td>";
			echo "<div class='btn-group'>";
				echo "<button type='button' class='btn btn-outline-secondary btn-sm' id='winmodal_cargo' data-id='".$pd[$i]['idrazon']."' data-id2='$id' data-lugar='a_clientes/form_razon' title='Cambiar cargo'><i class='fas fa-pencil-alt'></i></button>";
				

			echo "</div>";
		echo "</td>";
	
		echo "<td>".$pd[$i]["razon"]."</td>";
	
		echo "</tr>";
	}
	echo "</tbody>";
	echo "</table>";
?>	
<script>
	$(document).ready( function () {
		lista("x_lista");
	});	
</script>