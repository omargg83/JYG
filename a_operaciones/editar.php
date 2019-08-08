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

	$bloqueo=count($fact)+count($ret);
	$idrazon=$pers['idrazon'];
	$idempresa=$pers['idempresa'];


	$cli=$db->razon($idrazon);
	$empresa=$db->empresa($idempresa);

	$fecha=fecha($pers['fecha']);
	$subtotal=$pers['subtotal'];
	$iva=$pers['iva'];
	$monto=$pers['monto'];
	$comision=$pers['comision'];
	$creal=$pers['creal'];
	$retorno=$pers['retorno'];
	$esquema=$pers['esquema'];
	$esquema2=$pers['esquema2'];
	$tcomision=$pers['tcomision'];
	$idpersonal=$pers['idpersona'];
	$contrato=$pers['contrato'];
	$pikito=$pers['pikito'];
	$tcomision_r=$pers['tcomision_r'];
	$retorno_r=$pers['retorno_r'];
	$comdespa=$pers['comdespa'];
	$comdespa_t=$pers['comdespa_t'];
	$comisionistas=$pers['comisionistas'];
	$req_contrato=$pers['req_contrato'];
	$finalizar=$pers['finalizar'];
	$com_final=$pers['com_final'];
	$compikito=$pers['compikito'];

	$com_t=$pers['comision_f'];
	$ret_t=$pers['retorno_f'];

	if($esquema==5){
		$tcomision=0;
		$retorno=0;
		$tcomision_r=0;
		$retorno_r=0;
		$pikito=0;
		$comdesp=0;
		$comisionistas=0;
		$comision_f=0;
		$retorno_f=0;
		if(count($ret)>0){
			$sql="select sum(tcomision) as scomision, sum(retorno) as sretorno,
			sum(if(creal=0,tcomision,tcomisionjg)) stcomisionjg,
			sum(if(creal=0,retorno,retornojg)) sretornojg
			from retorno where idoperacion=$id";
			$val=$db->general($sql);

			$tcomision=$val[0]['scomision'];
			$retorno=$val[0]['sretorno'];
			$tcomision_r=$val[0]['stcomisionjg'];
			$retorno_r=$val[0]['sretornojg'];
			$pikito=$val[0]['sretorno']-$val[0]['sretornojg'];
			$comdesp=($val[0]['scomision']*$comdespa)/100;
			$comisionistas=($val[0]['stcomisionjg']-$comdesp);

			$sql="select sum(if(creal=0,tcomision,tcomisionjg)) com_total, SUM(if(creal=0,retorno,retornojg)) ret_total from retorno where idoperacion=$id";
			$total=$db->general($sql);
			$comision_f=$total[0]['com_total'];
			$retorno_f=$total[0]['ret_total'];
		}
		$arreglo=array();
		$arreglo+=array('tcomision'=>$tcomision);
		$arreglo+=array('retorno'=>$retorno);
		$arreglo+=array('tcomision_r'=>$tcomision_r);
		$arreglo+=array('retorno_r'=>$retorno_r);
		$arreglo+=array('pikito'=>$pikito);
		$arreglo+=array('comdespa_t'=>$comdesp);
		$arreglo+=array('comisionistas'=>$comisionistas);
		$arreglo+=array('comision_f'=>$comision_f);
		$arreglo+=array('retorno_f'=>$retorno_f);
		$db->update('operaciones',array('idoperacion'=>$id), $arreglo);
	}
	//////////////////////////comisionistas
	$comis=$db->comisionista($cli['idcliente']);
	foreach ($comis as $key) {
		$sql="select * from operaciones_comi where idoperacion='$id' and idcom='".$key['idcom']."'";
		$seek=$db->general($sql);
		$total=($key['comision']*$comisionistas)/100;
		$arreglo =array();
		$arreglo+=array('porcentaje'=>$key['comision']);
		$arreglo+=array('monto'=>$total);
		if(count($seek)==0){
			$arreglo+=array('idcom'=>$key['idcom']);
			$arreglo+=array('idoperacion'=>$id);
			$db->insert('operaciones_comi', $arreglo);
		}
		else{
			$db->update('operaciones_comi',array('idoperacion'=>$id,'idcom'=>$key['idcom']), $arreglo);
		}
	}
	//////////////////////////fin de comisionistas
}
else{
	$monto="0";
	$subtotal="0";
	$iva="0";
	$bloqueo=0;
	$idrazon="";
	$idempresa="";
	$fecha=date("d-m-Y");
	$idpersonal=$_SESSION['idpersona'];
	$comision=0;
	$esquema=0;
	$esquema2=0;
	$creal=0;
	$retorno=0;
	$tcomision=0;
	$contrato="";
	$pikito="";
	$tcomision_r="0";
	$retorno_r="0";
	$comdespa="0";
	$comdespa_t="0";
	$comisionistas="0";
	$cli=array();
	$empresa=array();
	$req_contrato=0;
	$finalizar=0;
}
$readonly="";
$disabled="";

if($bloqueo>0 ){
	$readonly="readonly";
	$disabled="disabled";
}
$ejecutivo=$db->personal_edit($idpersonal);
$nombre=$ejecutivo['nombre'];

?>
<form action="" id="form_operacion" data-lugar="a_operaciones/db_operaciones" data-funcion="guardar_operacion" data-destino='a_operaciones/editar'>
	<div id="accordion">
		<div class='container'>
			<div class="card">

				<div class="card-header bg-light">
					#<?php echo $id; ?> Operación <br>
				</div>

				<div class="card-body">
					<div class="row">
						<div class="col-2">
							<label for="id">ID</label>
							<input type="text" placeholder="ID" id="id" name="id" value="<?php echo $id; ?>" class="form-control" readonly>
						</div>

						<div class="col-2">
							<label for="fecha">Fecha</label>
							<input type="text" placeholder="Fecha" id="fecha" name="fecha" value="<?php echo $fecha; ?>" class="form-control fechaclass" autocomplete=off readonly >
						</div>
						<?php
						echo "<div class='col-4' >";
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

						echo "<div class='col-4'>";
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
						?>
					</div>

					<hr>
					<div class="row">
						<div class="col-3">
							<label for="monto">Monto</label>
							<input type="number" step='any' placeholder="Monto" id="monto" name="monto" onchange='retornooper()' value="<?php echo $monto; ?>" class="form-control" autocomplete=off <?php echo $readonly; ?> required dir='rtl'>
						</div>

						<div class="col-3">
							<label for="subtotal">Subtotal</label>
							<input type="number" step='any' placeholder="Subtotal" id="subtotal" name="subtotal" onchange='retornooper()' value="<?php echo $subtotal; ?>" class="form-control" autocomplete=off readonly required dir='rtl'>
						</div>

						<div class="col-3">
							<label for="iva">Iva</label>
							<input type="number" step='any' placeholder="Iva" id="iva" name="iva" onchange='retornooper()' value="<?php echo $iva; ?>" class="form-control" autocomplete=off readonly required dir='rtl'>
						</div>

						<div class="col-3" id='cargando'>
						</div>

					</div>
					<hr>

					<!-- COMISION -->
					<div class='row'>
						<div class="col-6" style='border:1px solid black;background:silver;'>
							<h5><center>% Comisión Cli/Desp</center></h5>
							<div class='row'>
								<div class="col-6">
									<label for="comision">% Comisión Cli/Desp</label>
									<input type="number" step='any' placeholder="Comisión pactada" id="comision" name="comision" value="<?php echo $comision; ?>" class="form-control" autocomplete=off <?php echo $readonly; ?> onchange='retornooper()' dir='rtl'>
								</div>

								<div class="col-6">
									<label for="Esquema">Tipo de Comisión</label>
									<?php
									echo "<select id='esquema' name='esquema' class='form-control' required onchange='retornooper()' $disabled required>";
									echo "<option value='' selected disabled>Seleccione una opción</option>";
									echo "<option value='1' "; if ($esquema==1) { echo "selected";} echo ">1. Total</option>";
									echo "<option value='2' "; if ($esquema==2) { echo "selected";} echo ">2. Subtotal</option>";
									echo "<option value='3' "; if ($esquema==3) { echo "selected";} echo ">3. Total + Iva</option>";
									echo "<option value='4' "; if ($esquema==4) { echo "selected";} echo ">4. Subtotal + Iva</option>";
									echo "<option value='5' "; if ($esquema==5) { echo "selected";} echo ">5. Al hacer el Retorno</option>";
									echo "</select>";
									?>
								</div>
							</div>

							<div class='row'>
								<div class="col-4">
									<label for="tcomision">Comisión</label>
									<input type="number" step='any' placeholder="Retorno" id="tcomision" name="tcomision" value="<?php echo $tcomision; ?>" class="form-control" autocomplete=off <?php echo $readonly; ?> dir='rtl' onchange='retornooper()'>
								</div>

								<div class="col-4">
									<label for="retorno">Retorno</label>
									<input type="number" step='any' placeholder="Retorno" id="retorno" name="retorno" value="<?php echo $retorno; ?>" class="form-control" autocomplete=off <?php echo $readonly; ?> dir='rtl' onchange='retornooper()'>
								</div>
							</div>
						</div>

						<!-- COMISION CLI -->
						<div class="col-6" style='border:1px solid black;background:#ffb6c1;'>
							<h5><center>% Comisión J&G</center></h5>
							<div class='row'>
								<div class="col-6">
									<label for="creal">% Comisión J&G</label>
									<input type="number" step='any' placeholder="Comisión real" id="creal" name="creal" value="<?php echo $creal; ?>" class="form-control" autocomplete=off <?php echo $readonly; ?> onchange='retornooper()'>
								</div>

								<div class="col-6">
									<label for="Esquema">Tipo de Comisión</label>
									<?php
									echo "<select id='esquema2' name='esquema2' class='form-control' required onchange='retornooper()' $disabled required>";
									echo "<option value='1' "; if ($esquema2==1) { echo "selected";} echo ">1. Total</option>";
									echo "<option value='2' "; if ($esquema2==2) { echo "selected";} echo ">2. Subtotal</option>";
									echo "<option value='3' "; if ($esquema2==3) { echo "selected";} echo ">3. Total + Iva</option>";
									echo "<option value='4' "; if ($esquema2==4) { echo "selected";} echo ">4. Subtotal + Iva</option>";
									echo "</select>";
									?>
								</div>
							</div>

							<div class='row'>
								<div class="col-4">
									<label for="tcomision">Comisión J&G</label>
									<input type="number" step='any' placeholder="Retorno" id="tcomision_r" name="tcomision_r" value="<?php echo $tcomision_r; ?>" class="form-control" autocomplete=off <?php echo $readonly; ?> dir='rtl' onchange='retornooper()'>
								</div>

								<div class="col-4">
									<label for="retorno">Retorno J&G</label>
									<input type="number" step='any' placeholder="Retorno" id="retorno_r" name="retorno_r" value="<?php echo $retorno_r; ?>" class="form-control" autocomplete=off <?php echo $readonly; ?> dir='rtl' onchange='retornooper()'>
								</div>

							</div>
						</div>
					</div>
					<hr>

					<div class='row'>
						<div class="col-3">
							<label for="comdespa">% Com. Despacho</label>
							<input type="number" step='any' placeholder="Com. Despacho" id="comdespa" name="comdespa" value="<?php echo $comdespa; ?>" class="form-control" autocomplete=off <?php echo $readonly; ?> dir='rtl' onchange='retornooper()' required>
						</div>

						<div class="col-3">
							<label for="comdespa_t">Comisión Despacho</label>
							<input type="number" step='any' placeholder="Com. Despacho" id="comdespa_t" name="comdespa_t" value="<?php echo $comdespa_t; ?>" class="form-control" autocomplete=off <?php echo $readonly; ?> dir='rtl' onchange='retornooper()'>
						</div>

						<div class="col-2">
							<label for="comisionistas">Comisionistas</label>
							<input type="number" step='any' placeholder="comisionistas" id="comisionistas" name="comisionistas" value="<?php echo $comisionistas; ?>" class="form-control" autocomplete=off <?php echo $readonly; ?> dir='rtl' onchange='retornooper()'>
						</div>

						<div class='col-sm-2'>
							<label>Contrato requerido: </label><br>
							<input type='checkbox' name='req_contrato' id='req_contrato' value=1
							<?php
							if($req_contrato==1){ echo " checked";}
							?>
							>
						</div>
					</div>

					<div class='row'>
						<div class="col-2">
							<label for="pikito">Pikito</label>
							<input type="number" step='any' placeholder="Pikito" id="pikito" name="pikito" value="<?php echo $pikito; ?>" class="form-control" autocomplete=off readonly dir='rtl' onchange='retornooper()'>
						</div>

						<div class="col-3">
							<label for="com_final">Comisión final jyg</label>
							<input type="number" step='any' placeholder="Comisión" id="com_final" name="com_final" value="<?php echo $com_final; ?>" class="form-control" autocomplete=off readonly dir='rtl' onchange='retornooper()'>
						</div>

						<div class="col-4">
							<label for="compikito">Comisión final jyg + Pikito</label>
							<input type="number" step='any' placeholder="Comisión" id="compikito" name="compikito" value="<?php echo $compikito; ?>" class="form-control" autocomplete=off readonly dir='rtl' onchange='retornooper()'>
						</div>
					</div>

					<hr>
					<div class="row">
						<div class="col-12">
							<div class="btn-group">
								<?php
								if($bloqueo==0 and $finalizar==0){
									echo "<button class='btn btn-outline-danger btn-sm' type='submit'><i class='far fa-save'></i>Guardar</button>";
								}
								if($finalizar==0){
									echo "<button class='btn btn-outline-danger btn-sm' type='button' onclick='finalizar()'><i class='far fa-check-circle'></i>Finalizar</button>";
								}
								if($id>0){
									if($idrazon>0 and $idempresa>0 and $finalizar==0){
										echo "<button type='button' class='btn btn-outline-secondary btn-sm' id='winmodal_cargo' data-id='0' data-id2='$id' data-id3='' data-lugar='a_operaciones/form_factura' title='Agregar factura'><i class='fas fa-plus'></i>Factura</button>";
										echo "<button type='button' class='btn btn-outline-secondary btn-sm' id='winmodal_cargo' data-id='0' data-id2='$id' data-lugar='a_operaciones/form_retorno'><i class='fas fa-plus'></i>Retorno</button>";
										echo "<button type='button' class='btn btn-outline-secondary btn-sm' id='winmodal_cargo' data-id='0' data-id2='$id' data-lugar='a_operaciones/form_operador'><i class='fas fa-id-badge'></i>Operador</button>";
									}

									if((strlen($contrato)<2 or !file_exists("../".$db->doc.trim($contrato))) and $finalizar==0){
										echo "<button type='button' class='btn btn-outline-secondary btn-sm' title='Agregar transferencia' data-toggle='modal' data-target='#myModal'
										id='fileup_contrato' data-ruta='".$db->doc."' data-tabla='operaciones' data-campo='contrato' data-tipo='1' data-id='$id' data-keyt='idoperacion'
										data-destino='a_operaciones/editar' data-iddest='$id' data-ext='.pdf' data-divdest='trabajo'><i class='fas fa-cloud-upload-alt'></i>Contrato</button>";
									}
									else{
										if(strlen($contrato)>2){
											echo "<div class='btn-group' role='group'>";
											echo "<button id='btnGroupDrop1' type='button' class='btn btn-outline-secondary btn-sm dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fas fa-paperclip'></i>XML</button>";
											echo "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
											echo "<a class='dropdown-item' href='".$db->doc.trim($contrato)."' target='_blank'><i class='fas fa-paperclip'></i>Ver</a>";
											if($finalizar==0){
												echo "<a class='dropdown-item' title='Eliminar archivo'
												id='delfile_contrato'
												data-ruta='".$db->doc.trim($contrato)."'
												data-keyt='idoperacion'
												data-key='$id'
												data-tabla='operaciones'
												data-campo='contrato'
												data-tipo='1'
												data-iddest='$id'
												data-divdest='trabajo'
												data-borrafile='1'
												data-dest='a_operaciones/editar.php?id='
												><i class='far fa-trash-alt'></i>Eliminar</a>";
											}
											echo "</div>";
											echo "</div>";
										}
									}
								}
								?>
								<button class='btn btn-outline-secondary btn-sm' id='lista_penarea' data-lugar='a_operaciones/lista' title='regresar'><i class='fas fa-undo-alt'></i>Regresar</button>
							</div>
						</div>
					</div>
				</div>

				<!--............................................COMISIONISTAS...................................... -->
				<div class="card-header">
					<div class='btn-group pull-right'>
						<button type='button' class="btn btn-outline-secondary btn-sm " data-toggle="collapse" data-target="#collapseuno" aria-expanded="true" aria-controls="collapseOne"><i class="fas fa-compress-arrows-alt"></i></button>
					</div>
					Comisionistas
				</div>
				<div id="collapseuno" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
					<?php
					if($id>0){
						$row=$db->opercomisionista($id);
						echo "<table class='table table-sm'>";
						echo "<tr><th>Comisionista</th><th>Porcentaje</th><th>Monto</th></tr>";
						foreach($row as $key){
							echo "<tr>";

							echo "<td>";
							echo $key['nombre'];
							echo "</td>";

							echo "<td> <center>";
							echo $key['porcentaje'];
							echo "</center></td>";

							echo "<td align='right'>";
							echo moneda($key['monto']);
							echo "</td>";

							echo "</tr>";
						}
						echo "</table>";
					}
					?>
				</div>

				<!--............................................OPERADORES...................................... -->
				<div class="card-header">
					<div class='btn-group pull-right'>
						<button type='button' class="btn btn-outline-secondary btn-sm " data-toggle="collapse" data-target="#collapseoper" aria-expanded="true" aria-controls="collapseOne"><i class="fas fa-compress-arrows-alt"></i></button>
					</div>
					Operadores
				</div>
				<div id="collapseoper" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
					<?php
					if($id>0){
						$row=$db->operadores_oper($id);
						echo "<table class='table table-sm'>";
						echo "<tr><th>-</th><th>Operador</th><th>Correo</th></tr>";
						foreach($row as $key){
							echo "<tr>";

							echo "<td>";
							echo "<div class='btn-group'>";

							echo "<button type='button' class='btn btn-outline-danger btn-sm' id='winmodal_cargo' data-id='".$key['idoper']."' data-id2='$id' data-lugar='a_operaciones/form_mail'><i class='far fa-envelope'></i></button>";
							if($finalizar==0){
								echo "<button class='btn btn-outline-secondary btn-sm' id='eliminar_operador' data-lugar='a_operaciones/db_operaciones'
								data-destino='a_operaciones/editar' data-id='".$key['id']."' data-funcion='borrar_operador' data-iddest='$id'><i class='far fa-trash-alt'></i></button>";
							}

							echo "</div>";
							echo "</td>";

							echo "<td>";
							echo $key['operador'];
							echo "</td>";

							echo "<td>";
							echo $key['correo'];
							echo "</td>";

							echo "</tr>";
						}
						echo "</table>";
					}
					?>
				</div>


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
											if($finalizar==0){
												echo "<button class='btn btn-outline-danger btn-sm' id='eliminar_factura' data-lugar='a_operaciones/db_operaciones' data-destino='a_operaciones/editar' data-id='".$key['idfactura']."' data-funcion='borrar_factura' data-iddest='$id'>
												<i class='far fa-trash-alt' style='color:red'></i></button>";
											}

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
												data-destino='a_operaciones/editar' data-iddest='$id' data-ext='.pdf' data-divdest='trabajo'><i class='fas fa-cloud-upload-alt'></i>Transf.</button>";
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
												data-divdest='trabajo'
												data-borrafile='1'
												data-dest='a_operaciones/editar.php?id='
												><i class='far fa-trash-alt'></i>Eliminar</a>";
												echo "</div>";
												echo "</div>";
											}
											if(strlen($key['timbre'])<2 or !file_exists("../".$db->doc.trim($key['timbre']))){
												echo "<button type='button' class='btn btn-outline-secondary btn-sm' title='Agregar transferencia' data-toggle='modal' data-target='#myModal'
												id='fileup_logo' data-ruta='".$db->doc."' data-tabla='facturas' data-campo='timbre' data-tipo='1' data-id='".$key['idfactura']."' data-keyt='idfactura'
												data-destino='a_operaciones/editar' data-iddest='$id' data-ext='.pdf' data-divdest='trabajo'><i class='fas fa-cloud-upload-alt'></i>Timbre</button>";
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
												data-divdest='trabajo'
												data-borrafile='1'
												data-dest='a_operaciones/editar.php?id='
												><i class='far fa-trash-alt'></i>Eliminar</a>";
												echo "</div>";
												echo "</div>";
											}
											if(strlen($key['xml'])<2 or !file_exists("../".$db->doc.trim($key['xml']))){
												echo "<button type='button' class='btn btn-outline-secondary btn-sm' title='Agregar transferencia' data-toggle='modal' data-target='#myModal'
												id='fileup_logo' data-ruta='".$db->doc."' data-tabla='facturas' data-campo='xml' data-tipo='1' data-id='".$key['idfactura']."' data-keyt='idfactura'
												data-destino='a_operaciones/editar' data-iddest='$id' data-ext='.pdf' data-divdest='trabajo'><i class='fas fa-cloud-upload-alt'></i>XML</button>";
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
												data-divdest='trabajo'
												data-borrafile='1'
												data-dest='a_operaciones/editar.php?id='
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
										$retorno_x=0;
										for($i=0;$i<count($ret);$i++){
											echo "<tr id=".$ret[$i]['idretorno']." class='edit-t'>";

											echo "<td>";
											echo "<div class='btn-group'>";
											echo "<button type='button' class='btn btn-outline-secondary btn-sm' id='winmodal_cargo' data-id='".$ret[$i]['idretorno']."' data-id2='$id' data-lugar='a_operaciones/form_retorno'><i class='fas fa-pencil-alt'></i></button>";
											echo "<button type='button' class='btn btn-outline-secondary btn-sm' id='imprimir_retorno' title='Imprimir' data-lugar='a_operaciones/imprimir' data-tipo='2'><i class='far fa-file-pdf'></i></button>";
											if($finalizar==0){
												echo "<button class='btn btn-outline-secondary btn-sm' id='eliminar_retorno' data-lugar='a_operaciones/db_operaciones' data-destino='a_operaciones/editar' data-id='".$ret[$i]['idretorno']."' data-funcion='borrar_retorno' data-iddest='$id'><i class='far fa-trash-alt'></i></button>";
											}
											echo "</div>";
											echo "</td>";

											echo "<td>";
											echo $ret[$i]["fecha"];
											echo "</td>";

											echo "<td>";
											echo $ret[$i]["idproducto"];
											echo "</td>";

											echo "<td align='right'>";
											echo moneda($ret[$i]["retorno"]);
											echo "</td>";

											echo "<td align='right'>";
											$retorno_x+=$ret[$i]["monto"];
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
						echo "<label>Monto:</label><br>";
						echo moneda($monto);
						echo "</div>";

						echo "<div class='col-2'>";
						echo "<label>Retorno:</label><br>";
						$r_final=0;
						if($esquema<5){
							if($creal==0){
								$r_final=$retorno;
								echo moneda($retorno);
							}
							else{
								$r_final=$retorno_r;
								echo moneda($retorno_r);
							}
						}
						else{
							echo moneda($ret_t);
						}
						echo "</div>";

						echo "<div class='col-2'>";
						echo "<label>Monto de facturas:</label><br>";
						echo moneda($suma);
						echo "</div>";

						echo "<div class='col-2'>";
						echo "<label>Saldo de facturas:</label><br>";
						if($esquema<5){
							echo moneda($monto-$suma);
						}
						else{
							echo "N/A";
						}
						echo "</div>";

						echo "<div class='col-2'>";
						echo "<label>Monto de retorno:</label></br>";
						if($esquema<5){
							echo moneda($retorno_x);
						}
						else{
							echo moneda($retorno_x);
						}
						echo "</div>";

						echo "<div class='col-2'>";
						echo "<label>Saldo de retorno:</label><br>";
						if($esquema<5){
							echo moneda($r_final-$retorno_x);
						}
						else{
							echo moneda($monto-$retorno_x);
						}
						echo "</div>";

					?>
					</div>
					<hr>
					<div class='row'>
						<div class="col-4">
							<label for="ejecutivo">Ejecutivo</label>
							<input type="text" placeholder="Ejecutivo" id="ejecutivo" name="ejecutivo" value="<?php echo $nombre; ?>" class="form-control" autocomplete=off readonly >
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>

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
