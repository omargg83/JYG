<?php
require_once("db_.php");
$id=$_REQUEST['id'];
$ejecutivo= $db->personal();
if($id>0){
	$pers = $db->cliente_edit($id);
	$cliente=$pers['cliente'];
	$contacto=$pers['contacto'];
	$rfc=$pers['rfc'];
	$domicilio=$pers['domicilio'];

	$colonia=$pers['colonia'];
	$ciudad=$pers['ciudad'];
	$municipio=$pers['municipio'];
	$estado=$pers['estado'];
	$cp=$pers['cp'];


	$correo=$pers['correo'];
	$telefono=$pers['telefono'];
	$idpersona=$pers['idpersona'];
}
else{
	$cliente="";
	$contacto="";
	$rfc="";
	$domicilio="";
	$correo="";
	$telefono="";
	$idpersona=$_SESSION['idpersona'];

	$colonia="";
	$ciudad="";
	$municipio="";
	$estado="";
	$cp="";

}
echo "<div class='container'>";
?>


<form action="" id="form_personal" data-lugar="a_clientes/db_" data-funcion="guardar_cliente" data-destino='a_clientes/editar'>
	<input type="hidden" value="<?php echo $id; ?>" name="id" id="id">
	<div class="card">

		<div class="card-header">Cliente #<?php echo $id; ?></div>
		<div class="card-body">
			<div class="row">
				<div class="col-3">
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
				<div class="col-6">
					<label for="domicilio">Domicilio (Calle y No.)</label>
					<input type="text" placeholder="Domicilio (Calle y No.)" id="domicilio" name="domicilio" value="<?php echo $domicilio; ?>" class="form-control">
				</div>
				<div class="col-6">
					<label for="colonia">Colonia</label>
					<input type="text" placeholder="Colonia" id="colonia" name="colonia" value="<?php echo $colonia; ?>" class="form-control">
				</div>
				<div class="col-2">
					<label for="cp">CP</label>
					<input type="text" placeholder="CP" id="cp" name="cp" value="<?php echo $cp; ?>" class="form-control">
				</div>
				<div class="col-5">
					<label for="ciudad">Ciudad</label>
					<input type="text" placeholder="Ciudad" id="ciudad" name="ciudad" value="<?php echo $ciudad; ?>" class="form-control">
				</div>
				<div class="col-5">
					<label for="municipio">Municipio</label>
					<input type="text" placeholder="Municipio" id="municipio" name="municipio" value="<?php echo $municipio; ?>" class="form-control">
				</div>
				<div class="col-4">
					<label for="estado">Estado</label>
					<input type="text" placeholder="Estado" id="estado" name="estado" value="<?php echo $estado; ?>" class="form-control">
				</div>
				<div class="col-5">
					<label for="correo">Correo</label>
					<input type="mail" placeholder="Correo electronico" id="correo" name="correo" value="<?php echo $correo; ?>" class="form-control" required>
				</div>
				<div class="col-3">
					<label for="telefono">Telefono</label>
					<input type="text" placeholder="Telefono/Telefonos" id="telefono" name="telefono" value="<?php echo $telefono; ?>" class="form-control" required>
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
			</div>
		</div>
		<div class="card-footer">
			<div class="row">
				<div class="col-12">
					<div class='btn-group'>
						<button class="btn btn-outline-secondary btn-sm" type="submit"><i class='far fa-save'></i>Guardar</button>
						<?php
						if($id>0){

							echo "<button type='button' class='btn btn-outline-secondary btn-sm' id='winmodal_cargo' data-id='0' data-id2='$id' data-lugar='a_clientes/form_razon' title='Razon'><i class='fas fa-pencil-alt'></i>Nueva razon</button>";
							echo "<button type='button' class='btn btn-outline-secondary btn-sm' id='winmodal_cargo' data-id='0' data-id2='$id' data-lugar='a_clientes/form_comi' title='Comi'><i class='fas fa-pencil-alt'></i>Agregar Comisionista</button>";

						}
						?>
						<button class='btn btn-outline-secondary btn-sm' id='lista_penarea' data-lugar='a_clientes/lista' title='regresar'><i class='fas fa-undo-alt'></i>Regresar</button>
					</div>
				</div>
			</div>
		</div>

		<div class="card-header">
			<ul class='nav nav-tabs card-header-tabs nav-fill' id='myTab' role='tablist'>
				<li class='nav-item'>
					<a class='nav-link active' id='ssh-tab' data-toggle='tab' href='#ssh' role='ssh' aria-controls='home' aria-selected='true'>Razon</a>
				</li>
				<li class='nav-item'>
					<a class='nav-link'  id='home-tab' data-toggle='tab' href='#home' role='tab' aria-controls='home' aria-selected='true'>Comisionista</a>
				</li>
			</ul>
		</div>

		<div class='card-body'>
			<div class='tab-content' id='myTabContent'>
				<div class='tab-pane fade show active' id='ssh' role='tabpanel' aria-labelledby='ssh-tab'>
					<div class="row" id='razon'>
						<div class='col-12'>
							<?php include "lista_razon.php"; ?>
						</div>
					</div>
				</div>
				<div class='tab-pane fade show' id='home' role='tabpanel' aria-labelledby='home-tab'>
					<div class="row" id='comisionista'>
						<div class='col-12'>
							<?php include "lista_comi.php"; ?>
						</div>
					</div>
				</div>
			</div>
		</div>



	</div>
</form>
</div>
