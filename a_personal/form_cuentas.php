<?php 
	session_start();
	require_once("cheques_db.php");
	
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	
	$ch = new Cheques();
	$id=$_REQUEST['id'];
	if($id>0){
		$res=$ch->cuenta_edit($id);
		$banco=$res['banco'];
		$numcuenta=$res['numcuenta'];
		$saldo=$res['saldo'];
		$observaciones=$res['observaciones'];
		$inicial=$res['inicial'];
		$anio=$res['anio'];
	}
	else{
		$banco="";
		$numcuenta="";
		$saldo="0";
		$observaciones="";
		$inicial="0";
		$anio=date("Y");
	}

	echo "<div class='container' >";
	echo "<form id='form_erogar' action='' data-lugar='a_cheques/cheques_db' data-funcion='guardar_cuenta' data-destino='a_cheques/lista_cuentas' autocomplete='off'>";
		echo  "<input class='form-control' type='hidden' id='id' NAME='id' value='$id' >";
		
		echo "<div class='card'>";
			echo "<div class='card-header'>";
				echo "Captura de cuentas";
			echo "</div>";
			echo "<div class='card-body'>";
				echo "<div class='row'>";
					echo  "<div class='col-sm-4'>";
						echo "<label>Banco:</label>";
						echo "<input class='form-control' type='text' id='banco' name='banco' value='$banco' placeholder='Banco' required>";
					echo  "</div>";
					echo  "<div class='col-sm-4'>";
						echo "<label>Cuenta:</label>";
						echo "<input class='form-control' type='text' id='numcuenta' name='numcuenta' value='$numcuenta' placeholder='Cuenta' required>";
					echo  "</div>";
					echo  "<div class='col-sm-4'>";
						echo "<label>Saldo:</label>";
						echo "<input class='form-control' type='number' id='saldo' name='saldo' value='$saldo' placeholder='Saldo' required>";
					echo  "</div>";
					echo  "<div class='col-sm-4'>";
						echo "<label>Inicial:</label>";
						echo "<input class='form-control' type='number' id='inicial' name='inicial' value='$inicial' placeholder='Inicial' required>";
					echo  "</div>";
					
					echo  "<div class='col-sm-4'>";
						echo "<label>Año:</label>";
						echo "<input class='form-control' type='number' id='anio' name='anio' value='$anio' placeholder='Año' required>";
					echo  "</div>";
					
					echo  "<div class='col-sm-12'>";
						echo "<label>Observaciones:</label>";
						echo "<input class='form-control' type='text' id='observaciones' name='observaciones' value='$observaciones' placeholder='Observaciones'>";
					echo  "</div>";
				echo  "</div>";
			
			echo "</div>";
			echo "<div class='card-footer'>";
				echo "<div class='btn-group' role='group' aria-label='Basic example'>";
					echo "<button class='btn btn-outline-secondary btn-sm' type='submit'><i class='far fa-save'></i>Guardar</button>";
					if($id>0){
						echo "<button class='btn btn-outline-secondary btn-sm' id='eliminar_cuenta' data-lugar='a_cheques/cheques_db' data-destino='a_cheques/lista_cuentas' data-id='$id' data-funcion='borrar_cuenta' data-div='trabajo'><i class='far fa-trash-alt'></i>Eliminar</button>";
					}
					echo "<a class='btn btn-outline-secondary btn-sm' id='lista_penarea' data-lugar='a_cheques/lista_cuentas'><i class='fas fa-undo-alt'></i>Atras</a>";
				echo  "</div>";
			echo  "</div>";
		echo "</div>";
	
	echo "</form>";
	echo "</div>";
?>
	
		

