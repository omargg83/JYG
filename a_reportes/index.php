<?php
	require_once("db_.php");
	echo "<nav class='navbar navbar-expand-lg navbar-light bg-light '>
	<a class='navbar-brand' ><i class='fas fa-street-view'></i> Consultas</a>
	  <button class='navbar-toggler navbar-toggler-right' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='principal' aria-expanded='false' aria-label='Toggle navigation'>
		<span class='navbar-toggler-icon'></span>
	  </button>
		  <div class='collapse navbar-collapse' id='navbarSupportedContent'>
			<ul class='navbar-nav mr-auto'>";
			echo"<li class='nav-item active'><a class='nav-link barranav' title='Mostrar todo' id='lista_comision' data-lugar='a_reportes/reporte1'><i class='fas fa-list-ul'></i><span>Operaciones</span></a></li>";
			echo "</ul>";
		echo "
	  </div>
	</nav>";

	echo "<div id='trabajo'>";
	//	include 'lista.php';
	echo "</div>";
?>
