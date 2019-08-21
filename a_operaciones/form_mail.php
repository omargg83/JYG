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
  $ret = $db->retorno($id2);

  $nombre=$oper['operador'];
  $correo=$oper['correo'];
  $texto="";   //  <----------------------aqui poner texto predeterminado";
?>

<div class="card">
<form action='' id='form_fact' data-lugar='a_operaciones/db_operaciones' data-funcion='notificar' data-destino='a_operaciones/editar'>
  <input type="hidden" name="id" id='id' value='<?php echo $id2; ?>' class='form-control'>
	<div class="card-header">Enviar correo</div>
	<div class="card-body">
		<div class='row'>
      <div class='col-6'>
          <label>Nombre</label>
			    <input type="text" name="cliente_bus" id='cliente_bus' placeholder='Nombre' value='<?php echo $nombre; ?>' class='form-control' autocomplete="off">
      </div>
      <div class='col-6'>
        <label>correo</label>
			  <input type="text" name="correo" id='correo' placeholder='Correo' value='<?php echo $correo; ?>' class='form-control' autocomplete="off">
      </div>
		</div>
    <div class='row'>
      <div class='col-12'>
          <label>Texto</label>
          <textarea id='texto' name='texto' class='form-control'><?php echo $texto; ?></textarea>
      </div>
    </div>

    <div class='row'>
      <div class='col-4'>
          <label>Factura:</label>
          <?php
            echo "<select id='idfactura' name='idfactura' class='form-control' onchange='solicitud()' >";
            echo "<option value='' disabled selected>Seleccione una factura</option>";
            foreach($fact as $key){
              echo "<option value='".$key['idfactura']."'>".$key['fecha']." - ".$key['monto']."</option>";
            }
            echo "</select>";
          ?>
          <input type="hidden" name="file" id='file' placeholder='file' value='' class='form-control' autocomplete="off" required>
          <input type="hidden" name="comprobante" id='comprobante' placeholder='comprobante' value='' class='form-control' autocomplete="off" required>
      </div>
      <div class='col-sm-4' id='trans_visible' style='display:none;'>
        <label>Transferencia: </label><br>
        <input type='checkbox' name='com_pago' id='com_pago' value=1 onchange='comprobante_adj()'>
      </div>
      <div class='col-2' id='archivo'>
      </div>
      <div class='col-2' id='compro_file'>
      </div>

    </div>


    <div class='row'>
      <div class='col-10'>
          <label>Retorno:</label>
          <?php
            echo "<select id='idretorno' name='idretorno' class='form-control' onchange='solicitud_ret()' >";
            echo "<option value='' disabled selected>Seleccione un retorno</option>";
            foreach($ret as $key){
              echo "<option value='".$key['idretorno']."'>".$key['fecha']." - ".$key['monto']."</option>";
            }
            echo "</select>";
          ?>
          <input type="hidden" name="file_ret" id='file_ret' placeholder='file_ret' value='' class='form-control' autocomplete="off" required>
      </div>
      <div class='col-2' id='archivo_ret'>
      </div>
    </div>

	</div>
	<div class="card-footer">
		<div class='btn-group'>
			<button class="btn btn-outline-secondary btn-sm" type="submit"><i class='far fa-save'></i>Enviar</button>
			<button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i>Cerrar</button>
		</div>
	</div>
</form>
	<div class='container' id='resultadosx'>
	</div>
</div>
