<?php
	require_once("db_operaciones.php");
	$db = new Operaciones();
	if (isset($_REQUEST['id'])){
		$id=$_REQUEST['id'];
	}
	if (isset($_REQUEST['id2'])){
		$id2=$_REQUEST['id2'];
	}
	if (isset($_REQUEST['id3'])){
		$idempresa=$_REQUEST['id3'];
	}
	if($id>0){
		$row=$db->retorno_edit($id);
		$fecha=fecha($row['fecha']);
		$monto=$row['monto'];
	}
	else{
		$fecha=date("d-m-Y");
		$monto=0;
	}
	$despa=$db->despachos_operedit($idempresa);
	$iddespacho=$despa['iddespacho'];
	$prod=$db->producto_despacho($iddespacho);
?>

<form action="" id="form_fact" data-lugar="a_operaciones/db_operaciones" data-funcion="guardar_retorno" data-destino='a_operaciones/op_retorno' data-div='retornos'>
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
					<label for="monto">Productos</label>
					<select id='idproducto_selx' name='idproducto_selx' class="form-control" >
						<?php 
							foreach($prod as $val){
								echo "<option value='".$val['idproducto']."'>".$val['producto']."</option>";

							}

						?>
					</select>
				</div>
				<div class="col-4">
					<label for="monto">Monto a</label>
					<input type="text" placeholder="monto" id="monto" name="monto" value="<?php echo $monto; ?>" class="form-control" autocomplete=off>
				</div>

			</div>

			<div id='producto_tipo'></div>
			
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