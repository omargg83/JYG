<?php
	require_once("db_despachos.php");

	$id=$_REQUEST['id'];
	$iddespacho=$_REQUEST['id2'];
	if($id>0){
		$operadores = $db->operador_edit($id);
		$operador=$operadores['operador'];
		$correo=$operadores['correo'];
	}
	else{
		$operador="";
		$correo="";
	}
?>
	<form action="" id="form_oper" data-lugar="a_despachos/db_despachos" data-funcion="guardar_oper" data-destino="a_despachos/editar">
		<input type="hidden" value="<?php echo $id; ?>" name="id" id="id">
		<input type="hidden" value="<?php echo $iddespacho; ?>" name="iddespacho" id="iddespacho">
		<div class="card">
			<div class="card-header">Operador del Despacho</div>
			<div class="card-body">
				<div class="row">
					<div class="col-6">
						<label for="operador">Operador</label>
						<input type="text" placeholder="Operador" id="operador" name="operador" value="<?php echo $operador; ?>" class="form-control">
					</div>
					<div class="col-6">
						<label for="correo">Correo</label>
						<input type="text" placeholder="Email" id="correo" name="correo" value="<?php echo $correo; ?>" class="form-control">
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
