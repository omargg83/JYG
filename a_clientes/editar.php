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
	$cumple=fecha($pers['cumple']);
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
	$cumple=date("d-m-Y");
	$prospecto=0;
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
					<label for="rfc">Rfc</label>
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
				<div class="col-4">
					<label for="ciudad">Ciudad</label>
					<input type="text" placeholder="Ciudad" id="ciudad" name="ciudad" value="<?php echo $ciudad; ?>" class="form-control">
				</div>
				<div class="col-6">
					<label for="municipio">Municipio</label>
					<input type="text" placeholder="Municipio" id="municipio" name="municipio" value="<?php echo $municipio; ?>" class="form-control">
				</div>
				<div class="col-3">
					<label for="estado">Estado</label>
					<input type="text" placeholder="Estado" id="estado" name="estado" value="<?php echo $estado; ?>" class="form-control">
				</div>
				<div class="col-4">
					<label for="correo">Correo</label>
					<input type="mail" placeholder="Correo electronico" id="correo" name="correo" value="<?php echo $correo; ?>" class="form-control" required>
				</div>
				<div class="col-2">
					<label for="telefono">Telefono</label>
					<input type="text" placeholder="Telefono/Telefonos" id="telefono" name="telefono" value="<?php echo $telefono; ?>" class="form-control" required>
				</div>

				<div class="col-2">
					<label for="cumple">Cumpleaños</label>
					<input type="text" placeholder="Cumple" id="cumple" name="cumple" value="<?php echo $cumple; ?>" class="form-control fechaclass" autocomplete=off >
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

							echo "<button type='button' class='btn btn-outline-secondary btn-sm' id='winmodal_cargo' data-id='0' data-id2='$id' data-lugar='a_clientes/form_razon' title='Agregar Razón'><i class='fas fa-plus'></i>Nueva Razón</button>";
							echo "<button type='button' class='btn btn-outline-secondary btn-sm' id='winmodal_cargo' data-id='0' data-id2='$id' data-lugar='a_clientes/form_comi' title='Agregar Comisionista'><i class='fas fa-plus'></i>Agregar Comisionista</button>";

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

<script>
$(function() {
	fechas();
	$(document).ready( function () {
		$('table.datatable').DataTable({
			"pageLength": 100,
			"language": {
				"sSearch": "Buscar aqui",
				"lengthMenu": "Mostrar _MENU_ registros",
				"zeroRecords": "No se encontró",
				"info": " Página _PAGE_ de _PAGES_",
				"infoEmpty": "No records available",
				"infoFiltered": "(filtered from _MAX_ total records)",
				"paginate": {
					"first":      "Primero",
					"last":       "Ultimo",
					"next":       "Siguiente",
					"previous":   "Anterior"
				},
			}
		});
	});
});
</script>
