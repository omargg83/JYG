<?php
	require_once("../a_clientes/db_clientes.php");
	$db = new Clientes();
?>	

<div class="card">
	<div class="card-header">Buscar cliente</div>
	<div class="card-body">
		<div clas='row'>
			<input type="text" name="cliente_bus" id='cliente_bus' placeholder='buscar cliente' class='form-control'>
		</div>
	</div>
	<div class="card-footer">
		<div class='btn-group'>
			<button class='btn btn-outline-secondary btn-sm' type='button' id='buscar_cliente'><i class='fas fa-search'></i>Buscar</button>
			<button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i>Cerrar</button>
		</div>
	</div>
	<div class='container' id='resultadosx'>	
	</div>
</div>



