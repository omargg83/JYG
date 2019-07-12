<?php
  require_once("db_operaciones.php");
?>

<div class="card">
<form id='form_buscacliente' action=''>
	<div class="card-header">Buscar cliente</div>
	<div class="card-body">
		<div clas='row'>
			<input type="text" name="cliente_bus" id='cliente_bus' placeholder='buscar cliente' class='form-control' autocomplete=off>
		</div>
	</div>
	<div class="card-footer">
		<div class='btn-group'>
			<button class='btn btn-outline-secondary btn-sm' type='submit' id='lista_cliente' data-lugar='a_operaciones/lista_cliente' data-valor='cliente_bus' data-function='buscar_cliente' data-div='resultadosx' ><i class='fas fa-search'></i>Buscar</button>
			<button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i>Cerrar</button>
		</div>
	</div>
</form>
	<div class='container' id='resultadosx'>
	</div>
</div>
