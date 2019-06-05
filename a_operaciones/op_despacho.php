<?php 
	require_once("db_operaciones.php");
	$db = new Operaciones();
	if (isset($_REQUEST['idempresa'])){
		$idempresa=$_REQUEST['idempresa'];
	}
	if($idempresa>0){
		$row=$db->despachos_operedit($idempresa);
		$nombre=$row['nombre'];
		$socio=$row['socio'];
		$razon=$row['razon'];
	}
	else{
		$nombre="";
		$socio="";
		$razon="";
	}
?>	
	<div class="col-4">
		<label for="cliente">Despacho</label>
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<button type='button' class='btn btn-outline-secondary btn-sm' id='winmodal_cargo' data-id='$id' data-id2='$t_idcargo' data-id3='$t_area' data-lugar='a_operaciones/form_despachos'><i class="fas fa-folder-plus"></i></button>
			</div>
			<input type="text" placeholder="Cliente" id="nombre" name="nombre" value="<?php echo $nombre; ?>" class="form-control" readonly>
		</div>
	</div>

	<div class="col-4">
		<label for="rfc">Socio</label>
		<input type="text" placeholder="Socio" id="socio" name="socio" value="<?php echo $socio; ?>" class="form-control" readonly>
	</div>

	<div class="col-4">
		<label for="razon">Razon</label>
		<input type="text" placeholder="Razon" id="razon" name="razon" value="<?php echo $razon; ?>" class="form-control" readonly>
	</div>
