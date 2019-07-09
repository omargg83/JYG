<?php
  require_once("db_operaciones.php");
  if (isset($_REQUEST['id'])){
  	$id=$_REQUEST['id'];
  }
  if (isset($_REQUEST['id2'])){
  	$id2=$_REQUEST['id2'];
  }
  $oper=$db->operador_edit($id);
  $fact = $db->facturas($id2);

  $nombre=$oper['operador'];
  $correo=$oper['correo'];
  $texto="";
?>

<div class="card">
<form id='form_buscar' action=''>
	<div class="card-header">Enviar correo</div>
	<div class="card-body">
		<div class='row'>
      <div class='col-6'>
          <label>Nombre</label>
			    <input type="text" name="cliente_bus" id='cliente_bus' placeholder='Nombre' value='<?php echo $nombre; ?>' class='form-control' autocomplete="off">
      </div>
      <div class='col-6'>
        <label>correo</label>
			  <input type="text" name="cliente_bus" id='cliente_bus' placeholder='Nombre' value='<?php echo $correo; ?>' class='form-control' autocomplete="off">
      </div>
		</div>
    <div class='row'>
      <div class='col-12'>
          <label>Texto</label>
          <textarea id='texto' name='texto' class='form-control'><?php echo $texto; ?></textarea>
      </div>
    </div>

    <div class='row'>
      <div class='col-12'>
          <label>Factura:</label>
          <?php
            echo "<select id='idfactura' name='idfactura' class='form-control' required >";
            foreach($fact as $key){
              echo "<option value='".$key['idfactura']."'>".$key['fecha']." - ".$key['monto']."</option>";
            }
            echo "</select>";
          ?>
      </div>
    </div>


	</div>
	<div class="card-footer">
		<div class='btn-group'>
			<button class='btn btn-outline-secondary btn-sm' type='submit' id='lista_buscar' data-lugar='a_operaciones/lista_empresa' data-valor='cliente_bus' data-function='buscar_empresa' data-div='resultadosx'><i class='fas fa-search'></i>Enviar</button>
			<button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i>Cerrar</button>
		</div>
	</div>
</form>
	<div class='container' id='resultadosx'>
	</div>
</div>
