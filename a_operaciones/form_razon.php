<?php
	require_once("db_operaciones.php");
	$id=$_REQUEST['id'];
	$db = new Operaciones();

	$res=$db->cliente_edit($id);
	$cliente=$res['cliente'];
?>
<form id='clientesel' action=''>
<input type="hidden" name="idcliente_seek" id='idcliente_seek' value='<?php echo $id; ?>' readonly>
<div class="card">
	<div class="card-header">Razon social</div>
	<div class="card-body">
		<div clas='row'>
			<div class='col-4'>
				<label for='oficiosal'>Cliente</label>
				<input type="text" name="cliente_seek" id='cliente_seek' placeholder='buscar razon social' class='form-control' value='<?php echo $cliente; ?>' readonly>
			</div>
		</div>
	</div>
	<div class="card-body" id='resultadosx'>
	<?php
		$id=$_REQUEST['id'];
		$pd=$db->razon($id);

		echo "<table class='table table-sm' id='razon'>";
		echo "<thead><tr><th>#</th><th>Razon social</th></tr></thead>";
		echo "<tbody>";
		for($i=0;$i<count($pd);$i++){
			echo "<tr id='".$pd[$i]['idrazon']."' class='edit-t'>";
			echo "<td>";
				echo "<div class='btn-group'>";
					echo "<button type='button' class='btn btn-outline-secondary btn-sm' id='cliente_sel' title='seleccionar razon social' data-id='".$pd[$i]['idrazon']."' data-razon='".$pd[$i]['razon']."'><i class='fas fa-pencil-alt'></i></button>";
				echo "</div>";
			echo "</td>";

			echo "<td>".$pd[$i]["razon"]."</td>";

			echo "</tr>";
		}
		echo "</tbody>";
		echo "</table>";

	?>


	</div>

	<div class="card-footer">
		<div class='btn-group'>
			<button type='button' class='btn btn-outline-secondary btn-sm' id='winmodal_cargo' data-id='$id' data-id2='$t_idcargo' data-id3='$t_area' data-lugar='a_operaciones/form_cliente' title='Cambiar cargo'><i class="fas fa-user-check"/>Regresar</button>
		</div>
	</div>
</div>
</form>
