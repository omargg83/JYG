<?php
  require_once("db_operaciones.php");
  $data=$db->despachos();
?>

<div class="card">
<form id='form_buscar' action=''>
	<div class="card-header">Despachos</div>
	<div class="card-body">
		<div clas='row'>
      <?php
          echo "<select id='iddespacho_xsel' name='iddespacho_xsel' class='form-control' onchange='despachosel()' required>";
          echo "<option value='' disabled selected>Seleccione una opción</option>";
          foreach ($data as $key) {
            echo "<option value='".$key['iddespacho']."'>".$key['nombre']."</option>";
          }
          echo "</select>";
       ?>
		</div>
	</div>
	<div class="card-footer">
		<div class='btn-group'>
			<button class='btn btn-outline-secondary btn-sm' type='submit' id='lista_empresa' data-lugar='a_operaciones/lista_empresa' data-valor='cliente_bus' data-function='buscar_empresa' data-div='resultadosx'><i class='fas fa-search'></i>Buscar</button>
			<button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i>Cerrar</button>
		</div>
	</div>
</form>
	<div class='container' id='resultadosx'>
	</div>
</div>
