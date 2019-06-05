<?php
	require_once("db_tipo.php");
	$db = new Tipo();
	$id=$_REQUEST['id'];
	if($id>0){
		$pers = $db->tipo_edit($id);
		$tipo=$pers['tipo'];
	}
	else{
		$tipo="";
	}
?>
<div class="container">
	<form action="" id="form_personal" data-lugar="a_productostipo/db_tipo" data-funcion="guardar_tipo">
		<input type="hidden" value="<?php echo $id; ?>" name="id" id="id">
		<div class="card">
			<div class="card-header">Tipo de productos</div>
			<div class="card-body">
				<div class="row">
					<div class="col-2">
						<label for="tipo">Tipo</label>
						<input type="text" placeholder="Tipo" id="tipo" name="tipo" value="<?php echo $tipo; ?>" class="form-control">
					</div>
				</div>
			</div>
			<div class="card-footer">
				<div class="row">
					<div class="col-12">
						<div class="btn-group">
							<button class="btn btn-outline-secondary btn-sm" type="submit"><i class='far fa-save'></i>Guardar</button>
							<button class='btn btn-outline-secondary btn-sm' id='lista_penarea' data-lugar='a_productostipo/lista' title='regresar'><i class='fas fa-undo-alt'></i>Regresar</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
