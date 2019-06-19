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
	}
	else{
		$nombre="";
		$socio="";
		$telefono="";
		$email="";
	}
?>
<div class="container">
	<form action="" id="form_personal" data-lugar="a_despachos/db_despachos" data-funcion="guardar_despacho">
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
				</div>								<div class="row">					<div class="col-4">						<label for="email">Email</label>						<input type="text" placeholder="Email" id="email" name="email" value="<?php echo $email; ?>" class="form-control" required>					</div>					</div>
			</div>
			<div class="card-footer">
				<div class="row">
					<div class="col-12">
						<div class="btn-group">
							<button class="btn btn-outline-secondary btn-sm" type="submit"><i class='far fa-save'></i>Guardar</button>

							<?php
							if($id>0){
								echo "<button type='button' class='btn btn-outline-secondary btn-sm' id='winmodal_cargo' data-id='0' data-id2='$id' data-lugar='a_despachos/form_oper' title='operador'><i class='fas fa-pencil-alt'></i>Agregar operador</button>";
							}

							?>

							<button class='btn btn-outline-secondary btn-sm' id='lista_penarea' data-lugar='a_despachos/lista' title='regresar'><i class='fas fa-undo-alt'></i>Regresar</button>
						</div>
					</div>
				</div>
			</div>
			
			<?php if($id>0){ ?>
				<div class="card-body" id='social'>
					<center><img src='img/carga.gif' width='300px'></center>

				</div>

				<?php
			}
			?>
		</div>
	</form>
</div>

<script>
$(function() {
	var id= $("#id").val();
	$("#social").load("a_despachos/lista_operador.php?id="+id);
});

</script>
