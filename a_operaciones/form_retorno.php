<?php
require_once("db_operaciones.php");
if (isset($_REQUEST['id'])){
	$id=$_REQUEST['id'];
}
if (isset($_REQUEST['id2'])){
	$id2=$_REQUEST['id2'];
}

$pers = $db->operacion_edit($id2);
$finalizar=$pers['finalizar'];
$idempresa=$pers['idempresa'];
$idrazon=$pers['idrazon'];
$esquema=$pers['esquema'];

$despa=$db->empresa_despacho($idempresa);
$iddespacho=$despa['iddespacho'];
$prod=$db->producto_despacho($iddespacho);

$fecha=date("d-m-Y");
$monto=0;
$idproducto=0;
$comision=0;
$tcomision=0;
$creal=0;
$retorno=0;
$folio="";
$persona="";
$empresa="";
$lugar="";
$tcomisionjg="";
$retornojg="";

if($id>0){
	$row=$db->retorno_edit($id);
	$fecha=fecha($row['fecha']);
	$monto=$row['monto'];
	$idproducto=$row['idproducto'];
	$comision=$row['comision'];
	$tcomision=$row['tcomision'];
	$creal=$row['creal'];
	$retorno=$row['retorno'];
	$folio=$row['folio'];
	$persona=$row['persona'];
	$empresa=$row['empresa'];
	$lugar=$row['lugar'];
	$tcomisionjg=$row['tcomisionjg'];
	$retornojg=$row['retornojg'];
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
					<label for="monto">Producto</label>
					<select id='idproducto_selx' name='idproducto_selx' class="form-control retorno" onchange="retornoret()">
						<option selected disabled>Seleccione una opcion</option>
						<?php
						foreach($prod as $val){
							echo "<option value='".$val['idproducto']."' "; if($idproducto==$val['idproducto']) { echo " selected ";} echo " >".$val['producto']."</option>";
						}
						?>
					</select>
				</div>

				<div class="col-4">
					<label for="monto_ret">Monto a retornar</label>
					<input type="text" placeholder="Retorno" id="monto_ret" name="monto_ret" value="<?php echo $monto; ?>" class="form-control retorno" autocomplete=off onchange="retornoret()">
				</div>
			</div>

			<div class='row'>
				<div class="col-3">
					<label for="fecha_fact">Fecha de retorno</label>
					<input type="text" placeholder="Fecha" id="fecha_fact" name="fecha_fact" value="<?php echo $fecha; ?>" class="form-control fechaclass" autocomplete=off onchange="retornoret()">
				</div>

				<div class="col-3">
					<label for="Folio">Folio:</label>
					<input type="text" placeholder="Folio" id="folio" name="folio" value="<?php echo $folio; ?>" class="form-control" autocomplete=off onchange="retornoret()">
				</div>

				<div class="col-5">
					<label for="persona">Persona Beneficiaria:</label>
					<input type="text" placeholder="Beneficiario" id="persona" name="persona" value="<?php echo $persona; ?>" class="form-control" autocomplete=off onchange="retornoret()">
				</div>

				<div class="col-6">
					<label for="empresa">Empresa que emite:</label>
					<input type="text" placeholder="Empresa que emite" id="empresa" name="empresa" value="<?php echo $empresa; ?>" class="form-control" autocomplete=off onchange="retornoret()">
				</div>

				<div class="col-6">
					<label for="lugar">Lugar de entrega:</label>
					<input type="text" placeholder="Lugar de entrega" id="lugar" name="lugar" value="<?php echo $lugar; ?>" class="form-control" autocomplete=off onchange="retornoret()">
				</div>
			</div>

			<div id='producto_tipo'>
				<?php
					if($esquema==5){
				?>

				<div class='row'>
					<div class='col-4'>
						<label for='comision_ret'>% Comisión Cli./Desp.</label>
						<input type='text' placeholder='Comisión' id='comision_ret' name='comision_ret' value='<?php echo $comision; ?>' class='form-control' autocomplete=off onchange="retornoret()" >
					</div>

					<div class='col-4'>
						<label for='tcomision_ret'>Comisión Cli./Desp.</label>
						<input type='text' placeholder='Comisión' id='tcomision_retcli' name='tcomision_retcli' value='<?php echo $tcomision; ?>' class='form-control' autocomplete=off >
					</div>

					<div class='col-4'>
						<label for='retorno_ret'>Retorno Cli./Desp.</label>
						<input type='text' placeholder='Retorno' id='retorno_retcli' name='retorno_retcli' value='<?php echo $retorno; ?>' class='form-control' autocomplete=off >
					</div>

					<div class='col-4'>
						<label for='creal_r'>% Comisión J&G</label>
						<input type='text' placeholder='Comisión' id='creal_ret' name='creal_ret' value='<?php echo $creal; ?>' class='form-control' autocomplete=off onchange="retornoret()">
					</div>

					<div class='col-4'>
						<label for='tcomision_ret'>Comisión J&G</label>
						<input type='text' placeholder='Comisión' id='tcomision_retjg' name='tcomision_retjg' value='<?php echo $tcomisionjg; ?>' class='form-control' autocomplete=off >
					</div>

					<div class='col-4'>
						<label for='retorno_ret'>Retorno J&G</label>
						<input type='text' placeholder='Retorno' id='retorno_retjg' name='retorno_retjg' value='<?php echo $retornojg; ?>' class='form-control' autocomplete=off >
					</div>

				</div>
				<?php
					}
			 ?>
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
