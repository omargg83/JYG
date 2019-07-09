<?php
  require_once("db_operaciones.php");
  if (isset($_REQUEST['id'])){
  	$id=$_REQUEST['id'];
  }
  if (isset($_REQUEST['id2'])){
  	$id2=$_REQUEST['id2'];
  }
  $pers = $db->operacion_edit($id2);
  $idempresa=$pers['idempresa'];
  $empresa=$db->empresa($idempresa);
  $iddespacho=$empresa['iddespacho'];
  $operadores=$db->operadores($iddespacho);
?>

<div class="card">
<form action='' id='form_fact' data-lugar='a_operaciones/db_operaciones' data-funcion='guardar_operador' data-destino='a_operaciones/editar'>
  <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" class="form-control" autocomplete=off>
  <input type="hidden" id="idoperacion" name="idoperacion" value="<?php echo $id2; ?>" class="form-control" autocomplete=off>
	<div class="card-header">Operador</div>
	<div class="card-body">
		<div clas='row'>
      <div class='col-6'>
        <label>Operador</label>
        <?php
        echo "<select id='idoper' name='idoper' class='form-control'  >";
        foreach($operadores as $key){
          echo "<option value='".$key['idoper']."'>".$key['operador']." - ".$key['correo']."</option>";
      	}
        echo "</select>";
  		  ?>
      </div>
		</div>
	</div>
	<div class="card-footer">
		<div class='btn-group'>
			<button class="btn btn-outline-secondary btn-sm" type="submit"><i class='far fa-save'></i>Agregar</button>
			<button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i>Cerrar</button>
		</div>
	</div>
</form>
	<div class='container' id='resultadosx'>
	</div>
</div>
