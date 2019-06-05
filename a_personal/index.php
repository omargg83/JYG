<?php
	require_once("db_personal.php");
	$personal = new Personal();	
	echo "<nav class='navbar navbar-expand-lg navbar-light bg-light '>
	
	<a class='navbar-brand' ><i class='fas fa-user-shield'></i> Personal</a>	
	
	  <button class='navbar-toggler navbar-toggler-right' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='principal' aria-expanded='false' aria-label='Toggle navigation'>
		<span class='navbar-toggler-icon'></span>
	  </button>
		  <div class='collapse navbar-collapse' id='navbarSupportedContent'>
			<ul class='navbar-nav mr-auto'>";
			echo"<li class='nav-item active'><a class='nav-link barranav' title='Mostrar todo' id='lista_comision' data-lugar='a_personal/lista'><i class='fas fa-list-ul'></i><span>Lista</span></a></li>";
			
			if($personal->nivel_personal==0 or $personal->nivel_personal==11 or $personal->nivel_personal==1 or $personal->nivel_personal==2 or $personal->nivel_personal==3 or $personal->nivel_personal==4 or $personal->nivel_personal==10){
				echo"<li class='nav-item active'><a class='nav-link barranav izq' title='Nuevo' id='new_personal' data-lugar='a_personal/editar'><i class='fas fa-plus'></i><span>Nuevo</span></a></li>";
	
			}
			
			
			echo "</ul>";

			
		echo "
	  </div>
	</nav>";
	echo "<div id='trabajo'>";
		include 'lista.php';	
	echo "</div>";
?>	
<script type="text/javascript">
	$(function(){
		$(document).on('click','#cambiar',function(e){
			e.preventDefault();
			var xyId= $("#id").val();

			var parametros={
				"function":"cambiar_user",
				"id": xyId
			};
			
			$.ajax({
				data:  parametros,
				url: "a_personal/personal_db.php",
				type: "post",
				beforeSend: function () {
						
				},
				success:  function (response) {
					if (!isNaN(response)){
						Swal.fire({
						  type: 'success',
						  title: "Se guardó correctamente",
						  showConfirmButton: false,
						  timer: 1000
						});
						window.location.replace("");
					}
					else{
						$.alert(response);
					}
				}
			});
		});
		$(document).on('click','#dar_baja',function(e){
			e.preventDefault();
			var xyId= $("#id").val();
			$.confirm({
				title: 'Guardar',
				content: '¿Desea dar de baja al usuario?',
				buttons: {
					Aceptar: function () {
						////////////////////////
						var parametros={
							"function":"baja",
							"id": xyId
						};
						
						$.ajax({
							data:  parametros,
							url: "a_personal/personal_db.php",
							type: "post",
							beforeSend: function () {
									
							},
							success:  function (response) {
								if (!isNaN(response)){
									Swal.fire({
									  type: 'success',
									  title: "Se dio de baja correctamente",
									  showConfirmButton: false,
									  timer: 1000
									});
								}
								else{
									$.alert(response);
								}
							}
						});
						////////////////////////
					},
					Cancelar: function () {
						$.alert('Canceled!');
					}
				}
			});	
		});
		$(document).on('click','#agregar_permiso',function(e){
			e.preventDefault();
			var xyId= $("#id").val();
			var aplicacion= $("#aplicacion").val();
			var acceso= $("#acceso").val();
			var captura= $("#captura").val();
			var nivelx= $("#nivelx").val();
			
			console.log(captura);
			
			var parametros={
				"function":"permisos",
				"aplicacion":aplicacion,
				"acceso":acceso,
				"captura":captura,
				"nivelx":nivelx,
				"id": xyId
			};
			
			$.ajax({
				data:  parametros,
				url: "a_personal/personal_db.php",
				type: "post",
				beforeSend: function () {
						
				},
				success:  function (response) {
					if (!isNaN(response)){
						Swal.fire({
						  type: 'success',
						  title: "Se guardó correctamente",
						  showConfirmButton: false,
						  timer: 1000
						});
						$("#permisos").load("a_personal/form_permisos.php?id="+xyId);
					}
					else{
						$.alert(response);
					}
				}
			});
		});
		$(document).on('change','#aplicacion_per',function(e){
			e.preventDefault();
			var aplicacion_per= $("#aplicacion_per").val();
			$("#permisos").load("a_personal/lista_permisodetalle.php?id="+aplicacion_per);
		});
	});
</script>
	
	