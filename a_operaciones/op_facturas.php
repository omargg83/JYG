<?php
	require_once("db_operaciones.php");

	if (isset($_REQUEST['id'])){
		$id=$_REQUEST['id'];
	}
	$fact = $db->facturas($id);
	$nofacturas=count($fact);
	$pers = $db->operacion_edit($id);
	$monto=$pers['monto'];
	echo "<div class='container-fluid' style='background-color:".$_SESSION['cfondo']."; '>";
	echo "<h5>Facturas</h5>";
	echo "<button type='button' class='btn btn-outline-secondary btn-sm' id='winmodal_cargo' data-id='0' data-id2='$id' data-id3='$nofacturas' data-lugar='a_operaciones/form_factura'><i class='fas fa-file-invoice'></i>Nueva</button>";
	echo "<hr>";
?>
		<div class="content table-responsive table-full-width">
			<table class="table table-sm">
			<thead>
			<th>#</th>
			<th>-</th>
			<th>Fecha</th>
			<th>Descripción</th>
			<th>Monto</th>
			<th>Documentos</th>
			</tr>
			</thead>
			<tbody>
			<?php
				$suma=0;
				foreach($fact as $key){
					echo "<tr id=".$key['idfactura']." class='edit-t'>";

					echo "<td>";
					echo $key['idfactura'];
					echo "</td>";

					echo "<td>";
					echo "<div class='btn-group'>";
					echo "<button type='button' class='btn btn-outline-secondary btn-sm' id='winmodal_cargo' data-id='".$key['idfactura']."' data-id2='$id' data-id3='$nofacturas' data-lugar='a_operaciones/form_factura'><i class='fas fa-pencil-alt'></i></button>";

					echo "<button class='btn btn-outline-secondary btn-sm' id='eliminar_factura' data-lugar='a_operaciones/db_operaciones' data-destino='a_operaciones/op_facturas' data-id='".$key['idfactura']."' data-funcion='borrar_factura' data-div='facturas' data-iddest='$id'><i class='far fa-trash-alt'></i></i></button>";

					echo "<button type='button' class='btn btn-outline-secondary btn-sm' id='imprimir_comision' title='Imprimir' data-lugar='a_operaciones/imprimir' data-tipo='1'><i class='far fa-file-pdf'></i></button>";
					echo "</div>";
					echo "</td>";

					echo "<td>";
					echo fecha($key["fecha"]);
					echo "</td>";

					echo "<td>";
					echo $key["descripcion"];
					echo "</td>";

					echo "<td align='right'>";
					$suma+=$key["monto"];
					echo moneda($key["monto"]);
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

					echo "</tr>";
				}
				echo "<tr>";
				echo "<td colspan=3><b>";
				echo "Total";
				echo "</td>";
				echo "<td align='right'>";
				echo moneda($monto);
				echo "</td>";
				echo "<td align='right'>";
				echo moneda($suma);
				echo "</td>";
				echo "</tr>";
			?>
			</tbody>
			</table>
		</div>
	</div>
