<?php
	require_once("db_operaciones.php");
	$db = new Operaciones();	
	echo "<nav class='navbar navbar-expand-lg navbar-light bg-light '>
	
	<a class='navbar-brand' ><i class='fas fa-hand-holding-usd'></i> Operaciones</a>	
	
	  <button class='navbar-toggler navbar-toggler-right' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='principal' aria-expanded='false' aria-label='Toggle navigation'>
		<span class='navbar-toggler-icon'></span>
	  </button>
		  <div class='collapse navbar-collapse' id='navbarSupportedContent'>
			<ul class='navbar-nav mr-auto'>";
			echo"<li class='nav-item active'><a class='nav-link barranav' title='Mostrar todo' id='lista_comision' data-lugar='a_operaciones/lista'><i class='fas fa-list-ul'></i><span>Lista</span></a></li>";
			

			echo"<li class='nav-item active'><a class='nav-link barranav izq' title='Nuevo' id='new_personal' data-lugar='a_operaciones/editar'><i class='fas fa-plus'></i><span>Nuevo</span></a></li>";
	
			echo "</ul>";
		echo "
	  </div>
	</nav>";
	echo "<div id='trabajo'>";
		include 'lista.php';	
	echo "</div>";
?>	
<script type="text/javascript">
	$(document).on('keypress','#cliente_bus',function(e){
		if(e.which == 13) {
			e.preventDefault();
			e.stopPropagation();
			buscar();
		}
	});
	$(document).on('click','#buscar_cliente',function(e){
		e.preventDefault();
		e.stopPropagation();
		buscar();
	});

	function buscar(){
		var texto=$("#cliente_bus").val();
		if(texto.length>=3){
			$.ajax({
				data:  {
					"texto":texto,
					"function":"busca_cliente"
				},
				url:   "a_operaciones/db_operaciones.php",
				type:  'post',
				beforeSend: function () {
					$("#resultadosx").html("buscando...");
				},
				success:  function (response) {
					$("#resultadosx").html(response);
				}
			});
		}
	}

	$(document).on('click','#cliente_sel',function(e){
		e.preventDefault();
		e.stopPropagation();
		var xyId = $(this).closest(".edit-t").attr("id");
		$.ajax({
			data:  {
				"idrazon":xyId
			},
			url:   "a_operaciones/op_cliente.php",
			type:  'post',
			beforeSend: function () {
				$("#cliente").html("buscando...");
			},
			success:  function (response) {
				$("#idrazon").val(xyId);
				$("#cliente").html(response);
				$('#myModal').modal('hide');
				$("#modal_form").html("");
			}
		});
	});

	$(document).on('keypress','#despacho_bus',function(e){
		if(e.which == 13) {
			e.preventDefault();
			e.stopPropagation();
			buscar_despa();
		}
	});
	$(document).on('click','#buscar_despacho',function(e){
		e.preventDefault();
		e.stopPropagation();
		buscar_despa();
	});

	function buscar_despa(){
		var texto=$("#despacho_bus").val();
		if(texto.length>=1){
			$.ajax({
				data:  {
					"texto":texto,
					"function":"busca_despacho"
				},
				url:   "a_operaciones/db_operaciones.php",
				type:  'post',
				beforeSend: function () {
					$("#resultadosx").html("buscando...");
				},
				success:  function (response) {
					$("#resultadosx").html(response);
				}
			});
		}
	}


	$(document).on('click','#despacho_sel',function(e){
		e.preventDefault();
		e.stopPropagation();
		var xyId = $(this).closest(".edit-t").attr("id");
		$.ajax({
			data:  {
				"idempresa":xyId
			},
			url:   "a_operaciones/op_despacho.php",
			type:  'post',
			beforeSend: function () {
				$("#despacho").html("buscando...");
			},
			success:  function (response) {
				$("#idempresa").val(xyId);
				$("#despacho").html(response);
				$('#myModal').modal('hide');
				$("#modal_form").html("");
			}
		});
	});


	$(document).on('change','#idproducto_selx',function(e){
		e.preventDefault();
		e.stopPropagation();
		var xyId = $(this).val();
		$.ajax({
			data:  {
				"idproducto":xyId,
				"function":"producto_tipo"
			},
			url:   "a_operaciones/db_operaciones.php",
			type:  'post',
			beforeSend: function () {
				$("#producto_tipo").html("buscando...");
			},
			success:  function (response) {
				$("#producto_tipo").html(response);
			}
		});
	});


	

</script>
	