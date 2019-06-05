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
		$pcomisionista=$pers['pcomisionista'];
		$psocios=$pers['psocios'];
		$pikito=$pers['pikito'];
	}
	else{
		$producto="";
		$iddespacho="";
		$pventa="";
		$pcomisionista="";
		$psocios="";
		$pikito="";
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
						<input type="text" placeholder="Producto" id="producto" name="producto" value="<?php echo $producto; ?>" class="form-control">
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
					<div class="col-2">
						<label for="pcomisionista">% de comisionista</label>
						<input type="text" placeholder="% de comisionista" id="pcomisionista" name="pcomisionista" value="<?php echo $pcomisionista; ?>" class="form-control">
					</div>
					<div class="col-2">
						<label for="psocios">% de socios</label>
						<input type="text" placeholder="% de socios" id="psocios" name="psocios" value="<?php echo $psocios; ?>" class="form-control">
					</div>
					<div class="col-2">
						<label for="pikito">pikito</label>
						<input type="text" placeholder="pikito" id="pikito" name="pikito" value="<?php echo $pikito; ?>" class="form-control">
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
