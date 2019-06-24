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


echo print_r($comision);
$row=$db->retorno_edit($id);
$saldodesp=$row['saldodesp'];

echo $saldodesp;

?>







<button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i>Cerrar</button>
