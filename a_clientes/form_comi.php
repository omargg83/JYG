<?php
	require_once("db_.php");
	$comisionista= $db->comisionistas();
	$id=$_REQUEST['id'];
	$idcliente=$_REQUEST['id2'];
	if($id>0){
		$comi = $db->comi_edit($id);

		$comision=$comi['comision'];
		$idcom=$comi['idcom'];
	}
	else{

		$comision="";
		$idcom="";
	}
?>
	<form action="" id="form_comi" data-lugar="a_clientes/db_" data-funcion="guardar_comi" data-destino="a_clientes/editar">
		<input type="hidden" value="<?php echo $id; ?>" name="id" id="id">
		<input type="hidden" value="<?php echo $idcliente; ?>" name="idcliente" id="idcliente">
		<div class="card">
			<div class="card-header">Agregar Comisionista</div>
			<div class="card-body">
				<div class="row">

					<div class="col-6">
						<label for="idcom">Comisionista</label>
						<select class='form-control' id='idcom' name='idcom'>
						<?php
							foreach ($comisionista as $key => $value) {
								echo "<option"; if($idcom==$value['idcom']){ echo " selected"; } echo " value='".$value['idcom']."'>".$value['nombre']."</option>";
							}
						?>
						</select>
					</div>

					<div class="col-2">
						<label for="comision">Comisión %</label>
						<input type="text" placeholder="%" id="comision" name="comision" value="<?php echo $comision; ?>" class="form-control">
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
