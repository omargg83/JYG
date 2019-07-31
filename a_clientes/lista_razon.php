<?php
require_once("db_.php");
$id=$_REQUEST['id'];
$pd=$db->razon($id);

echo "<table class='table table-sm' id='x_lista'>";
echo "<thead><tr><th>#</th><th>Razon social</th><th>Acta constitutiva</th><th>Poder</th><th>INE</th><th>RFC</th><th>32D</th><th>Comprobante</th></tr></thead>";
echo "<tbody>";
foreach($pd as $key){
	echo "<tr id=".$key['idrazon']." class='edit-t'>";
	echo "<td>";
	echo "<div class='btn-group'>";
	echo "<button type='button' class='btn btn-outline-secondary btn-sm' id='winmodal_cargo' data-id='".$key['idrazon']."' data-id2='$id' data-lugar='a_clientes/form_razon' title='Cambiar cargo'><i class='fas fa-pencil-alt'></i></button>";

	echo "</div>";
	echo "</td>";

	echo "<td>".$key["razon"]."</td>";

	echo "<td>";
	if(strlen($key['acta'])<2 or !file_exists("../".$db->doc.trim($key['acta']))){
		echo "<button type='button' class='btn btn-outline-secondary btn-sm' title='Agregar acta' data-toggle='modal' data-target='#myModal'
		id='fileup_acta_".$key['idrazon']."' data-ruta='".$db->doc."' data-tabla='clientes_razon' data-campo='acta' data-tipo='1' data-id='".$key['idrazon']."' data-keyt='idrazon'
		data-destino='a_clientes/editar' data-iddest='$id' data-divdest='trabajo' data-ext='.pdf' ><i class='fas fa-cloud-upload-alt'></i></button>";
	}
	else{
		echo "<div class='btn-group' role='group'>";
		echo "<button id='btnGroupDrop1' type='button' class='btn btn-outline-secondary btn-sm dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fas fa-paperclip'></i></button>";
		echo "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
		echo "<a class='dropdown-item' href='".$db->doc.trim($key['acta'])."' target='_blank'><i class='fas fa-paperclip'></i>Ver</a>";
		echo "<a class='dropdown-item' title='Eliminar archivo'
		id='delfile_acta_".$key['idrazon']."'
		data-ruta='".$db->doc.trim($key['acta'])."'
		data-keyt='idrazon'
		data-key='".$id."'
		data-tabla='clientes_razon'
		data-campo='acta'
		data-tipo='1'
		data-iddest='$id'
		data-divdest='trabajo'
		data-borrafile='1'
		data-dest='a_clientes/editar.php?id='
		><i class='far fa-trash-alt'></i>Eliminar</a>";
		echo "</div>";
		echo "</div>";
	}
	echo "</td>";


	echo "<td>";
	if(strlen($key['poder'])<2 or !file_exists("../".$db->doc.trim($key['poder']))){
		echo "<button type='button' class='btn btn-outline-secondary btn-sm' title='Agregar logo' data-toggle='modal' data-target='#myModal'
		id='fileup_poder_".$key['idrazon']."' data-ruta='".$db->doc."' data-tabla='clientes_razon' data-campo='poder' data-tipo='1' data-id='".$key['idrazon']."' data-keyt='idrazon'
		data-destino='a_clientes/editar' data-iddest='$id' data-ext='.pdf' data-divdest='trabajo'><i class='fas fa-cloud-upload-alt'></i></button>";
	}
	else{
		echo "<div class='btn-group' role='group'>";
		echo "<button id='btnGroupDrop1' type='button' class='btn btn-outline-secondary btn-sm dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fas fa-paperclip'></i></button>";
		echo "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
		echo "<a class='dropdown-item' href='".$db->doc.trim($key['poder'])."' target='_blank'><i class='fas fa-paperclip'></i>Ver</a>";
		echo "<a class='dropdown-item' title='Eliminar archivo'
		id='delfile_poder_".$key['idrazon']."'
		data-ruta='".$db->doc.trim($key['poder'])."'
		data-keyt='idrazon'
		data-key='".$id."'
		data-tabla='clientes_razon'
		data-campo='poder'
		data-tipo='1'
		data-iddest='$id'
		data-divdest='trabajo'
		data-borrafile='1'
		data-dest='a_clientes/editar.php?id='
		><i class='far fa-trash-alt'></i>Eliminar</a>";
		echo "</div>";
		echo "</div>";
	}
	echo "</td>";

	echo "<td>";
	if(strlen($key['ife'])<2 or !file_exists("../".$db->doc.trim($key['ife']))){
		echo "<button type='button' class='btn btn-outline-secondary btn-sm' title='Agregar logo' data-toggle='modal' data-target='#myModal'
		id='fileup_ine_".$key['idrazon']."' data-ruta='".$db->doc."' data-tabla='clientes_razon' data-campo='ife' data-tipo='1' data-id='".$key['idrazon']."' data-keyt='idrazon'
		data-destino='a_clientes/editar' data-iddest='$id' data-ext='.pdf' data-divdest='trabajo' ><i class='fas fa-cloud-upload-alt'></i></button>";
	}
	else{
		echo "<div class='btn-group' role='group'>";
		echo "<button id='btnGroupDrop1' type='button' class='btn btn-outline-secondary btn-sm dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fas fa-paperclip'></i></button>";
		echo "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
		echo "<a class='dropdown-item' href='".$db->doc.trim($key['ife'])."' target='_blank'><i class='fas fa-paperclip'></i>Ver</a>";
		echo "<a class='dropdown-item' title='Eliminar archivo'
		id='delfile_ine_".$key['idrazon']."'
		data-ruta='".$db->doc.trim($key['ife'])."'
		data-keyt='idrazon'
		data-key='".$id."'
		data-tabla='clientes_razon'
		data-campo='ife'
		data-tipo='1'
		data-iddest='$id'
		data-divdest='trabajo'
		data-borrafile='1'
		data-dest='a_clientes/editar.php?id='
		><i class='far fa-trash-alt'></i>Eliminar</a>";
		echo "</div>";
		echo "</div>";
	}
	echo "</td>";

	echo "<td>";
	if(strlen($key['rfc'])<2 or !file_exists("../".$db->doc.trim($key['rfc']))){
		echo "<button type='button' class='btn btn-outline-secondary btn-sm' title='Agregar logo' data-toggle='modal' data-target='#myModal'
		id='fileup_rfc_".$key['idrazon']."' data-ruta='".$db->doc."' data-tabla='clientes_razon' data-campo='rfc' data-tipo='1' data-id='".$key['idrazon']."' data-keyt='idrazon'
		data-destino='a_clientes/editar' data-iddest='$id' data-ext='.pdf' data-divdest='trabajo'><i class='fas fa-cloud-upload-alt'></i></button>";
	}
	else{
		echo "<div class='btn-group' role='group'>";
		echo "<button id='btnGroupDrop1' type='button' class='btn btn-outline-secondary btn-sm dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fas fa-paperclip'></i></button>";
		echo "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
		echo "<a class='dropdown-item' href='".$db->doc.trim($key['rfc'])."' target='_blank'><i class='fas fa-paperclip'></i>Ver</a>";
		echo "<a class='dropdown-item' title='Eliminar archivo'
		id='delfile_rfc_".$key['idrazon']."'
		data-ruta='".$db->doc.trim($key['rfc'])."'
		data-keyt='idrazon'
		data-key='".$id."'
		data-tabla='clientes_razon'
		data-campo='rfc'
		data-tipo='1'
		data-iddest='$id'
		data-divdest='trabajo'
		data-borrafile='1'
		data-dest='a_clientes/editar.php?id='
		><i class='far fa-trash-alt'></i>Eliminar</a>";
		echo "</div>";
		echo "</div>";
	}
	echo "</td>";

	echo "<td>";
	if(strlen($key['d32'])<2 or !file_exists("../".$db->doc.trim($key['d32']))){
		echo "<button type='button' class='btn btn-outline-secondary btn-sm' title='Agregar logo' data-toggle='modal' data-target='#myModal'
		id='fileup_d32_".$key['idrazon']."' data-ruta='".$db->doc."' data-tabla='clientes_razon' data-campo='d32' data-tipo='1' data-id='".$key['idrazon']."' data-keyt='idrazon'
		data-destino='a_clientes/editar' data-iddest='$id' data-ext='.pdf' data-divdest='trabajo'><i class='fas fa-cloud-upload-alt'></i></button>";
	}
	else{
		echo "<div class='btn-group' role='group'>";
		echo "<button id='btnGroupDrop1' type='button' class='btn btn-outline-secondary btn-sm dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fas fa-paperclip'></i></button>";
		echo "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
		echo "<a class='dropdown-item' href='".$db->doc.trim($key['d32'])."' target='_blank'><i class='fas fa-paperclip'></i>Ver</a>";
		echo "<a class='dropdown-item' title='Eliminar archivo'
		id='delfile_d32_".$key['idrazon']."'
		data-ruta='".$db->doc.trim($key['d32'])."'
		data-keyt='idrazon'
		data-key='".$id."'
		data-tabla='clientes_razon'
		data-campo='d32'
		data-tipo='1'
		data-iddest='$id'
		data-divdest='trabajo'
		data-borrafile='1'
		data-dest='a_clientes/editar.php?id='
		><i class='far fa-trash-alt'></i>Eliminar</a>";
		echo "</div>";
		echo "</div>";
	}
	echo "</td>";

	echo "<td>";
	if(strlen($key['comprobante'])<2 or !file_exists("../".$db->doc.trim($key['comprobante']))){
		echo "<button type='button' class='btn btn-outline-secondary btn-sm' title='Agregar logo' data-toggle='modal' data-target='#myModal'
		id='fileup_compro_".$key['idrazon']."' data-ruta='".$db->doc."' data-tabla='clientes_razon' data-campo='comprobante' data-tipo='1' data-id='".$key['idrazon']."' data-keyt='idrazon'
		data-destino='a_clientes/editar' data-iddest='$id' data-ext='.pdf' data-divdest='trabajo'><i class='fas fa-cloud-upload-alt'></i></button>";
	}
	else{
		echo "<div class='btn-group' role='group'>";
		echo "<button id='btnGroupDrop1' type='button' class='btn btn-outline-secondary btn-sm dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fas fa-paperclip'></i></button>";
		echo "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
		echo "<a class='dropdown-item' href='".$db->doc.trim($key['comprobante'])."' target='_blank'><i class='fas fa-paperclip'></i>Ver</a>";
		echo "<a class='dropdown-item' title='Eliminar archivo'
		id='delfile_compro_".$key['idrazon']."'
		data-ruta='".$db->doc.trim($key['comprobante'])."'
		data-keyt='idrazon'
		data-key='".$id."'
		data-tabla='clientes_razon'
		data-campo='comprobante'
		data-tipo='1'
		data-iddest='$id'
		data-divdest='trabajo'
		data-borrafile='1'
		data-dest='a_clientes/editar.php?id='
		><i class='far fa-trash-alt'></i>Eliminar</a>";
		echo "</div>";
		echo "</div>";
	}
	echo "</td>";
	echo "</tr>";
}
echo "</tbody>";
echo "</table>";
?>
<script>
$(document).ready( function () {
	lista("x_lista");
});
</script>
