<?php
  require_once("db_despachos.php");
  $db = new Despachos();

	$id=$_REQUEST['id'];
  $iddespacho=$_REQUEST['id2'];
	if($id>0){
		$pers = $db->empresa_edit($id);
		$razon=$pers['razon'];
		$rfc=$pers['rfc'];
		$giro=$pers['giro'];
		$objeto=$pers['objeto'];
		$banco=$pers['banco'];
		$clabe=$pers['clabe'];
		$cuenta=$pers['cuenta'];
	}
	else{
		$razon="";
		$rfc="";
		$giro="";
		$objeto="";
		$banco="";
		$clabe="";
		$cuenta="";
	}
?>

	<form action="" id="form_personal" data-lugar="a_despachos/db_despachos" data-funcion="guardar_empresa" data-destino="a_despachos/editar">
		<input type="hidden" value="<?php echo $id; ?>" name="id" id="id">
    <input type="hidden" value="<?php echo $iddespacho; ?>" name="iddespacho" id="iddespacho">
		<div class="card">
			<div class="card-header">Empresa</div>
			<div class="card-body">
				<div class="row">
          <div class="col-3">
            <label for="rfc">RFC</label>
            <input type="text" placeholder="RFC" id="rfc" name="rfc" value="<?php echo $rfc; ?>" class="form-control" required>
          </div>
					<div class="col-9">
						<label for="razon">Razón social</label>
						<input type="text" placeholder="Razón social" id="razon" name="razon" value="<?php echo $razon; ?>" class="form-control">
					</div>

					<div class="col-4">
						<label for="giro">Giro</label>
						<input type="text" placeholder="Giro" id="giro" name="giro" value="<?php echo $giro; ?>" class="form-control" required>
					</div>
					<div class="col-8">
						<label for="objeto">Objeto social</label>
						<input type="text" placeholder="Objeto social" id="objeto" name="objeto" value="<?php echo $objeto; ?>" class="form-control" required>
					</div>
					<div class="col-3">
						<label for="banco">Banco</label>
						<input type="text" placeholder="Banco" id="banco" name="banco" value="<?php echo $banco; ?>" class="form-control" required>
					</div>
					<div class="col-4">
						<label for="clabe">Cuenta CLABE</label>
						<input type="text" placeholder="CLABE" id="clabe" name="clabe" value="<?php echo $clabe; ?>" class="form-control" required>
					</div>
					<div class="col-4">
						<label for="cuenta">Número de Cuenta</label>
						<input type="text" placeholder="Cuenta" id="cuenta" name="cuenta" value="<?php echo $cuenta; ?>" class="form-control" required>
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
