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

	$subtotal=$pers['subtotal'];
	$iva=$pers['iva'];
	$monto=$pers['monto'];
	$comision=$pers['comision'];
	$creal=$pers['creal'];
	$retorno=$pers['retorno'];
	$esquema=$pers['esquema'];
	$idrazon=$pers['idrazon'];
	$tcomision=$pers['tcomision'];
	$idempresa=$pers['idempresa'];
	$idpersonal=$pers['idpersona'];
	$bloqueo=count($fact);
	$contrato=$pers['contrato'];
}
else{
	$monto="";
	$subtotal="";
	$iva="";
	$bloqueo=0;
	$idrazon="";
	$idempresa="";
	$fecha=date("d-m-Y");
	$idpersonal=$_SESSION['idpersona'];
	$comision=0;
	$esquema=0;
	$creal=0;
	$retorno=0;
	$tcomision=0;
	$contrato="";
}
$readonly="";
$disabled="";

if($bloqueo>0 ){
	$readonly="readonly";
	$disabled="disabled";
}
$ejecutivo=$db->personal_edit($idpersonal);
$nombre=$ejecutivo['nombre'];

$cli=$db->razon($idrazon);
$empresa=$db->empresa($idempresa);

?>
<div id="accordion">
	<div class='container'>
		<div class="card">
			<form action="" id="form_operacion" data-lugar="a_operaciones/db_operaciones" data-funcion="guardar_operacion" data-destino='a_operaciones/editar'>
				<div class="card-header bg-light">
					#<?php echo $id; ?> Operación <br>
					<hr>
					<div class='btn-group'>

						<button type='button' class="btn btn-outline-secondary btn-sm" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="fas fa-compress-arrows-alt"></i></button>
						<?php
							if($id>0){
								if($idrazon>0){
									echo "<button type='button' class='btn btn-outline-secondary btn-sm' id='winmodal_cargo' data-id='0' data-id2='$id' data-id3='' data-lugar='a_operaciones/form_factura' title='Agregar factura'><i class='fas fa-plus'></i>Factura</button>";
								}
								if($idempresa>0){
									echo "<button type='button' class='btn btn-outline-secondary btn-sm' id='winmodal_cargo' data-id='0' data-id2='$id' data-lugar='a_operaciones/form_retorno'><i class='fas fa-plus'></i>Retorno</button>";
								}
							}
						?>
						<button class='btn btn-outline-secondary btn-sm' id='lista_penarea' data-lugar='a_operaciones/lista' title='regresar'><i class='fas fa-undo-alt'></i>Regresar</button>
					</div>

				</div>
				<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
					<div class="card-body">
						<div class="row">
							<div class="col-2">
								<label for="fecha">Número</label>
								<input type="text" placeholder="Número" id="id" name="id" value="<?php echo $id; ?>" class="form-control" readonly>
							</div>

							<div class="col-2">
								<label for="fecha">Fecha</label>
								<input type="text" placeholder="Fecha" id="fecha" name="fecha" value="<?php echo $fecha; ?>" class="form-control fechaclass" autocomplete=off <?php echo $readonly; ?> >
							</div>

							<div class="col-8">
								<label for="ejecutivo">Ejecutivo</label>
								<input type="text" placeholder="Ejecutivo" id="ejecutivo" name="ejecutivo" value="<?php echo $nombre; ?>" class="form-control" autocomplete=off readonly >
							</div>
						</div>	<div class='row'>
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
												echo "<option value='".$cli['idrazon']."'>".$cli['cliente']." - ".$cli['razon']."</option>";
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
												echo "<option value='".$empresa['idempresa']."'>".$empresa['nombre']." - ".$empresa['razon']."</option>";
											echo "</select>";
										echo "</div>";
									echo "</div>";
								}
								?>
							</div>

						<div class="row">
							<div class="col-3">
								<label for="monto">Monto</label>
								<input type="number" step='any' placeholder="Monto" id="monto" name="monto" onchange='opersuma()' value="<?php echo $monto; ?>" class="form-control" autocomplete=off <?php echo $readonly; ?> required dir='rtl'>
							</div>

							<div class="col-3">
								<label for="subtotal">Subtotal</label>
								<input type="number" step='any' placeholder="Subtotal" id="subtotal" name="subtotal" onchange='opersuma()' value="<?php echo $subtotal; ?>" class="form-control" autocomplete=off <?php echo $readonly; ?> required dir='rtl'>
							</div>

							<div class="col-3">
								<label for="iva">Iva</label>
								<input type="number" step='any' placeholder="Iva" id="iva" name="iva" onchange='opersuma()' value="<?php echo $iva; ?>" class="form-control" autocomplete=off <?php echo $readonly; ?> required dir='rtl'>
							</div>
						</div>

						<div class='row'>
							<div class="col-3">
								<label for="comision">Comisión Cli./Desp.</label>
								<input type="text" placeholder="Comisión pactada" id="comision" name="comision" value="<?php echo $comision; ?>" class="form-control" autocomplete=off <?php echo $readonly; ?> >
							</div>

							<div class="col-2">
								<label for="creal">Comisión J&G</label>
								<input type="text" placeholder="Comisión real" id="creal" name="creal" value="<?php echo $creal; ?>" class="form-control" autocomplete=off <?php echo $readonly; ?> >
							</div>

							<div class="col-3">
								<label for="Esquema">Tipo de Comisión</label>
								<?php
									echo "<select id='esquema' name='esquema' class='form-control' required onchange='retornooper()' $disabled>";
										echo "<option selected disabled>Seleccione una opción</option>";
										echo "<option value='1' "; if ($esquema==1) { echo "selected";} echo ">1. Total</option>";
										echo "<option value='2' "; if ($esquema==2) { echo "selected";} echo ">2. Subtotal</option>";
										echo "<option value='3' "; if ($esquema==3) { echo "selected";} echo ">3. Total + Iva</option>";
										echo "<option value='4' "; if ($esquema==4) { echo "selected";} echo ">4. Subtotal + Iva</option>";
										echo "<option value='5' "; if ($esquema==5) { echo "selected";} echo ">5. Al hacer el Retorno</option>";
									echo "</select>";
								?>
							</div>

							<div class="col-2">
								<label for="tcomision">Comisión</label>
								<input type="text" placeholder="Retorno" id="tcomision" name="tcomision" value="<?php echo $tcomision; ?>" class="form-control" autocomplete=off <?php echo $readonly; ?> >
							</div>

							<div class="col-2">
								<label for="retorno">Retorno</label>
								<input type="text" placeholder="Retorno" id="retorno" name="retorno" value="<?php echo $retorno; ?>" class="form-control" autocomplete=off <?php echo $readonly; ?> >
							</div>
						</div>



						<div class="row">
							<div class="col-12">
								<div class="btn-group">
									<?php
									if($bloqueo==0){
										echo "<button class='btn btn-outline-danger btn-sm' type='submit'><i class='far fa-save'></i>Guardar</button>";
									}


									if(strlen($contrato)<2 or !file_exists("../".$db->doc.trim($contrato))){
										echo "<button type='button' class='btn btn-outline-secondary btn-sm' title='Agregar transferencia' data-toggle='modal' data-target='#myModal'
										id='fileup_logo' data-ruta='".$db->doc."' data-tabla='operaciones' data-campo='contrato' data-tipo='1' data-id='$id' data-keyt='idoperacion'
										data-destino='a_operaciones/op_facturas' data-iddest='$id' data-ext='.pdf' data-divdest='facturas'><i class='fas fa-cloud-upload-alt'></i>Contrato</button>";
									}
									else{
										echo "<div class='btn-group' role='group'>";
										echo "<button id='btnGroupDrop1' type='button' class='btn btn-outline-secondary btn-sm dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fas fa-paperclip'></i>XML</button>";
										echo "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
										echo "<a class='dropdown-item' href='".$db->doc.trim($contrato)."' target='_blank'><i class='fas fa-paperclip'></i>Ver</a>";
										echo "<a class='dropdown-item' title='Eliminar archivo'
										id='delfile_logo'
										data-ruta='".$db->doc.trim($contrato)."'
										data-keyt='idoperacion'
										data-key='id'
										data-tabla='operaciones'
										data-campo='contrato'
										data-tipo='1'
										data-iddest='$id'
										data-divdest='facturas'
										data-borrafile='1'
										data-dest='a_operaciones/op_facturas.php?id='
										><i class='far fa-trash-alt'></i>Eliminar</a>";
										echo "</div>";
										echo "</div>";
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
				<div class='btn-group pull-right'>
					<button type='button' class="btn btn-outline-secondary btn-sm " data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne"><i class="fas fa-compress-arrows-alt"></i></button>
				</div>
				Facturas
			</div>
			<div id="collapseTwo" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
				<div class="card-body">
					<div class="row" id='facturas'>
						<div class="content table-responsive table-full-width">
							<table class="table table-sm datatable">
								<thead>
									<tr>
										<th>#</th>
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
										echo "<button type='button' class='btn btn-outline-secondary btn-sm' id='imprimir_formato' title='Imprimir' data-lugar='a_operaciones/imprimir' data-tipo='1'><i class='far fa-file-pdf'></i></button>";
										echo "<button class='btn btn-outline-danger btn-sm' id='eliminar_factura' data-lugar='a_operaciones/db_operaciones' data-destino='a_operaciones/editar' data-id='".$key['idfactura']."' data-funcion='borrar_factura' data-iddest='$id'>
										<i class='far fa-trash-alt' style='color:red'></i></button>";

										echo "</div>";
										echo "</td>";

										echo "<td>";
										echo $key["descripcion"];
										echo "<span style='font-size:10px'>";
										echo "<br><b>Uso:</b> ".$key["uso"];
										echo "<br><b>Forma de pago:</b> ".$key["forma"];
										echo "<br><b>Producto:</b> ".$key["producto"];
										echo "<br><b>Fecha:</b> ".fecha($key["fecha"]);
										echo "</span>";
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
			<div id="collapsetres" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
				<div class="card-body">
					<div class="row" id='retornos'>
						<div class="content table-responsive table-full-width">
							<table class="table table-sm datatable">
								<thead>
									<tr>
										<th>-</th>
										<th>Fecha</th>
										<th>Tipo</th>
										<th>Retorno</th>
										<th>Monto</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$retorno=0;
									for($i=0;$i<count($ret);$i++){
										echo "<tr id=".$ret[$i]['idretorno']." class='edit-t'>";

										echo "<td>";
										echo "<div class='btn-group'>";
										echo "<button type='button' class='btn btn-outline-secondary btn-sm' id='winmodal_cargo' data-id='".$ret[$i]['idretorno']."' data-id2='$id' data-lugar='a_operaciones/form_retorno'><i class='fas fa-pencil-alt'></i></button>";
										echo "<button type='button' class='btn btn-outline-secondary btn-sm' id='winmodal_cargo' data-id='".$ret[$i]['idretorno']."' data-id2='$id' data-lugar='a_operaciones/form_comisionista'><i class='fas fa-user-friends'></i></button>";
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
										echo moneda($ret[$i]["retorno"]);
										echo "</td>";


										echo "<td>";
										$retorno+=$ret[$i]["monto"];
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
				<div class='row'>

				<?php

				echo "<div class='col-2'>";
				echo "Monto de la operación:";
				echo moneda($monto);

				echo "</div>";
				echo "<div class='col-2'>";
				echo "Monto de facturas:";
				echo moneda($suma);
				echo "</div>";

				echo "<div class='col-2'>";
				echo "Monto de retorno:";
				echo moneda($retorno);
				echo "</div>";




				?>
				</div>
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
