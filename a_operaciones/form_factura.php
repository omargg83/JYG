<?php
	require_once("db_operaciones.php");

	$uso=$db->uso_fact();
	$forma=$db->forma();
	if (isset($_REQUEST['id'])){
		$id=$_REQUEST['id'];
	}
	if (isset($_REQUEST['id2'])){
		$id2=$_REQUEST['id2'];
	}
	if (isset($_REQUEST['id3'])){
		$id3=$_REQUEST['id3'];
	}

	if($id>0){
		$row=$db->facturas_edit($id);
		$fecha=fecha($row['fecha']);
		$monto=$row['monto'];
		$iduso=$row['iduso'];
		$idforma=$row['idforma'];
		$descripcion=$row['descripcion'];
		$iva=$row['iva'];
		$subtotal=$row['subtotal'];
	}
	else{
		$fecha=date("d-m-Y");
		$monto=0;
		$iduso="";
		$idforma="";
		$descripcion="";
		$iva=0;
		$subtotal=0;
	}
if($id3>0){
	echo "<form action='' id='form_fact' data-lugar='a_operaciones/db_operaciones' data-funcion='guardar_factura' data-destino='a_operaciones/op_facturas' data-div='facturas'>";
}
else{
	echo "<form action='' id='form_fact' data-lugar='a_operaciones/db_operaciones' data-funcion='guardar_factura' data-destino='a_operaciones/editar'>";
}


?>


<input type="hidden" id="id" name="id" value="<?php echo $id; ?>" class="form-control fechaclass" autocomplete=off>
<input type="hidden" id="idoper_fact" name="idoper_fact" value="<?php echo $id2; ?>" class="form-control fechaclass" autocomplete=off>
	<div class='card'>
		<div class="card-header">Factura</div>
		<div class='card-body'>
			<div class='row'>
				<div class="col-3">
					<label for="fecha_fact">Fecha</label>
					<input type="text" placeholder="Fecha" id="fecha_fact" name="fecha_fact" value="<?php echo $fecha; ?>" class="form-control fechaclass" autocomplete=off>
				</div>

				<div class="col-5">
					<label for="uso">Uso de la factura</label>
					<select class="form-control" id="iduso" name="iduso">
						<?php
							foreach ($uso as $key) {
								echo "<option value='".$key['id']."'"; if($iduso==$key['id']){ echo " selected";} echo ">".$key['clave']." - ".$key['desc']."</option>";
							}
						?>
					</select>
				</div>

				<div class="col-4">
					<label for="uso">Forma de pago</label>
					<select class="form-control" id="idforma" name="idforma">
						<?php
							foreach ($forma as $key) {
								echo "<option value='".$key['id']."'"; if($idforma==$key['id']){ echo " selected";} echo ">".$key['pago']."</option>";
							}
						?>
					</select>
				</div>



				<div class="col-12">
					<label>Descripción</label>
					<input type="text" placeholder="descripcion" id="descripcion" name="descripcion" value="<?php echo $descripcion; ?>" class="form-control" autocomplete=off>
				</div>

				<div class="col-3">
					<label>Monto</label>
					<input type="text" placeholder="Monto" id="monto_fact" name="monto_fact" value="<?php echo $monto; ?>" class="form-control" autocomplete=off onchange='desgloce()'>
				</div>

				<div class="col-3">
					<label>Subtotal</label>
					<input type="text" placeholder="Subtotal" id="subtotal" name="subtotal" value="<?php echo $subtotal; ?>" class="form-control" autocomplete=off onchange='desgloce()'>
				</div>

				<div class="col-3">
					<label>Iva</label>
					<input type="text" placeholder="Iva" id="iva" name="iva" value="<?php echo $iva; ?>" class="form-control" autocomplete=off onchange='desgloce()'>
				</div>



			</div>
		</div>
		<div class='card-footer'>
			<div class='row'>
				<div class="col-12">
					<div class='btn-group'>
						<button class="btn btn-outline-secondary btn-sm" type="submit"><i class='far fa-save'></i>Guardar</button>
						<button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i>Cerrar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>

	<script>
	$(function() {
		fechas();
	});
</script>
