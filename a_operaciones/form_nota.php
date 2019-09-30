<?php
require_once("db_operaciones.php");
$id=$_REQUEST['id'];
$row=$db->operacion_edit($id);

  if($id>0){
    $nota=$row['nota'];
  }
  else{
    $nota="";
  }
?>

<div class="card">
<form action='' id='form_nota' data-lugar='a_operaciones/db_operaciones' data-funcion='guardar_nota' data-destino='a_operaciones/editar'>

	<div class="card-header">Agregar Nota</div>
	<div class="card-body">
    <div class='row'>
      <div class="col-12">
        <label for="nota">Nota:</label>
        <textarea id='nota' name='nota' class="form-control"><?php echo $nota; ?></textarea>
      </div>

      <div class="col-4">
        <label for="id"></label>
        <input type="hidden" placeholder="id" id="id" name="id" value="<?php echo $id; ?>" class="form-control retorno" autocomplete=off >
      </div>

    </div>

	</div>

	<div class="card-footer">
		<div class='btn-group'>
			<button class="btn btn-outline-secondary btn-sm" type="submit"><i class='far fa-save'></i>Guardar</button>
			<button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i>Cerrar</button>
		</div>
	</div>
</form>
	<div class='container' id='resultadosx'>
	</div>
</div>
