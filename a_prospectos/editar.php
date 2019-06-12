<?php
	require_once("db_.php");
	$id=$_REQUEST['id'];
	$ejecutivo= $db->personal();
	if($id>0){
		$pers = $db->prospecto_edit($id);
		$cliente=$pers['cliente'];
		$contacto=$pers['contacto'];
		$rfc=$pers['rfc'];
		$domicilio=$pers['domicilio'];
		$correo=$pers['correo'];
		$telefono=$pers['telefono'];
		$prospecto=$pers['prospecto'];
		$venta=$pers['venta'];
		$producto=$pers['producto'];
		$seguimiento=$pers['seguimiento'];
		$idpersona=$pers['idpersona'];
	}
	else{
		$cliente="";
		$contacto="";
		$rfc="";
		$domicilio="";
		$correo="";
		$telefono="";
		$prospecto="1";
		$venta="";
		$producto="";
		$seguimiento="";
		$idpersona="";
	}
?>
<div class="container">
	<form action="" id="form_personal" data-lugar="a_prospectos/db_" data-funcion="guardar_prospecto" data-destino='a_prospectos/editar'>
		<input type="hidden" value="<?php echo $id; ?>" name="id" id="id">
		<div class="card">
			<div class="card-header">Prospectos</div>
			<div class="card-body">
				<div class="row">
					<div class="col-2">
						<label for="rfc">RFC</label>
						<input type="text" placeholder="RFC" id="rfc" name="rfc" value="<?php echo $rfc; ?>" class="form-control" required>
					</div>
					<div class="col-5">
						<label for="cliente">Cliente</label>
						<input type="text" placeholder="Cliente" id="cliente" name="cliente" value="<?php echo $cliente; ?>" class="form-control">
					</div>
					<div class="col-4">
						<label for="contacto">Contacto</label>
						<input type="text" placeholder="Contacto" id="contacto" name="contacto" value="<?php echo $contacto; ?>" class="form-control" required>
					</div>
					<div class="col-7">
						<label for="domicilio">Domicilio</label>
						<input type="text" placeholder="Domicilio" id="domicilio" name="domicilio" value="<?php echo $domicilio; ?>" class="form-control">
					</div>
					<div class="col-4">
						<label for="correo">Correo</label>
						<input type="mail" placeholder="Correo electronico" id="correo" name="correo" value="<?php echo $correo; ?>" class="form-control" required>
					</div>
					<div class="col-4">
						<label for="telefono">Telefono</label>
						<input type="telefono" placeholder="Telefono / Telefonos" id="telefono" name="telefono" value="<?php echo $telefono; ?>" class="form-control" required>
					</div>
					<div class="col-3">
						<label for="iddespacho">Ejecutivo</label>
						<select class='form-control' id='idpersona' name='idpersona'>
							<?php
							foreach ($ejecutivo as $key => $value) {
								echo "<option"; if($idpersona==$value['idpersona']){ echo " selected"; } echo " value='".$value['idpersona']."'>".$value['nombre']."</option>";
							}
							?>
						</select>
					</div>
					<div class="col-4">
						<label for="producto">Producto Ofrecido</label>
						<input type="producto" placeholder="Producto" id="producto" name="producto" value="<?php echo $producto; ?>" class="form-control" required>
					</div>
					<div class="col-4">
						<label for="venta">% de Venta manejado</label>
						<input type="venta" placeholder="Venta" id="venta" name="venta" value="<?php echo $venta; ?>" class="form-control" required>
					</div>
					<div class="col-2">
						<label for="prospecto">Estatus</label>
						<select class='form-control' id='prospecto' name='prospecto'>
						<?php
							echo "<option"; if($prospecto==1){ echo " selected"; } echo " value='1'>Prospecto</option>";
							echo "<option"; if($prospecto==0){ echo " selected"; } echo " value='0'>Cliente</option>";
						?>
						</select>
					</div>
					<div class="col-12">
						<label for="seguimiento">Seguimiento</label>
						<textarea id='seguimiento' name='seguimiento' class="form-control"><?php echo $seguimiento; ?></textarea>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<div class='row'>
					<div class="col-4">
						<div class="btn-group">
							<button class="btn btn-outline-secondary btn-sm" type="submit"><i class='far fa-save'></i>Guardar</button>
							<button class='btn btn-outline-secondary btn-sm' id='lista_penarea' data-lugar='a_prospectos/lista' title='regresar'><i class='fas fa-undo-alt'></i>Regresar</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
