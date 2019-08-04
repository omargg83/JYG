<?php
	require_once("db_gastos.php");
	$db = new Gastos();
	$id=$_REQUEST['id'];
	if($id>0){
		$pers = $db->gastos_edit($id);
		$fecha=fecha($pers['fecha']);
		$gasto=$pers['gasto'];
		$descripcion=$pers['descripcion'];
		$costo=$pers['costo'];


	}
	else{
		$fecha=date("d-m-Y");
		$gasto="";
		$descripcion="";
		$costo="0";

	}
?>
<div class="container">
	<form action="" id="form_personal" data-lugar="a_gastos/db_gastos" data-funcion="guardar_gastos">
		<input type="hidden" value="<?php echo $id; ?>" name="id" id="id">
		<div class="card">
			<div class="card-header">Gasto</div>
			<div class="card-body">
				<div class="row">
					<div class="col-2">
						<label for="fecha">Fecha</label>
						<input type="text" placeholder="Fecha" id="fecha" name="fecha" value="<?php echo $fecha; ?>" class="form-control fechaclass" autocomplete=off >
					</div>

					<div class="col-7">
						<label for="gasto">Gasto</label>
						<input type="gasto" placeholder="Gasto" id="gasto" name="gasto" value="<?php echo $gasto; ?>" class="form-control" required>
					</div>
					<div class="col-9">
						<label for="descripcion">Descripción</label>
						<input type="text" placeholder="Descripción" id="descripcion" name="descripcion" value="<?php echo $descripcion; ?>" class="form-control" required>
					</div>
					<div class="col-3">
						<label for="costo">Costo</label>
						<input type="number" step='any' placeholder="Costo" id="costo" name="costo" value="<?php echo $costo; ?>" class="form-control" autocomplete=off  required dir='rtl'>
					</div>

				</div>
			</div>
			<div class="card-footer">
				<div class="row">
					<div class="col-12">
						<div class="btn-group">
							<button class="btn btn-outline-secondary btn-sm" type="submit"><i class='far fa-save'></i>Guardar</button>
							<button class='btn btn-outline-secondary btn-sm' id='lista_penarea' data-lugar='a_gastos/lista' title='regresar'><i class='fas fa-undo-alt'></i>Regresar</button>
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
