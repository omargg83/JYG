<?php
require_once("db_operaciones.php");
if (isset($_REQUEST['id'])){
	$id=$_REQUEST['id'];
}
if (isset($_REQUEST['id2'])){
	$id2=$_REQUEST['id2'];
}
if (isset($_REQUEST['id3'])){
	$idempresa=$_REQUEST['id3'];
}
$despa=$db->empresa_despacho($idempresa);
$iddespacho=$despa['iddespacho'];
$prod=$db->producto_despacho($iddespacho);

$fecha=date("d-m-Y");
$monto=0;
$pventa=0;
$idproducto=0;
$monto_retorno=0;
$comision=0;
$pikito=0;
$monto_pikito=0;
$saldo=0;
$despacho=0;
$monto_despacho=0;
$saldodesp=0;
if($id>0){
	$row=$db->retorno_edit($id);
	$fecha=fecha($row['fecha']);
	$monto=$row['monto'];
	$pventa=$row['pventa'];
	$idproducto=$row['idproducto'];
	$monto_retorno=$row['monto_retorno'];
	$comision=$row['comision'];
	$pikito=$row['pikito'];
	$monto_pikito=$row['monto_pikito'];
	$saldo=$row['saldo'];
	$despacho=$row['despacho'];
	$monto_despacho=$row['monto_despacho'];
	$saldodesp=$row['saldodesp'];
}

?>

<form action="" id="form_fact" data-lugar="a_operaciones/db_operaciones" data-funcion="guardar_retorno" data-destino='a_operaciones/editar' >
	<input type="hidden" id="id" name="id" value="<?php echo $id; ?>" class="form-control fechaclass" autocomplete=off>
	<input type="hidden" id="idoper_fact" name="idoper_fact" value="<?php echo $id2; ?>" class="form-control fechaclass" autocomplete=off>
	<div class='card'>
		<div class="card-header">Retornos</div>
		<div class='card-body'>
			<div class='row'>
				<div class="col-4">
					<label for="fecha_fact">Fecha de retorno</label>
					<input type="text" placeholder="Fecha" id="fecha_fact" name="fecha_fact" value="<?php echo $fecha; ?>" class="form-control fechaclass" autocomplete=off>
				</div>
				<div class="col-4">
					<label for="monto">Monto a retornar</label>
					<input type="text" placeholder="Retorno" id="monto_r" name="monto_r" value="<?php echo $monto; ?>" class="form-control retorno" autocomplete=off>
				</div>
				<div class="col-4">
					<label for="monto">Producto</label>
					<select id='idproducto_selx' name='idproducto_selx' class="form-control retorno">
						<option selected disabled>Seleccione una opcion</option>
						<?php
						foreach($prod as $val){
							echo "<option value='".$val['idproducto']."' "; if($idproducto==$val['idproducto']) { echo " selected ";} echo " >".$val['producto']."</option>";
						}
						?>
					</select>
				</div>

			</div>

			<div id='producto_tipo'>
				<div class='row'>

					<div class='col-4'>
						<label for='pventa'>% de venta pactado</label>
						<input type='text' placeholder='Porcentaje' id='pventa' name='pventa' value='<?php echo $pventa; ?>' class='form-control' autocomplete=off readonly>
					</div>

					<div class='col-4'>
						<label for='monto_retorno'>Monto a retornar</label>
						<input type='text' placeholder='monto' id='monto_retorno' name='monto_retorno' value='<?php echo $monto_retorno; ?>' class='form-control' autocomplete=off >
					</div>

					<div class='col-4'>
						<label for='comision'>Comisión</label>
						<input type='text' placeholder='Comisión' id='comision' name='comision' value='<?php echo $comision; ?>' class='form-control' autocomplete=off >
					</div>

				</div>

				<div class='row'>

					<div class='col-4'>
						<label for='pikito'>% Pikito</label>
						<input type='text' placeholder='% Pikito' id='pikito' name='pikito' value='<?php echo $pikito; ?>' class='form-control retorno' autocomplete=off>
					</div>

					<div class='col-4'>
						<label for='monto_pikito'>Pikito</label>
						<input type='text' placeholder='Pikito' id='monto_pikito' name='monto_pikito' value='<?php echo $monto_pikito; ?>' class='form-control' autocomplete=off>
					</div>

					<div class='col-4'>
						<label for='saldo'>Saldo</label>
						<input type='text' placeholder='Saldo' id='saldo' name='saldo' value='<?php echo $saldo; ?>' class='form-control' autocomplete=off>
					</div>

				</div>

				<div class='row'>

					<div class='col-4'>
						<label for='despacho'>% Despacho</label>
						<input type='text' placeholder='Despacho' id='despacho' name='despacho' value='<?php echo $despacho; ?>' class='form-control retorno' autocomplete=off>
					</div>

					<div class='col-4'>
						<label for='monto_despacho'>Monto despacho</label>
						<input type='text' placeholder='Monto despacho' id='monto_despacho' name='monto_despacho' value='<?php echo $monto_despacho; ?>' class='form-control' autocomplete=off readonly>
					</div>

					<div class='col-4'>
						<label for='saldo'>Saldo</label>
						<input type='text' placeholder='Saldo' id='saldodesp' name='saldodesp' value='<?php echo $saldodesp; ?>' class='form-control' autocomplete=off>
					</div>

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
