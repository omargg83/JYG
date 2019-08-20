<?php
	require_once("db_comisionistas.php");
	$db = new Comisionistas();
	$id=$_REQUEST['id'];
	if($id>0){
		$pers = $db->comisionista_edit($id);
		$nombre=$pers['nombre'];
		$email=$pers['email'];
		$telefono=$pers['telefono'];
		$banco=$pers['banco'];
		$cuentabanco=$pers['cuentabanco'];
		$rfc=$pers['rfc'];
		$cumple=fecha($pers['cumple']);


	}
	else{
		$nombre="";
		$email="";
		$telefono="";
		$banco="";
		$cuentabanco="";
		$rfc="";
		$cumple=date("d-m-Y");

	}
?>
<div class="container">
	<form action="" id="form_personal" data-lugar="a_comisionistas/db_comisionistas" data-funcion="guardar_comisionista">
		<input type="hidden" value="<?php echo $id; ?>" name="id" id="id">
		<div class="card">
			<div class="card-header">Comisionista</div>
			<div class="card-body">
				<div class="row">
					<div class="col-5">
						<label for="nombre">Nombre</label>
						<input type="text" placeholder="Nombre" id="nombre" name="nombre" value="<?php echo $nombre; ?>" class="form-control">
					</div>

					<div class="col-5">
						<label for="rfc">Rfc</label>
						<input type="text" placeholder="Rfc" id="rfc" name="rfc" value="<?php echo $rfc; ?>" class="form-control">
					</div>

					<div class="col-3">
						<label for="email">Email</label>
						<input type="text" placeholder="Email" id="email" name="email" value="<?php echo $email; ?>" class="form-control" required>
					</div>
					<div class="col-3">
						<label for="telefono">Telefono</label>
						<input type="text" placeholder="Telefono" id="telefono" name="telefono" value="<?php echo $telefono; ?>" class="form-control" required>
					</div>
					<div class="col-4">
						<label for="banco">Banco</label>
						<input type="text" placeholder="Banco" id="banco" name="banco" value="<?php echo $banco; ?>" class="form-control" required>
					</div>
					<div class="col-4">
						<label for="cuentabanco">Cuenta bancaria</label>
						<input type="text" placeholder="Cuenta bancaria" id="cuentabanco" name="cuentabanco" value="<?php echo $cuentabanco; ?>" class="form-control" required>
					</div>

					<div class="col-2">
						<label for="cumple">Cumpleaños</label>
						<input type="text" placeholder="Cumple" id="cumple" name="cumple" value="<?php echo $cumple; ?>" class="form-control fechaclass" autocomplete=off >
					</div>
				</div>
			</div>
			<div class="card-footer">
				<div class="row">
					<div class="col-12">
						<div class="btn-group">
							<button class="btn btn-outline-secondary btn-sm" type="submit"><i class='far fa-save'></i>Guardar</button>
							<button class='btn btn-outline-secondary btn-sm' id='lista_penarea' data-lugar='a_comisionistas/lista' title='regresar'><i class='fas fa-undo-alt'></i>Regresar</button>
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
