<?php 
	require_once("db_operaciones.php");
	$db = new Operaciones();
	if (isset($_REQUEST['idrazon'])){
		$idrazon=$_REQUEST['idrazon'];
	}

	if($idrazon>0){
		$row=$db->cliente_oper($idrazon);
		$idcliente=$row['idcliente'];
		$cliente=$row['cliente'];
		$rfc=$row['rfc'];
		$contacto=$row['contacto'];
		$razon=$row['razon'];
	}

	else{
		$idcliente="";
		$cliente="";
		$rfc="";
		$contacto="";
		$razon="";
	}	
?>

<div class="col-4">
	<label for="cliente">Cliente</label>
	<div class="input-group mb-3">
		<div class="input-group-prepend">
			<button type='button' class='btn btn-outline-secondary btn-sm' id='winmodal_cargo' data-id='$id' data-id2='$t_idcargo' data-id3='$t_area' data-lugar='a_operaciones/form_cliente'><i class="fas fa-user-plus"></i></button>
		</div>
		<input type="text" placeholder="Cliente" id="cliente" name="cliente" value="<?php echo $cliente; ?>" class="form-control" readonly>
	</div>
</div>

<div class="col-4">
	<label for="rfc">RFC</label>
	<input type="text" placeholder="RFC" id="rfc" name="rfc" value="<?php echo $rfc; ?>" class="form-control" readonly>
</div>

<div class="col-4">
	<label for="contacto">Contacto</label>
	<input type="text" placeholder="Contacto" id="contacto" name="contacto" value="<?php echo $contacto; ?>" class="form-control" readonly>
</div>

<div class="col-4">
	<label for="estudio">Razon social</label>
	<input type="hidden" id="idrazon" name="idrazon" value="<?php echo $idrazon; ?>" class="form-control">
	<input type="text" placeholder="Razon" id="razon" name="razon" value="<?php echo $razon; ?>" class="form-control" readonly>
</div>