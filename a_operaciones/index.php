<?php
	require_once("db_operaciones.php");

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

			echo "<form class='form-inline my-2 my-lg-0' id='form_correspxx' action='' >
				<input class='form-control mr-sm-2' type='search' placeholder='Busqueda global' aria-label='Search' name='buscar' id='buscar'>
					<div class='btn-group'>
				 <button class='btn btn-outline-secondary btn-sm' type='submit' id='lista_buscar' data-lugar='a_operaciones/lista' data-valor='buscar' data-funcion='buscar'><i class='fas fa-search'></i></button>
				 </div>
			</form>";

		echo "
	  </div>
	</nav>";
	echo "<div id='trabajo'>";
		include 'lista.php';
	echo "</div>";
?>
<script type="text/javascript">

	function retornooper(){
		var monto=parseFloat($("#monto").val());
		var esquema=parseFloat($("#esquema").val());
		var esquema2=parseFloat($("#esquema2").val());
		var comision=parseFloat($("#comision").val());
		var creal=parseFloat($("#creal").val());
		var comdespa=parseFloat($("#comdespa").val());

		if (isNaN(monto)){
			monto=0;
			$("#monto").val(0);
		}
		if (isNaN(creal)){
			creal=0;
			$("#creal").val(0);
		}
		if (isNaN(comision)){
			comision=0;
			$("#comision").val(0);
		}
		if (isNaN(comdespa)){
			comdespa=0;
			$("#comdespa").val(0);
		}

		$.ajax({
			data:  {
				"tipo":1,
				"monto":monto,
				"esquema":esquema,
				"esquema2":esquema2,
				"comision":comision,
				"creal":creal,
				"comdespa":comdespa,
				"function":"recalcular"
			},
			url:   "a_operaciones/db_operaciones.php",
			type:  'post',
			beforeSend: function () {
				$("#cargando").html("Calculando...");
			},
			success:  function (data) {
				$("#cargando").html("");
				var datos = JSON.parse(data);
				$("#subtotal").val(datos.subtotal);
				$("#iva").val(datos.iva);
				$("#tcomision").val(datos.tcomision);
				$("#retorno").val(datos.retorno);
				$("#pikito").val(datos.pikito);
				$("#tcomision_r").val(datos.tcomision_r);
				$("#retorno_r").val(datos.retorno_r);
				$("#comdespa_t").val(datos.comdespa_t);
				$("#comisionistas").val(datos.comisionistas);
				$("#comision").val(datos.comision);
				$("#creal").val(datos.creal);
			}
		});
	}
	function desgloce(){
		var monto=parseFloat($("#monto_fact").val());
		if (isNaN(monto)){
			monto=0;
			$("#monto_fact").val(0);
		}
		var subtotal=Math.round((monto/1.16)*100)/100;
		$("#subtotal_fact").val(subtotal);
		var iva=Math.round((subtotal*.16)*100)/100;
		$("#iva_fact").val(iva);
	}
	function seleccomision(xyId){
		var parametros={
			"idrazon":xyId,
			"function":"guarda_razon"
		};
		$.confirm({
			title: 'Cliente',
			content: '¿Desea seleccionar el cliente?',
			buttons: {
				Aceptar: function () {

					$.ajax({
						data:  parametros,
							url:   "a_operaciones/db_operaciones.php",
						type: "post",
						beforeSend: function () {

						},
						success:  function (response) {
							var datos = JSON.parse(response);
							$('#idrazon').html("<option value='"+datos.id+"'>"+datos.valor+"</option>");
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
		var parametros={
			"idempresa":xyId,
			"function":"guarda_empresa"
		};
		$.confirm({
			title: 'Despacho',
			content: '¿Desea seleccionar el despacho?',
			buttons: {
				Aceptar: function () {
					$.ajax({
						data:  parametros,
						url:   "a_operaciones/db_operaciones.php",
						type: "post",
						beforeSend: function () {

						},
						success:  function (response) {
							var datos = JSON.parse(response);
							$('#idempresa').html("<option value='"+datos.id+"'>"+datos.valor+"</option>");
							$('#comdespa').val(datos.comision);
							retornooper();
							$('#myModal').modal('hide');
						}
					});
				},
				Cancelar: function () {
				}
			}
		});

	}
	$(document).on('keyup','#producto',function(e){
		var e = window.event;
		var tecla = (document.all) ? e.keyCode : e.which;
		var valor=$(this).val();

		if(tecla!=37 && tecla!=38 && tecla!=39 && tecla!=40){
			if(valor.length>2){
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
	});
	$(document).on('click','#producto_auto tr',function(e){
		$('#producto').val($(this).find('td:first').html());
		$("#producto_auto").hide();
	});

	$(document).on('change','.retorno',function(e){
			e.preventDefault();
			e.stopPropagation();
			var xyId = $("#idproducto_selx").val();
			$.ajax({
				data:  {
					"idproducto":xyId,
					"function":"producto_tipo"
				},
				url:   "a_operaciones/db_operaciones.php",
				type:  'post',
				beforeSend: function () {

				},
				success:  function (response) {
					var datos = JSON.parse(response);
					$("#comision_ret").val(datos.pventa);
				}
			});
			retornoret();
		});

	function retornoret(){
		var gtotal=0;
		var monto=parseFloat($("#monto_ret").val());
		var com=parseInt($("#comision_ret").val());

		gtotal=(monto*com)/100;
		$("#tcomision_retcli").val(gtotal);
		retorno=monto-gtotal;
		$("#retorno_retcli").val(retorno);

		var creal=parseInt($("#creal_ret").val());
		if(creal>0){
			gtotal=(monto*creal)/100;
			$("#tcomision_retjg").val(gtotal);
			retorno=monto-gtotal;
			$("#retorno_retjg").val(retorno);
		}
		else{
			$("#tcomision_retjg").val(0);
			$("#retorno_retjg").val(0);
		}
	}
	function solicitud(){
		var id=$("#idfactura").val();
		$.ajax({
			data:  {
				"id":id,
				"tipo":"1",
				"file":"1"
			},
			url:   "a_operaciones/imprimir.php",
			type:  'post',
			beforeSend: function () {
				$("#archivo").html("Generando solicitud");
			},
			success:  function (response) {
				$("#archivo").html("<a href='"+response+"' target='_blank'><i class='far fa-file-pdf'></i>Archivo</a>");
				$("#file").val(response);
			}
		});
	}
	function solicitud_ret(){
		var id=$("#idretorno").val();
		$.ajax({
			data:  {
				"id":id,
				"tipo":"2",
				"file":"1"
			},
			url:   "a_operaciones/imprimir.php",
			type:  'post',
			beforeSend: function () {
				$("#archivo_ret").html("Generando solicitud");
			},
			success:  function (response) {
				$("#archivo_ret").html("<a href='"+response+"' target='_blank'><i class='far fa-file-pdf'></i>Archivo</a>");
				$("#file_ret").val(response);
			}
		});
	}
	function finalizar(){
		var id=$("#id").val();
		$.confirm({
			title: 'Finalizar',
			content: '¿Desea marcar como finalizada la operación?<br>Ya no se podrá modificar nada de la operación',
			buttons: {
				Aceptar: function () {
					$.ajax({
						data:  {
							"id":id,
							"function":"finalizar"
						},
						url:   "a_operaciones/db_operaciones.php",
						type:  'post',
						beforeSend: function () {

						},
						success:  function (response) {
							if (!isNaN(response)){
								Swal.fire({
								  type: 'success',
								  title: 'Operación finalizada',
								  showConfirmButton: false,
								  timer: 1000
								});
								$("#trabajo").load("a_operaciones/editar.php?id="+id);
							}
							else{
								Swal.fire({
								  type: 'error',
								  title: response,
								  showConfirmButton: false,
								  timer: 1000
								});
							}
						}
					});
				},
				Cancelar: function () {

				}
			}
		});
	}
	function despachosel(){
			var xyId = $("#iddespacho_xsel").val();
			$.ajax({
				data:  {
					"iddespacho":xyId,
					"function":"buscar_empresa"
				},
				url:   "a_operaciones/db_operaciones.php",
				type:  'post',
				beforeSend: function () {

				},
				success:  function (response) {
					$("#resultadosx").html(response);
				}
			});
	}
</script>
