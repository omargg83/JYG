<?php
	require_once("db_operaciones.php");
	$db = new Operaciones();
?>	
<div class="card">
	<div class="card-header">Buscar despachos</div>
	<div class="card-body">
		<div clas='row'>
			<input type="text" name="despacho_bus" id='despacho_bus' placeholder='buscar despacho' class='form-control'>
		</div>
	</div>
	<div class="card-footer">
		<div class='btn-group'>
			<button class='btn btn-outline-secondary btn-sm' type='button' id='buscar_despacho'><i class='fas fa-search'></i>Buscar</button>
			<button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i>Cerrar</button>
		</div>
	</div>
	<div class='container' id='resultadosx'>	
	</div>
</div>

