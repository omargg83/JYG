<?php
require_once("db_.php");
$id=$_REQUEST['id'];

if($id>0){
	$pers = $db->meta_edit($id);
	$mes=$pers['mes'];
	$anio=$pers['anio'];
	$meta=$pers['meta'];
}
else{
	$mes="";
	$anio="";
	$meta="";
}
echo "<div class='container'>";
?>


<form action="" id="form_personal" data-lugar="a_metas/db_" data-funcion="guardar_meta" data-destino='a_metas/editar'>
	<input type="hidden" value="<?php echo $id; ?>" name="id" id="id">
	<div class="card">

		<div class="card-header">Metas #<?php echo $id; ?></div>
		<div class="card-body">
			<div class="row">
				<div class="col-3">
					<label for="rfc">Mes</label>
					<select id='mes' name='mes' class='form-control'>
						<?php
							echo "<option value='1' "; if($mes==1){ echo " selected"; } echo " >Enero</option>";
							echo "<option value='2' "; if($mes==2){ echo " selected"; } echo " >Febrero</option>";
							echo "<option value='3' "; if($mes==3){ echo " selected"; } echo " >Marzo</option>";
							echo "<option value='4' "; if($mes==4){ echo " selected"; } echo " >Abril</option>";
							echo "<option value='5' "; if($mes==5){ echo " selected"; } echo " >Mayo</option>";
							echo "<option value='6' "; if($mes==6){ echo " selected"; } echo " >Junio</option>";
							echo "<option value='7' "; if($mes==7){ echo " selected"; } echo " >Julio</option>";
							echo "<option value='8' "; if($mes==8){ echo " selected"; } echo " >Agosto</option>";
							echo "<option value='9' "; if($mes==9){ echo " selected"; } echo " >Septiembre</option>";
							echo "<option value='10' "; if($mes==10){ echo " selected"; } echo " >Octubre</option>";
							echo "<option value='11' "; if($mes==11){ echo " selected"; } echo " >Noviembre</option>";
							echo "<option value='12' "; if($mes==12){ echo " selected"; } echo " >Diciembre</option>";
						?>
					</select>
				</div>
				<div class="col-4">
					<label for="cliente">Año</label>
					<input type="number" placeholder="Año" id="anio" name="anio" value="<?php echo $anio; ?>" class="form-control">
				</div>
				<div class="col-4">
					<label for="cliente">Meta</label>
					<input type="number" placeholder="Meta" id="meta" name="meta" value="<?php echo $meta; ?>" class="form-control">
				</div>
			</div>
		</div>
		<div class="card-footer">
			<div class="row">
				<div class="col-12">
					<div class='btn-group'>
						<button class="btn btn-outline-secondary btn-sm" type="submit"><i class='far fa-save'></i>Guardar</button>
						<button class='btn btn-outline-secondary btn-sm' id='lista_penarea' data-lugar='a_metas/lista' title='regresar'><i class='fas fa-undo-alt'></i>Regresar</button>
					</div>
				</div>
			</div>
		</div>

	</div>
</form>
</div>
