<?php
require_once("db_operaciones.php");
if (isset($_REQUEST['id'])){
	$id=$_REQUEST['id'];
}
if (isset($_REQUEST['id2'])){
	$id2=$_REQUEST['id2'];
}

if($id>0){
	$row=$db->facturas_edit($id);
	$fecha=fecha($row['fecha']);
	$monto=$row['monto'];
	$uso=$row['uso'];
	$forma=$row['forma'];
	$producto=$row['producto'];
	$descripcion=$row['descripcion'];
	$iva=$row['iva'];
	$subtotal=$row['subtotal'];
	$pers = $db->operacion_edit($id2);
	$finalizar=$pers['finalizar'];
}
else{
	$fecha=date("d-m-Y");
	$monto="";
	$uso="";
	$forma="";
	$producto="";
	$descripcion="";
	$iva="";
	$subtotal="";
	$finalizar=0;
}
$uso_array = $db->uso();
$forma_array = $db->forma_buscar();

?>
<form action='' id='form_fact' data-lugar='a_operaciones/db_operaciones' data-funcion='guardar_factura' data-destino='a_operaciones/editar'>
<input type="hidden" id="id" name="id" value="<?php echo $id; ?>" class="form-control" autocomplete=off>
<input type="hidden" id="idoper_fact" name="idoper_fact" value="<?php echo $id2; ?>" class="form-control" autocomplete=off>
<div class='card'>
	<div class="card-header">Factura</div>
	<div class='card-body'>
		<div class='row'>
			<div class="col-3">
				<label for="fecha_fact">Fecha</label>
				<input type="text" placeholder="Fecha" id="fecha_fact" name="fecha_fact" value="<?php echo $fecha; ?>" class="form-control fechaclass" autocomplete=off required>
			</div>

			<div class="col-9">
				<label>Concepto</label>
				<input type="text" placeholder="Concepto" id="descripcion" name="descripcion" value="<?php echo $descripcion; ?>" class="form-control" autocomplete=off>
			</div>

			<div class="col-12">
				<label for="uso">Uso de la factura</label>
					<select id='uso' name='uso' class="form-control retorno" onchange="retornoret()">
						<option selected disabled>Seleccione una opcion</option>
						<?php
						foreach($uso_array as $val){
							echo "<option value='".$val['clave']." - ".$val['descripcion']."' "; if($uso==$val['clave']." - ".$val['descripcion']) { echo " selected ";} echo " >".$val['clave']." - ".$val['descripcion']."</option>";
						}
						?>
					</select>
			</div>

			<div class="col-12">
				<label for="forma">Forma de pago</label>
				<select id='forma' name='forma' class="form-control retorno" onchange="retornoret()">
					<option selected disabled>Seleccione una opcion</option>
					<?php
					foreach($forma_array as $val){
						echo "<option value='".$val['pago']."' "; if($forma==$val['pago']) { echo " selected ";} echo " >".$val['pago']."</option>";
					}
					?>
				</select>



			</div>

			<div class="col-12">
				<label for="uso">Servicio</label>
				<input type="text" placeholder="servicio" id="producto" name="producto" value="<?php echo $producto; ?>" class="form-control" autocomplete=off>
				<div id='producto_auto' class='flotante'></div>
			</div>
		</div>

		<div class='row'>

			<div class="col-4">
				<label>Monto</label>
				<input type="text" placeholder="Monto" id="monto_fact" name="monto_fact" value="<?php echo $monto; ?>" class="form-control" autocomplete=off onchange='desgloce()' required>
			</div>

			<div class="col-4">
				<label>Iva</label>
				<input type="text" placeholder="Iva" id="iva_fact" name="iva_fact" value="<?php echo $iva; ?>" class="form-control" autocomplete=off onchange='desgloce()' required>
			</div>

			<div class="col-4">
				<label>Subtotal</label>
				<input type="text" placeholder="Subtotal" id="subtotal_fact" name="subtotal_fact" value="<?php echo $subtotal; ?>" class="form-control" autocomplete=off onchange='desgloce()' required>
			</div>

		</div>
	</div>
	<div class='card-footer'>
		<div class='row'>
			<div class="col-12">
				<div class='btn-group'>
					<?php
						if($finalizar==0){
					?>
					<button class="btn btn-outline-secondary btn-sm" type="submit"><i class='far fa-save'></i>Guardar</button>
					<?php
						}
					?>
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
