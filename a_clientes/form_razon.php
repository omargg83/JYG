<?php
	require_once("db_.php");

	$id=$_REQUEST['id'];
	$idcliente=$_REQUEST['id2'];
	if($id>0){
		$razonx = $db->razon_edit($id);
		$razon=$razonx['razon'];
		$rfcrazon=$razonx['rfcrazon'];

		$telefono=$razonx['telefono'];
		$domicilio=$razonx['domicilio'];
		$colonia=$razonx['colonia'];
		$ciudad=$razonx['ciudad'];
		$municipio=$razonx['municipio'];
		$estado=$razonx['estado'];
		$cp=$razonx['cp'];
		$activo=$razonx['activo'];
	}
	else{
		$razon="";
		$rfcrazon="";
		$telefono="";
		$domicilio="";
		$colonia="";
		$ciudad="";
		$municipio="";
		$estado="";
		$cp="";
		$activo=1;
	}
?>
	<form action="" id="form_razon" data-lugar="a_clientes/db_" data-funcion="guardar_razon" data-destino="a_clientes/editar">
		<input type="hidden" value="<?php echo $id; ?>" name="id" id="id">
		<input type="hidden" value="<?php echo $idcliente; ?>" name="idcliente" id="idcliente">
		<div class="card">
			<div class="card-header">Razón social</div>
			<div class="card-body">
				<div class="row">
					<div class="col-8">
						<label for="razon">Razón</label>
						<input type="text" placeholder="Razon" id="razon" name="razon" value="<?php echo $razon; ?>" class="form-control">
					</div>
					<div class="col-3">
						<label for="rfcrazon">Rfc</label>
						<input type="text" placeholder="RFC Razon" id="rfcrazon" name="rfcrazon" value="<?php echo $rfcrazon; ?>" class="form-control">
					</div>
					<div class="col-11">
						<label for="domicilio">Domicilio (Calle y No.)</label>
						<input type="text" placeholder="Domicilio (Calle y No.)" id="domicilio" name="domicilio" value="<?php echo $domicilio; ?>" class="form-control">
					</div>
					<div class="col-9">
						<label for="colonia">Colonia</label>
						<input type="text" placeholder="Colonia" id="colonia" name="colonia" value="<?php echo $colonia; ?>" class="form-control">
					</div>
					<div class="col-2">
						<label for="cp">CP</label>
						<input type="text" placeholder="CP" id="cp" name="cp" value="<?php echo $cp; ?>" class="form-control">
					</div>
					<div class="col-6">
						<label for="ciudad">Ciudad</label>
						<input type="text" placeholder="Ciudad" id="ciudad" name="ciudad" value="<?php echo $ciudad; ?>" class="form-control">
					</div>
					<div class="col-5">
						<label for="municipio">Municipio</label>
						<input type="text" placeholder="Municipio" id="municipio" name="municipio" value="<?php echo $municipio; ?>" class="form-control">
					</div>
					<div class="col-6">
						<label for="estado">Estado</label>
						<input type="text" placeholder="Estado" id="estado" name="estado" value="<?php echo $estado; ?>" class="form-control">
					</div>
					<div class='col-sm-3'>
						<label>Activo: </label><br>
						<input type='checkbox' name='activo' id='activo' value=1
						<?php
						if($activo==1){ echo " checked";}
						?>
						>
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
