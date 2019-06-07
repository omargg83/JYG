<?php
	require_once("db_operaciones.php");
	$db = new Operaciones();
	

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
	}
	else{
		$fecha=date("d-m-Y");
		$monto=0;
		$uso="";
		$forma="";
	}
?>

<form action="" id="form_fact" data-lugar="a_operaciones/db_operaciones" data-funcion="guardar_factura" data-destino='a_operaciones/op_facturas' data-div='facturas'>
<input type="hidden" id="id" name="id" value="<?php echo $id; ?>" class="form-control fechaclass" autocomplete=off>
<input type="hidden" id="idoper_fact" name="idoper_fact" value="<?php echo $id2; ?>" class="form-control fechaclass" autocomplete=off>
	<div class='card'>
		<div class="card-header">Factura</div>
		<div class='card-body'>
			<div class='row'>
				<div class="col-4">
					<label for="fecha_fact">Fecha</label>
					<input type="text" placeholder="Fecha" id="fecha_fact" name="fecha_fact" value="<?php echo $fecha; ?>" class="form-control fechaclass" autocomplete=off>
				</div>

				<div class="col-4">
					<label for="uso">Uso de la factura</label>
					<input type="text" placeholder="uso" id="uso" name="uso" value="<?php echo $uso; ?>" class="form-control" autocomplete=off>
				</div>


				<div class="col-4">
					<label for="forma">Forma de pago</label>
					<input type="text" placeholder="forma" id="forma" name="forma" value="<?php echo $forma; ?>" class="form-control" autocomplete=off>
				</div>

				<div class="col-4">
					<label for="monto">Monto</label>
					<input type="text" placeholder="monto" id="monto" name="monto" value="<?php echo $monto; ?>" class="form-control" autocomplete=off>
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