<?php
	require_once("db_comisionistas.php");
	$db = new Comisionistas();
	$id=$_REQUEST['id'];
	if($id>0){
		$pers = $db->comisionista_edit($id);
		$nombre=$pers['nombre'];
		$email=$pers['email'];
		$telefono=$pers['telefono'];
		$banco=$pers['banco'];
		$cuentabanco=$pers['cuentabanco'];
		$comision=$pers['comision'];

	}
	else{
		$nombre="";
		$email="";
		$telefono="";
		$banco="";
		$cuentabanco="";
		$comision="";

	}
?>
<div class="container">
	<form action="" id="form_personal" data-lugar="a_comisionista/db_comisionistas" data-funcion="guardar_comisionista">
		<input type="hidden" value="<?php echo $id; ?>" name="id" id="id">
		<div class="card">
			<div class="card-header">Comisionista</div>
			<div class="card-body">
				<div class="row">
					<div class="col-5">
						<label for="razon">Nombre</label>
						<input type="text" placeholder="Nombre" id="nombre" name="nombre" value="<?php echo $nombre; ?>" class="form-control">
					</div>

					<div class="col-3">
						<label for="email">Email</label>
						<input type="text" placeholder="Email" id="email" name="email" value="<?php echo $email; ?>" class="form-control" required>
					</div>
					<div class="col-3">
						<label for="telefono">Telefono</label>
						<input type="text" placeholder="Telefono" id="telefono" name="telefono" value="<?php echo $telefono; ?>" class="form-control" required>
					</div>
					<div class="col-4">
						<label for="banco">Banco</label>
						<input type="text" placeholder="Banco" id="banco" name="banco" value="<?php echo $banco; ?>" class="form-control" required>
					</div>
					<div class="col-4">
						<label for="cuentabanco">Cuenta bancaria</label>
						<input type="text" placeholder="Cuenta bancaria" id="cuentabanco" name="cuentabanco" value="<?php echo $cuentabanco; ?>" class="form-control" required>
					</div>
					<div class="col-3">
						<label for="comision">% Comision</label>
						<input type="text" placeholder="%" id="comision" name="comision" value="<?php echo $comision; ?>" class="form-control" required>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<div class="row">
					<div class="col-12">
						<div class="btn-group">
							<button class="btn btn-outline-secondary btn-sm" type="submit"><i class='far fa-save'></i>Guardar</button>
							<button class='btn btn-outline-secondary btn-sm' id='lista_penarea' data-lugar='a_comisionistas/lista' title='regresar'><i class='fas fa-undo-alt'></i>Regresar</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
