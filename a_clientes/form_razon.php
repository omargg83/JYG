<?php
	require_once("db_.php");

	$id=$_REQUEST['id'];
	$idcliente=$_REQUEST['id2'];
	if($id>0){
		$razonx = $db->razon_edit($id);
		$razon=$razonx['razon'];
		$rfcrazon=$razonx['rfcrazon'];

	}
	else{
		$razon="";
		$rfcrazon="";
	}
?>
	<form action="" id="form_razon" data-lugar="a_clientes/db_" data-funcion="guardar_razon" data-destino="a_clientes/editar">
		<input type="hidden" value="<?php echo $id; ?>" name="id" id="id">
		<input type="hidden" value="<?php echo $idcliente; ?>" name="idcliente" id="idcliente">
		<div class="card">
			<div class="card-header">Razón social</div>
			<div class="card-body">
				<div class="row">
					<div class="col-6">
						<label for="razon">Razón</label>
						<input type="text" placeholder="Razon" id="razon" name="razon" value="<?php echo $razon; ?>" class="form-control">
					</div>
					<div class="col-3">
						<label for="rfcrazon">Rfc</label>
						<input type="text" placeholder="RFC Razon" id="rfcrazon" name="rfcrazon" value="<?php echo $rfcrazon; ?>" class="form-control">
					</div>
				</div>
			</div>
			<div class="card-footer">
				<div class="row">
					<div class="col-12">
						<div class="btn-group">
							<button class="btn btn-outline-secondary btn-sm" type="submit"><i class='far fa-save'></i>Guardar</button>
							<button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i>Cerrar</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
