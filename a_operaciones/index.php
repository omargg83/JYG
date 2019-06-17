<?php
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
	function desgloce(){
		var monto=parseFloat($("#monto_fact").val());
		if (isNaN(monto)){
			monto=0;
			$("#monto_fact").val(0);
		}
		var iva=Math.round((monto/1.16)*100)/100;
		$("#iva").val(iva);
		var subtotal=Math.round((monto-iva)*100)/100;
		$("#subtotal").val(subtotal);
	}
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
	function seleccomision(xyId){
 		var idoperacion = $("#id").val();
		var parametros={
			"id":idoperacion,
			"idrazon":xyId,
			"function":"guarda_razon"
		};
		$.confirm({
			title: 'Guardar',
			content: '¿Desea seleccionar el cliente?',
			buttons: {
				Aceptar: function () {
					$.ajax({
						data:  parametros,
							url:   "a_operaciones/db_operaciones.php",
						type: "post",
						beforeSend: function () {
							$("#trabajo").html("cargando..");
						},
						success:  function (response) {
							$("#trabajo").load("a_operaciones/editar.php?id="+idoperacion);
							$('#myModal').modal('hide');
						}
					});
				},
				Cancelar: function () {
					$.alert('Canceled!');
				}
			}
		});
}
	function seleccliente(xyId){
 		var idoperacion = $("#id").val();
		var parametros={
			"id":idoperacion,
			"idempresa":xyId,
			"function":"guarda_razon"
		};
		$.confirm({
			title: 'Guardar',
			content: '¿Desea seleccionar el cliente?',
			buttons: {
				Aceptar: function () {
					$.ajax({
						data:  parametros,
							url:   "a_operaciones/db_operaciones.php",
						type: "post",
						beforeSend: function () {
							$("#trabajo").html("cargando..");
						},
						success:  function (response) {
							$("#trabajo").load("a_operaciones/editar.php?id="+idoperacion);
							$('#myModal').modal('hide');
						}
					});
				},
				Cancelar: function () {
					$.alert('Canceled!');
				}
			}
		});
	}


$(document).on('keyup','#uso',function(e){
	var e = window.event;
	var tecla = (document.all) ? e.keyCode : e.which;
	var valor=$(this).val();
	var division=valor.length%2;

	if(tecla!=37 && tecla!=38 && tecla!=39 && tecla!=40){
			$.ajax({
				data:  {
					"valor":valor,
					"function":"uso_buscar"
				},
				url:   "a_operaciones/db_operaciones.php",
				type:  'post',
				beforeSend: function () {

				},
				success:  function (response) {
					fila = 0;
					$("#uso_auto").html(response);
				}
			});
			$("#uso_auto").show();
	}
	if(tecla == 27 || tecla==9){
		$("#uso_auto").hide();
	}
	if ( $("#usotb").length ) {
		var tab = document.getElementById('usotb');
		var filas = tab.getElementsByTagName('tr');
		if(filas.length>1){
			if(tecla==13){
				if(fila==0){
					$('#uso').val(filas[1].getElementsByTagName("td")[0].innerHTML);
				}
				else{
					$('#uso').val(filas[fila].getElementsByTagName("td")[0].innerHTML);
				}
				$("#uso_auto").hide();
				$("#anexos").focus();
			}
		}
		if (e.keyCode==38 && fila>0) num=-1;
		else if(e.keyCode==40 && fila<filas.length-1) num=1;
		else return;
		filas[fila].style.background = 'white';
		fila+=num;
		filas[fila].style.background = 'silver';

		if(fila==0){
			filas[fila].style.background = 'white';
		}
	}
});
$(document).on('click','#uso_auto tr',function(e){
		$('#uso').val($(this).find('td:first').html());
		$("#uso_auto").hide();
	});

$(document).on('keyup','#forma',function(e){
	var e = window.event;
	var tecla = (document.all) ? e.keyCode : e.which;
	var valor=$(this).val();
	var division=valor.length%2;

	if(tecla!=37 && tecla!=38 && tecla!=39 && tecla!=40){
		if(valor.length>2 && division==0){
			$.ajax({
				data:  {
					"valor":valor,
					"function":"forma_buscar"
				},
				url:   "a_operaciones/db_operaciones.php",
				type:  'post',
				beforeSend: function () {

				},
				success:  function (response) {
					fila = 0;
					$("#forma_auto").html(response);
				}
			});
			$("#forma_auto").show();
		}
	}
	if(tecla == 27 || tecla==9){
		$("#forma_auto").hide();
	}
	if ( $("#formatb").length ) {
		var tab = document.getElementById('formatb');
		var filas = tab.getElementsByTagName('tr');
		if(filas.length>1){
			if(tecla==13){
				if(fila==0){
					$('#forma').val(filas[1].getElementsByTagName("td")[0].innerHTML);
				}
				else{
					$('#forma').val(filas[fila].getElementsByTagName("td")[0].innerHTML);
				}
				$("#forma_auto").hide();
				$("#anexos").focus();
			}
		}
		if (e.keyCode==38 && fila>0) num=-1;
		else if(e.keyCode==40 && fila<filas.length-1) num=1;
		else return;
		filas[fila].style.background = 'white';
		fila+=num;
		filas[fila].style.background = 'silver';

		if(fila==0){
			filas[fila].style.background = 'white';
		}
	}
});
$(document).on('click','#forma_auto tr',function(e){
	$('#forma').val($(this).find('td:first').html());
	$("#forma_auto").hide();
});

$(document).on('keyup','#producto',function(e){
	var e = window.event;
	var tecla = (document.all) ? e.keyCode : e.which;
	var valor=$(this).val();
	var division=valor.length%2;

	if(tecla!=37 && tecla!=38 && tecla!=39 && tecla!=40){
		if(valor.length>2 && division==0){
			$.ajax({
				data:  {
					"valor":valor,
					"function":"producto_buscar"
				},
				url:   "a_operaciones/db_operaciones.php",
				type:  'post',
				beforeSend: function () {

				},
				success:  function (response) {
					fila = 0;
					$("#producto_auto").html(response);
				}
			});
			$("#producto_auto").show();
		}
	}
	if(tecla == 27 || tecla==9){
		$("#producto_auto").hide();
	}
	if ( $("#productotb").length ) {
		var tab = document.getElementById('productotb');
		var filas = tab.getElementsByTagName('tr');
		if(filas.length>1){
			if(tecla==13){
				if(fila==0){
					$('#producto').val(filas[1].getElementsByTagName("td")[0].innerHTML);
				}
				else{
					$('#producto').val(filas[fila].getElementsByTagName("td")[0].innerHTML);
				}
				$("#producto_auto").hide();
			}
		}
		if (e.keyCode==38 && fila>0) num=-1;
		else if(e.keyCode==40 && fila<filas.length-1) num=1;
		else return;
		filas[fila].style.background = 'white';
		fila+=num;
		filas[fila].style.background = 'silver';

		if(fila==0){
			filas[fila].style.background = 'white';
		}
	}
});
$(document).on('click','#producto_auto tr',function(e){
	$('#producto').val($(this).find('td:first').html());
	$("#producto_auto").hide();
});



</script>
