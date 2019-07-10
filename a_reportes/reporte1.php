<?php
  require_once("db_.php");
  $fecha=date("d-m-Y");
  $nuevafecha = strtotime ( '-1 month' , strtotime ( $fecha ) ) ;
  $fecha1 = date ( "d-m-Y" , $nuevafecha );
?>

<div class='container' >
	<div class='jumbotron'>
		<form id='consulta_avanzada' action='' data-destino='a_reportes/res1' data-div='resultado' data-funcion='avanzada' autocomplete='off'>
			<div class='row'>
				<div class='col-sm-6'>
					<div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"> <i class="fa fa fa-calendar"></i> </span>
						</div>
						<input class="form-control fechaclass" placeholder="Desde...." type="text" id='desde' name='desde' value='<?php echo $fecha1; ?>' autocomplete="off">
					</div>
				</div>

				<div class='col-sm-6'>
					<div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"> <i class="fa fa fa-calendar"></i> </span>
						</div>
						<input class="form-control fechaclass" placeholder="Hasta...." type="text" id='hasta' name='hasta' value='<?php echo $fecha; ?>' autocomplete="off">
					</div>
				</div>
			</div>
			<div class='row'>
				<div class='col-sm-4'>
					<div class='btn-group'>
					<button title='Buscar' class='btn btn-outline-primary' id='buscar_canalizado' type='submit' id='lista_buscar' data-lugar='a_corresp/lista' data-valor='buscar' data-funcion='buscar'><i class='fa fa-search'></i><span> Buscar</span></button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<div id='resultado'>

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
