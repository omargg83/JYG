<?php
require_once("db_operaciones.php");
$id=$_REQUEST['id'];

if($id>0){
	$pers = $db->operacion_edit($id);
	$fecha=fecha($pers['fecha']);
	$monto=$pers['monto'];
	$idrazon=$pers['idrazon'];
	$idempresa=$pers['idempresa'];
	$disabled="";
	$fact = $db->facturas($id);
	$bloqueo=count($fact);
}
else{
	$disabled=0;
	$disabled='disabled';
	$monto=0;
	$bloqueo=0;
	$idrazon="";
	$idempresa="";
	$fecha=date("d-m-Y");
}
$cli=$db->razon();
$empresa=$db->empresa();
echo "<div class='container'>";
?>
<form action="" id="form_operacion" data-lugar="a_operaciones/db_operaciones" data-funcion="guardar_operacion" data-destino='a_operaciones/editar'>
	<input type="hidden" id="idrazon" name="idrazon" value="<?php echo $idrazon; ?>" class="form-control">
	<input type="hidden" id="idempresa" name="idempresa" value="<?php echo $idempresa; ?>" class="form-control">
	<div class="card">

		<div class="card-header">
			<center>OPERACIÓN <?php echo $id; ?></center>
			<ul class='nav nav-tabs card-header-tabs nav-fill' id='myTab' role='tablist'>
				<li class='nav-item'>
					<a class='nav-link active' id='ssh-tab' data-toggle='tab' href='#ssh' role='ssh' aria-controls='home' aria-selected='true'>Datos</a>
				</li>
				<li class='nav-item'>
					<a class='nav-link <?php echo $disabled; ?>' id='home-tab' data-toggle='tab' href='#home' role='tab' aria-controls='home' aria-selected='true'>Facturas</a>
				</li>
				<li class='nav-item'>
					<a class='nav-link <?php echo $disabled; ?>' id='retorno-tab' data-toggle='tab' href='#retorno' role='tab' aria-controls='retorno' aria-selected='false'>Retornos</a>
				</li>
			</ul>
		</div>
		<div class="card-body">
			<div class='tab-content' id='myTabContent'>
				<div class='tab-pane fade show active' id='ssh' role='tabpanel' aria-labelledby='ssh-tab'>
					<div class="row">
						<div class="col-3">
							<label for="fecha">Número</label>
							<input type="text" placeholder="Número" id="id" name="id" value="<?php echo $id; ?>" class="form-control" readonly>
						</div>

						<div class="col-2">
							<label for="fecha">Fecha</label>
							<input type="text" placeholder="Fecha" id="fecha" name="fecha" value="<?php echo $fecha; ?>" class="form-control fechaclass" autocomplete=off>
						</div>

						<div class="col-3">
							<label for="monto">Monto</label>
							<input type="number" step='any' placeholder="monto" id="monto" name="monto" value="<?php echo $monto; ?>" class="form-control" autocomplete=off>
						</div>
					</div>

					<div class='row'>
						<div class="col-6">
							<label for="cliente">Cliente</label>
							<select id='idrazon' name='idrazon' class='form-control' required>
								<?php
									echo "<option disabled >Seleccione una opción</option>";
									foreach ($cli as $key ) {
										echo "<option value='".$key['idrazon']."'"; if($idrazon==$key['idrazon']) { echo "selected"; } echo ">".$key['cliente']." - ".$key['razon']."</option>";
									}
								?>
							</select>
						</div>

						<div class="col-6">
							<label for="cliente">Empresa</label>
							<select id='idempresa' name='idempresa' class='form-control' required>
								<?php
									echo "<option disabled >Seleccione una opción</option>";
									foreach ($empresa as $key ) {
										echo "<option value='".$key['idempresa']."'"; if($idempresa==$key['idempresa']) { echo "selected"; } echo ">".$key['nombre']." - ".$key['razon']."</option>";
									}
								?>
							</select>
						</div>
					</div><br>

					<div class="row">
						<div class="col-12">
							<div class="btn-group">
								<?php
									if($bloqueo==0){
									echo "<button class='btn btn-outline-secondary btn-sm' type='submit'><i class='far fa-save'></i>Guardar</button>";
									}
								?>
								<button class='btn btn-outline-secondary btn-sm' id='lista_penarea' data-lugar='a_operaciones/lista' title='regresar'><i class='fas fa-undo-alt'></i>Regresar</button>
							</div>
						</div>
					</div>

				</div>
				<div class='tab-pane fade show' id='home' role='tabpanel' aria-labelledby='home-tab'>
					<div class="row" id='facturas'>
						<?php include "op_facturas.php"; ?>
					</div>
				</div>

				<div class='tab-pane fade show' id='retorno' role='tabpanel' aria-labelledby='retorno-tab'>
					<div class="row" id='retornos'>
						<?php include "op_retorno.php"; ?>
					</div>
				</div>
			</div>


		</div>



	</div>
</form>
</div>

<script>
$(function() {
	fechas();
	$(document).ready( function () {
		$('table.datatable').DataTable({
			"pageLength": 100,
			"language": {
				"sSearch": "Buscar aqui",
				"lengthMenu": "Mostrar _MENU_ registros",
				"zeroRecords": "No se encontró",
				"info": " Página _PAGE_ de _PAGES_",
				"infoEmpty": "No records available",
				"infoFiltered": "(filtered from _MAX_ total records)",
				"paginate": {
					"first":      "Primero",
					"last":       "Ultimo",
					"next":       "Siguiente",
					"previous":   "Anterior"
				},
			}
		});
	});
});
</script>
