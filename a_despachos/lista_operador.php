<?php
require_once("db_despachos.php");

$id=$_REQUEST['id'];
$pd=$db->operador($id);

echo "<table class='table table-sm' id='x_lista'>";
echo "<thead><tr><th>#</th><th>Operador</th><th>Email</th></tr></thead>";
echo "<tbody>";
foreach($pd as $key){
	echo "<tr id=".$key['idoper']." class='edit-t'>";
	echo "<td>";
	echo "<div class='btn-group'>";
	echo "<button type='button' class='btn btn-outline-secondary btn-sm' id='winmodal_cargo' data-id='".$key['idoper']."' data-id2='$id' data-lugar='a_despachos/form_oper' title='Editar Operador'><i class='fas fa-pencil-alt'></i></button>";


	echo "</div>";
	echo "</td>";

	echo "<td>".$key["operador"]."</td>";
	echo "<td>".$key["correo"]."</td>";

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
