<?php
require_once("db_personal.php");
$id=$_REQUEST['id'];
if($id>0){
	$pers = $db->personal_edit($id);
	$estudio=$pers['estudio'];
	$nombre=$pers['nombre'];
	$rfc=$pers['rfc'];
	$nick=$pers['nick'];
	$correo=$pers['correo'];
	$telefono=$pers['telefono'];
	$puesto=$pers['puesto'];
	$cuenta=$pers['cuenta'];
	$comision=$pers['comision'];
	$tipo=$pers['tipo'];
	$cumple=fecha($pers['cumple']);
}
else{
	$estudio="";
	$nombre="";
	$rfc="";
	$nick="";
	$correo="";
	$telefono="";
	$puesto="";
	$cuenta="";
	$comision="";
	$tipo="";
	$cumple=date("d-m-Y");
}
?>
<div class="container">
	<form action="" id="form_personal" data-lugar="a_personal/db_personal" data-funcion="guardar_personal" data-destino='a_personal/editar'>
		<input type="hidden" value="<?php echo $id; ?>" name="id" id="id">
		<div class="card">
			<div class="card-header">Personal #<?php echo $id; ?></div>
			<div class="card-body">
				<div class="row">
					<div class="col-2">
						<label for="estudio">Estudio</label>
						<input type="text" placeholder="Estudio" id="estudio" name="estudio" value="<?php echo $estudio; ?>" class="form-control">
					</div>
					<div class="col-4">
						<label for="nombre">Nombre</label>
						<input type="text" placeholder="Nombre" id="nombre" name="nombre" value="<?php echo $nombre; ?>" class="form-control" required>
					</div>
					<div class="col-2">
						<label for="rfc">RFC</label>
						<input type="text" placeholder="RFC" id="rfc" name="rfc" value="<?php echo $rfc; ?>" class="form-control" required>
					</div>
					<div class="col-2">
						<label for="cumple">Cumpleaños</label>
						<input type="text" placeholder="Cumple" id="cumple" name="cumple" value="<?php echo $cumple; ?>" class="form-control fechaclass" autocomplete=off >
					</div>

					<div class="col-4">
						<label for="nick">Nick</label>
						<input type="text" placeholder="Nick para el chat" id="nick" name="nick" value="<?php echo $nick; ?>" class="form-control" required>
					</div>

					<div class="col-4">
						<label for="correo">Correo</label>
						<input type="mail" placeholder="Correo electronico" id="correo" name="correo" value="<?php echo $correo; ?>" class="form-control" required>
					</div>
					<div class="col-4">
						<label for="telefono">Teléfono</label>
						<input type="text" placeholder="Teléfono" id="telefono" name="telefono" value="<?php echo $telefono; ?>" class="form-control">
					</div>
					<div class="col-4">
						<label for="puesto">Puesto</label>
						<input type="text" placeholder="Puesto" id="puesto" name="puesto" value="<?php echo $puesto; ?>" class="form-control">
					</div>
					<div class="col-4">
						<label for="cuenta">Cuenta</label>
						<input type="text" placeholder="Cuenta" id="cuenta" name="cuenta" value="<?php echo $cuenta; ?>" class="form-control">
					</div>
					<div class="col-4">
						<label for="comision">Comisión</label>
						<input type="text" placeholder="Comisión" id="comision" name="comision" value="<?php echo $comision; ?>" class="form-control">
					</div>
					<div class="col-4">
						<label for="tipo">Tipo de usuario</label>
						<select class='form-control' id='tipo' name='tipo'>
							<?php
							echo "<option"; if($tipo=="comisionista"){ echo " selected"; } echo " value='comisionista'>Comisionista</option>";
							echo "<option"; if($tipo=="ejecutivo"){ echo " selected"; } echo " value='ejecutivo'>Ejecutivo</option>";
							echo "<option"; if($tipo=="administrativo"){ echo " selected"; } echo " value='administrativo'>Administrativo</option>";
							?>
						</select>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<div class="row">
					<div class='col-12'>
						<div class='btn-group'>
							<button class="btn btn-outline-secondary btn-sm" type="submit"><i class='far fa-save'></i>Guardar</button>
							<button class='btn btn-outline-secondary btn-sm' id='lista_penarea' data-lugar='a_personal/lista' title='regresar'><i class='fas fa-undo-alt'></i>Regresar</button>
							<?php
							if($id>0){
								echo "<button type='button' class='btn btn-outline-secondary btn-sm' id='winmodal_pass' data-id='$id' data-lugar='a_personal/form_pass' title='Cambiar contraseña' ><i class='fas fa-key'></i>Contraseña</button>";
							}
							if ($_SESSION['tipousuario']=='administrativo'){
								echo "<button class='btn btn-danger btn-sm' type='button' id='cambiar' title='Entrar a la cuenta' ><i class='fas fa-user-shield'></i>Perfil</button>";
							}
							?>
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
