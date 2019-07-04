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
		if (isNaN(monto)){
			monto=0;
			$("#monto").val(0);
		}
		var subtotal=Math.round((monto/1.16)*100)/100;
		$("#subtotal").val(subtotal);
		var iva=Math.round((subtotal*.16)*100)/100;
		$("#iva").val(iva);

		var esquema=$("#esquema").val();
		var esquema2=$("#esquema2").val();
		var com=parseFloat($("#comision").val());
		var creal=parseFloat($("#creal").val());
		var comdespa=$("#comdespa").val();
		var gtotal=0;
		var retorno=0;
		var gtotal_r=0;
		var retorno_r=0;


		if(esquema==1){
			gtotal=(monto*com)/100;
		}
		if(esquema==2){
			gtotal=(subtotal*com)/100;
		}
		if(esquema==3){
			gtotal=iva+((monto*com)/100);
		}
		if(esquema==4){
			gtotal=iva+((subtotal*com)/100);
		}
		if(esquema==5){
			gtotal=0;
			retorno=0;
			$("#comision").val(0);
			$("#creal").val(0);
		}

		if(esquema2==1){
			gtotal_r=(monto*creal)/100;
		}
		if(esquema2==2){
			gtotal_r=(subtotal*creal)/100;
		}
		if(esquema2==3){
			gtotal_r=iva+((monto*creal)/100);
		}
		if(esquema2==4){
			gtotal_r=iva+((subtotal*creal)/100);
		}

		retorno=monto-gtotal;
		retorno_r=monto-gtotal_r;
		var pikito=gtotal_r-gtotal;
		$("#pikito").val(pikito.toFixed(2));

		$("#tcomision").val(gtotal.toFixed(2));
		$("#retorno").val(retorno.toFixed(2));

		$("#tcomision_r").val(gtotal_r.toFixed(2));
		$("#retorno_r").val(retorno_r.toFixed(2));

		var comdesp=(gtotal*comdespa)/100;
		$("#comdespa_t").val(comdesp.toFixed(2));

		var tmp=(gtotal-comdesp)+pikito;
		$("#comisionistas").val(tmp.toFixed(2));
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
							$('#myModal').modal('hide');
						}
					});
				},
				Cancelar: function () {
				}
			}
		});
	}
	$(document).on('keyup','#uso',function(e){
		var e = window.event;
		var tecla = (document.all) ? e.keyCode : e.which;
		var valor=$(this).val();

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
	});
	$(document).on('click','#uso_auto tr',function(e){
			$('#uso').val($(this).find('td:first').html());
			$("#uso_auto").hide();
		});

	$(document).on('keyup','#forma',function(e){
		var e = window.event;
		var tecla = (document.all) ? e.keyCode : e.which;
		var valor=$(this).val();
		if(tecla!=37 && tecla!=38 && tecla!=39 && tecla!=40){
			if(valor.length>2){
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
	});
	$(document).on('click','#forma_auto tr',function(e){
		$('#forma').val($(this).find('td:first').html());
		$("#forma_auto").hide();
	});

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
					$("#comision_r").val(datos.pventa);
				}
			});
			retornoret();
		});
	function retornoret(){
			var monto=parseFloat($("#monto_r").val());
			var com=parseInt($("#comision_r").val());
			var gtotal=0;

			var creal=parseInt($("#creal_r").val());
			if(creal>0){
				com=creal;
			}
			gtotal=(monto*com)/100;
			$("#tcomision_r").val(gtotal);
			retorno=monto-gtotal;
			$("#retorno_r").val(retorno);
		}
</script>
