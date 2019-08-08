<?php
	require_once("db_despachos.php");
	$db = new Despachos();


	$id=$_REQUEST['id'];
	if($id>0){
		$pers = $db->despacho_edit($id);
		$nombre=$pers['nombre'];
		$socio=$pers['socio'];
		$telefono=$pers['telefono'];
		$email=$pers['email'];
		$comision=$pers['comision'];
	}
	else{
		$nombre="";
		$socio="";
		$telefono="";
		$email="";
		$comision="";
	}
?>
<div class="container">
	<form action="" id="form_personal" data-lugar="a_despachos/db_despachos" data-funcion="guardar_despacho" data-destino="a_despachos/editar">
		<input type="hidden" value="<?php echo $id; ?>" name="id" id="id">
		<div class="card">
			<div class="card-header">Despacho</div>
			<div class="card-body">
				<div class="row">
					<div class="col-3">
						<label for="nombre">Nombre</label>
						<input type="text" placeholder="Nombre" id="nombre" name="nombre" value="<?php echo $nombre; ?>" class="form-control">
					</div>
					<div class="col-4">
						<label for="socio">Socio</label>
						<input type="text" placeholder="Socio" id="socio" name="socio" value="<?php echo $socio; ?>" class="form-control" required>
					</div>
					<div class="col-4">
						<label for="telefono">Teléfono</label>
						<input type="text" placeholder="Teléfono" id="telefono" name="telefono" value="<?php echo $telefono; ?>" class="form-control" required>
					</div>

					<div class="col-4">
						<label for="email">Email</label>
						<input type="text" placeholder="Email" id="email" name="email" value="<?php echo $email; ?>" class="form-control" required>
						</div>

					<div class="col-2">
						<label for="comision">Comisión %</label>
						<input type="text" placeholder="%" id="comision" name="comision" value="<?php echo $comision; ?>" class="form-control" required>
					</div>

				</div>

			</div>

			<div class="card-footer">
				<div class="row">
					<div class="col-12">
						<div class="btn-group">
							<button class="btn btn-outline-secondary btn-sm" type="submit"><i class='far fa-save'></i>Guardar</button>

							<?php
							if($id>0){
								echo "<button type='button' class='btn btn-outline-secondary btn-sm' id='winmodal_cargo' data-id='0' data-id2='$id' data-lugar='a_despachos/form_oper' title='operador'><i class='fas fa-pencil-alt'></i>+ operador</button>";
								echo "<button type='button' class='btn btn-outline-secondary btn-sm' id='winmodal_empresa' data-id='0' data-id2='$id' data-lugar='a_despachos/form_empresa' title='operador'><i class='fas fa-pencil-alt'></i>+ empresa</button>";
							}

							?>

							<button class='btn btn-outline-secondary btn-sm' id='lista_penarea' data-lugar='a_despachos/lista' title='regresar'><i class='fas fa-undo-alt'></i>Regresar</button>
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
						<a class='nav-link'  id='home-tab' data-toggle='tab' href='#home' role='tab' aria-controls='home' aria-selected='true'>Empresas</a>
					</li>
				</ul>
			</div>

			<div class='card-body'>
				<div class='tab-content' id='myTabContent'>
					<div class='tab-pane fade show active' id='ssh' role='tabpanel' aria-labelledby='ssh-tab'>
						<div class="row" id='razon'>
							<div class='col-12'>
								<?php include "lista_operador.php"; ?>
							</div>
						</div>
					</div>
					<div class='tab-pane fade show' id='home' role='tabpanel' aria-labelledby='home-tab'>
						<div class="row" id='comisionista'>
							<div class='col-12'>
								<?php include "lista_empresas.php"; ?>
							</div>
						</div>
					</div>
				</div>
			</div>


		</div>
	</form>
</div>
