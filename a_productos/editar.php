<?php
	require_once("db_productos.php");
	$db = new Productos();
	$id=$_REQUEST['id'];
	$despacho=$db->despachos();
	$tipos=$db->tipos();

	if($id>0){
		$pers = $db->producto_edit($id);
		$producto=$pers['producto'];
		$iddespacho=$pers['iddespacho'];
		$pventa=$pers['pventa'];

	}
	else{
		$producto="";
		$iddespacho="";
		$pventa="";

	}
?>
<div class="container">
	<form action="" id="form_personal" data-lugar="a_productos/db_productos" data-funcion="guardar_producto">
		<input type="hidden" value="<?php echo $id; ?>" name="id" id="id">
		<div class="card">
			<div class="card-header">Producto</div>
			<div class="card-body">
				<div class="row">
					<div class="col-3">
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
					<div class="col-3">
						<label for="iddespacho">Despacho</label>
						<select class='form-control' id='iddespacho' name='iddespacho'>
						<?php
							foreach ($despacho as $key => $value) {
								echo "<option"; if($iddespacho==$value['iddespacho']){ echo " selected"; } echo " value='".$value['iddespacho']."'>".$value['nombre']."</option>";
							}
						?>
						</select>
					</div>
					<div class="col-2">
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
							<button class='btn btn-outline-secondary btn-sm' id='lista_penarea' data-lugar='a_productos/lista' title='regresar'><i class='fas fa-undo-alt'></i>Regresar</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
