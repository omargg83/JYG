<?php
require_once("db_operaciones.php");
$id=$_REQUEST['id'];
$pers=array();
$fact=array();
$ret=array();
if($id>0){
	$pers = $db->operacion_edit($id);
	$fact = $db->facturas($id);
	$ret = $db->retorno($id);

	$idempresa=$pers['idempresa'];
	$fecha=fecha($pers['fecha']);
	$monto=$pers['monto'];
	$idrazon=$pers['idrazon'];
	$idempresa=$pers['idempresa'];
	$disabled="";
	$idpersonal=$pers['idpersona'];
	$bloqueo=count($fact);
}
else{
	$disabled=0;
	$disabled='disabled';
	$monto="";
	$bloqueo=0;
	$idrazon="";
	$idempresa="";
	$fecha=date("d-m-Y");
	$idpersonal=$_SESSION['idpersona'];
}
$readonly="";

if(strlen($idrazon)==0 or strlen($idempresa)==0){
	$disabled='disabled';
}

if($bloqueo>0 ){
	$readonly="readonly";
}
$ejecutivo=$db->personal_edit($idpersonal);

$cli=$db->razon($idrazon);
$empresa=$db->empresa($idempresa);
$nombre=$ejecutivo['nombre'];
?>
<div id="accordion">
	<div class='container'>
		<div class="card">
			<form action="" id="form_operacion" data-lugar="a_operaciones/db_operaciones" data-funcion="guardar_operacion" data-destino='a_operaciones/editar'>
				<div class="card-header bg-light">
					<div class='btn-group'>
						<button type='button' class="btn btn-outline-secondary btn-sm" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="fas fa-compress-arrows-alt"></i></button>
						<?php
							if($id>0){
								if($idrazon>0){
									echo "<button type='button' class='btn btn-outline-secondary btn-sm' id='winmodal_cargo' data-id='0' data-id2='$id' data-id3='' data-lugar='a_operaciones/form_factura' title='Agregar factura'><i class='fas fa-plus'></i>Factura</button>";
								}
								if($idempresa>0){
									echo "<button type='button' class='btn btn-outline-secondary btn-sm' id='winmodal_cargo' data-id='0' data-id2='$id' data-id3='$idempresa' data-lugar='a_operaciones/form_retorno'><i class='fas fa-plus'></i>Retorno</button>";
								}
							}
						?>
						<button class='btn btn-outline-secondary btn-sm' id='lista_penarea' data-lugar='a_operaciones/lista' title='regresar'><i class='fas fa-undo-alt'></i>Regresar</button>
					</div>
					<hr>
					#<?php echo $id; ?> Operación

				</div>
				<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
					<div class="card-body">
						<div class="row">
							<div class="col-2">
								<label for="fecha">Número</label>
								<input type="text" placeholder="Número" id="id" name="id" value="<?php echo $id; ?>" class="form-control" readonly>
							</div>

							<div class="col-3">
								<label for="fecha">Fecha</label>
								<input type="text" placeholder="Fecha" id="fecha" name="fecha" value="<?php echo $fecha; ?>" class="form-control fechaclass" autocomplete=off <?php echo $readonly; ?> >
							</div>

							<div class="col-3">
								<label for="monto">Monto</label>
								<input type="number" step='any' placeholder="Monto" id="monto" name="monto" value="<?php echo $monto; ?>" class="form-control" autocomplete=off <?php echo $readonly; ?> required dir='rtl'>
							</div>

							<div class="col-4">
								<label for="ejecutivo">Ejecutivo</label>
								<input type="text" placeholder="Ejecutivo" id="ejecutivo" name="ejecutivo" value="<?php echo $nombre; ?>" class="form-control" autocomplete=off readonly >
							</div>
						</div>
						<div class='row'>
							<?php
							if($id>0){
								echo "<div class='col-6'>";
									echo "<label for='cliente'>Cliente</label>";
									echo "<div class='input-group mb-3'>";
										echo "<div class='input-group-prepend'>";
										if($bloqueo==0){
											echo "<button type='button' class='btn btn-outline-danger btn-sm' id='winmodal_cargo' data-id='0' data-id2='$id' data-lugar='a_operaciones/form_cliente'><i class='fas fa-user-check'></i></button>";
										}
										echo "</div>";
										echo "<select id='idrazon' name='idrazon' class='form-control' required $readonly >";
										foreach ($cli as $key ) {
											echo "<option value='".$key['idrazon']."'"; if($idrazon==$key['idrazon']) { echo "selected"; } echo ">".$key['cliente']." - ".$key['razon']."</option>";
										}
										echo "</select>";
									echo "</div>";
								echo "</div>";

								echo "<div class='col-6'>";
									echo "<label for='cliente'>Empresa</label>";
									echo "<div class='input-group mb-3'>";
										echo "<div class='input-group-prepend'>";
										if($bloqueo==0){
											echo "<button type='button' class='btn btn-outline-danger btn-sm' id='winmodal_cargo' data-id='0' data-id2='$id' data-lugar='a_operaciones/form_empresa'><i class='far fa-building'></i></button>";
										}
										echo "</div>";
										echo "<select id='idempresa' name='idempresa' class='form-control' required $readonly >";
										foreach ($empresa as $key ) {
											echo "<option value='".$key['idempresa']."'"; if($idempresa==$key['idempresa']) { echo "selected"; } echo ">".$key['nombre']." - ".$key['razon']."</option>";
										}
										echo "</select>";
									echo "</div>";
								echo "</div>";
							}
							?>
						</div>
						<div class="row">
							<div class="col-12">
								<div class="btn-group">
									<?php
									if($bloqueo==0){
										echo "<button class='btn btn-outline-danger btn-sm' type='submit'><i class='far fa-save'></i>Guardar</button>";
									}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>

			<!--............................................inicio facturas...................................... -->
			<div class="card-header">
				<div class='btn-group'>
					<button type='button' class="btn btn-outline-secondary btn-sm" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne"><i class="fas fa-compress-arrows-alt"></i></button>
				</div>
				Facturas
			</div>
			<div id="collapseTwo" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
				<div class="card-body">
					<div class="row" id='facturas'>
						<div class="content table-responsive table-full-width">
							<table class="table table-sm datatable">
								<thead>
									<tr>
										<th>#</th>
										<th>Fecha</th>
										<th>Descripción</th>
										<th>Documentos</th>
										<th>Monto</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$suma=0;
									foreach($fact as $key){
										echo "<tr id=".$key['idfactura']." class='edit-t'>";
										echo "<td>";
										echo "<div class='btn-group'>";
										echo "<button type='button' class='btn btn-outline-secondary btn-sm' id='winmodal_cargo' data-id='".$key['idfactura']."' data-id2='$id' data-lugar='a_operaciones/form_factura'><i class='fas fa-pencil-alt'></i></button>";
										echo "<button class='btn btn-outline-secondary btn-sm' id='eliminar_factura' data-lugar='a_operaciones/db_operaciones' data-destino='a_operaciones/editar' data-id='".$key['idfactura']."' data-funcion='borrar_factura' data-iddest='$id'><i class='far fa-trash-alt'></i></i></button>";
										echo "<button type='button' class='btn btn-outline-secondary btn-sm' id='imprimir_formato' title='Imprimir' data-lugar='a_operaciones/imprimir' data-tipo='1'><i class='far fa-file-pdf'></i></button>";
										echo "</div>";
										echo "</td>";
										echo "<td>";
										echo fecha($key["fecha"]);
										echo "</td>";
										echo "<td>";
										echo $key["descripcion"];
										echo "</td>";

										echo "<td>";
										echo "<div class='btn-group'>";
										if(strlen($key['trans'])<2 or !file_exists("../".$db->doc.trim($key['trans']))){
											echo "<button type='button' class='btn btn-outline-secondary btn-sm' title='Agregar transferencia' data-toggle='modal' data-target='#myModal'
											id='fileup_logo' data-ruta='".$db->doc."' data-tabla='facturas' data-campo='trans' data-tipo='1' data-id='".$key['idfactura']."' data-keyt='idfactura'
											data-destino='a_operaciones/op_facturas' data-iddest='$id' data-ext='.pdf' data-divdest='facturas'><i class='fas fa-cloud-upload-alt'></i>Transf.</button>";
										}
										else{
											echo "<div class='btn-group' role='group'>";
											echo "<button id='btnGroupDrop1' type='button' class='btn btn-outline-secondary btn-sm dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fas fa-paperclip'></i>Transf.</button>";
											echo "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
											echo "<a class='dropdown-item' href='".$db->doc.trim($key['trans'])."' target='_blank'><i class='fas fa-paperclip'></i>Ver</a>";
											echo "<a class='dropdown-item' title='Eliminar archivo'
											id='delfile_logo'
											data-ruta='".$db->doc.trim($key['trans'])."'
											data-keyt='idfactura'
											data-key='".$key['idfactura']."'
											data-tabla='facturas'
											data-campo='trans'
											data-tipo='1'
											data-iddest='$id'
											data-divdest='facturas'
											data-borrafile='1'
											data-dest='a_operaciones/op_facturas.php?id='
											><i class='far fa-trash-alt'></i>Eliminar</a>";
											echo "</div>";
											echo "</div>";
										}
										if(strlen($key['timbre'])<2 or !file_exists("../".$db->doc.trim($key['timbre']))){
											echo "<button type='button' class='btn btn-outline-secondary btn-sm' title='Agregar transferencia' data-toggle='modal' data-target='#myModal'
											id='fileup_logo' data-ruta='".$db->doc."' data-tabla='facturas' data-campo='timbre' data-tipo='1' data-id='".$key['idfactura']."' data-keyt='idfactura'
											data-destino='a_operaciones/op_facturas' data-iddest='$id' data-ext='.pdf' data-divdest='facturas'><i class='fas fa-cloud-upload-alt'></i>Timbre</button>";
										}
										else{
											echo "<div class='btn-group' role='group'>";
											echo "<button id='btnGroupDrop1' type='button' class='btn btn-outline-secondary btn-sm dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fas fa-paperclip'></i>Timbre</button>";
											echo "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
											echo "<a class='dropdown-item' href='".$db->doc.trim($key['timbre'])."' target='_blank'><i class='fas fa-paperclip'></i>Ver</a>";
											echo "<a class='dropdown-item' title='Eliminar archivo'
											id='delfile_logo'
											data-ruta='".$db->doc.trim($key['timbre'])."'
											data-keyt='idfactura'
											data-key='".$key['idfactura']."'
											data-tabla='facturas'
											data-campo='timbre'
											data-tipo='1'
											data-iddest='$id'
											data-divdest='facturas'
											data-borrafile='1'
											data-dest='a_operaciones/op_facturas.php?id='
											><i class='far fa-trash-alt'></i>Eliminar</a>";
											echo "</div>";
											echo "</div>";
										}
										if(strlen($key['xml'])<2 or !file_exists("../".$db->doc.trim($key['xml']))){
											echo "<button type='button' class='btn btn-outline-secondary btn-sm' title='Agregar transferencia' data-toggle='modal' data-target='#myModal'
											id='fileup_logo' data-ruta='".$db->doc."' data-tabla='facturas' data-campo='xml' data-tipo='1' data-id='".$key['idfactura']."' data-keyt='idfactura'
											data-destino='a_operaciones/op_facturas' data-iddest='$id' data-ext='.pdf' data-divdest='facturas'><i class='fas fa-cloud-upload-alt'></i>XML</button>";
										}
										else{
											echo "<div class='btn-group' role='group'>";
											echo "<button id='btnGroupDrop1' type='button' class='btn btn-outline-secondary btn-sm dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fas fa-paperclip'></i>XML</button>";
											echo "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
											echo "<a class='dropdown-item' href='".$db->doc.trim($key['xml'])."' target='_blank'><i class='fas fa-paperclip'></i>Ver</a>";
											echo "<a class='dropdown-item' title='Eliminar archivo'
											id='delfile_logo'
											data-ruta='".$db->doc.trim($key['xml'])."'
											data-keyt='idfactura'
											data-key='".$key['idfactura']."'
											data-tabla='facturas'
											data-campo='xml'
											data-tipo='1'
											data-iddest='$id'
											data-divdest='facturas'
											data-borrafile='1'
											data-dest='a_operaciones/op_facturas.php?id='
											><i class='far fa-trash-alt'></i>Eliminar</a>";
											echo "</div>";
											echo "</div>";
										}
										echo "</div>";
										echo "</td>";

										echo "<td align='right'>";
										$suma+=$key["monto"];
										echo moneda($key["monto"]);
										echo "</td>";

										echo "</tr>";
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!--............................................fin facturas...................................... -->
			<!--...........................................INICIA RETORNO ...................................... -->
			<div class="card-header">
				<button type='button' class="btn btn-outline-secondary btn-sm" data-toggle="collapse" data-target="#collapsetres" aria-expanded="true" aria-controls="collapseOne"><i class="fas fa-compress-arrows-alt"></i></button>
				Retornos
			</div>
			<div id="collapsetres" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
				<div class="card-body">
					<div class="row" id='retornos'>
						<div class="content table-responsive table-full-width">
							<table class="table table-sm datatable">
								<thead>
									<tr>
										<th>-</th>
										<th>Fecha</th>
										<th>Tipo</th>
										<th>Monto</th>
									</tr>
								</thead>
								<tbody>
									<?php

									for($i=0;$i<count($ret);$i++){
										echo "<tr id=".$ret[$i]['idretorno']." class='edit-t'>";

										echo "<td>";
										echo "<div class='btn-group'>";
										echo "<button type='button' class='btn btn-outline-secondary btn-sm' id='winmodal_cargo' data-id='".$ret[$i]['idretorno']."' data-id2='$id' data-id3='$idempresa' data-lugar='a_operaciones/form_retorno'><i class='fas fa-pencil-alt'></i></button>";
										echo "<button class='btn btn-outline-secondary btn-sm' id='eliminar_retorno' data-lugar='a_operaciones/db_operaciones' data-destino='a_operaciones/editar' data-id='".$ret[$i]['idretorno']."' data-funcion='borrar_retorno' data-iddest='$id'><i class='far fa-trash-alt'></i></button>";
										echo "</div>";
										echo "</td>";

										echo "<td>";
										echo $ret[$i]["fecha"];
										echo "</td>";

										echo "<td>";
										echo $ret[$i]["idproducto"];
										echo "</td>";

										echo "<td>";
										echo moneda($ret[$i]["monto"]);
										echo "</td>";

										echo "</tr>";
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!--...........................................FIN RETORNO ...................................... -->

			<div class="card-header">
				Resumen
			</div>
			<div class="card-body">
				resumen
			</div>
		</div>
	</div>
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
