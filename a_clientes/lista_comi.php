<?php
require_once("db_.php");

$id=$_REQUEST['id'];
$pd=$db->comi($id);

echo "<table class='table table-sm' id='x_lista2'>";
echo "<thead><tr><th>#</th><th>Comisionista</th><th>Comisión %</th></tr></thead>";
echo "<tbody>";
foreach($pd as $key){
	echo "<tr id=".$key['idcom']." class='edit-t'>";
	echo "<td>";
	echo "<div class='btn-group'>";
	echo "<button type='button' class='btn btn-outline-secondary btn-sm' id='winmodal_cargo' data-id='".$key['idcom']."' data-id2='$id' data-lugar='a_clientes/form_comi' title='Cambiar cargo'><i class='fas fa-pencil-alt'></i></button>";


	echo "</div>";
	echo "</td>";

	echo "<td>".$key["nombre"]."</td>";
	echo "<td>".$key["comision"]."</td>";

	echo "</tr>";
}
echo "</tbody>";
echo "</table>";
?>
<script>
$(document).ready( function () {
	lista("x_lista2");
});
</script>
