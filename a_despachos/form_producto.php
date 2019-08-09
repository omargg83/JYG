<?php
	require_once("db_despachos.php");;

	$id=$_REQUEST['id'];
  $iddespacho=$_REQUEST['id2'];

	if($id>0){
		$pers = $db->producto_edit($id);
		$producto=$pers['producto'];
		$pventa=$pers['pventa'];

	}
	else{
		$producto="";
		$pventa="";

	}
?>
	<form action="" id="form_personal" data-lugar="a_despachos/db_despachos" data-funcion="guardar_producto" data-destino="a_despachos/editar">
		<input type="hidden" value="<?php echo $id; ?>" name="id" id="id">
    <input type="hidden" value="<?php echo $iddespacho; ?>" name="iddespacho" id="iddespacho">
		<div class="card">
			<div class="card-header">Producto</div>
			<div class="card-body">
				<div class="row">
					<div class="col-6">
						<label for="producto">Producto</label>

						<select class='form-control' id='producto' name='producto'>

						<?php

							echo "<option"; if($producto=='CHEQUE'){ echo " selected"; } echo " value='CHEQUE'>CHEQUE</option>";
							echo "<option"; if($producto=='SPEI'){ echo " selected"; } echo " value='SPEI'>SPEI</option>";
							echo "<option"; if($producto=='ASIMILADOS'){ echo " selected"; } echo " value='ASIMILADOS'>ASIMILADOS</option>";
							echo "<option"; if($producto=='PLAN PRIVADO'){ echo " selected"; } echo " value='PLAN PRIVADO'>PLAN PRIVADO</option>";
							echo "<option"; if($producto=='EFECTIVO'){ echo " selected"; } echo " value='EFECTIVO'>EFECTIVO</option>";
							echo "<option"; if($producto=='CUCA'){ echo " selected"; } echo " value='CUCA'>CUCA</option>";
							echo "<option"; if($producto=='SINDICATO'){ echo " selected"; } echo " value='SINDICATO'>SINDICATO</option>";

						?>
						</select>

					</div>

					<div class="col-4">
						<label for="pventa">% de venta</label>
						<input type="text" placeholder="% de venta" id="pventa" name="pventa" value="<?php echo $pventa; ?>" class="form-control">
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
