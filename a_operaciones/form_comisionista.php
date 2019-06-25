<?php
require_once("db_operaciones.php");
if (isset($_REQUEST['id'])){
	$id=$_REQUEST['id'];
}
if (isset($_REQUEST['id2'])){
	$id2=$_REQUEST['id2'];
}

$pers = $db->operacion_edit($id2);
$idrazon=$pers['idrazon'];
$razon = $db->razon($idrazon);
$comision=$db->comisionista($razon['idcliente']);

$row=$db->retorno_edit($id);
$saldodesp=$row['saldodesp'];

echo $saldodesp;

echo "<table class='table table-sm'>";
	echo "<tr>";
	echo "</tr>";
	foreach($comision as $key){
		echo "<tr>";
			echo "<td>";
			echo $key['comisionista'];
			echo "</td>";
		echo "</tr>";
	}

echo "</table>";



?>







<button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i>Cerrar</button>
