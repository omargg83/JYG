<?php
	require_once("db_.php");
	echo "<nav class='navbar navbar-expand-lg navbar-light bg-light '>

	  <button class='navbar-toggler navbar-toggler-right' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='principal' aria-expanded='false' aria-label='Toggle navigation'>
		<span class='navbar-toggler-icon'></span>
	  </button>
		  <div class='collapse navbar-collapse' id='navbarSupportedContent'>
			<ul class='navbar-nav mr-auto'>";
			echo"<li class='nav-item active'><a class='nav-link barranav' title='Mostrar todo' id='lista_reporte1' data-lugar='a_reportes/1_reporte'><i class='fas fa-list-ul'></i><span>Operaciones</span></a></li>";
			echo"<li class='nav-item active'><a class='nav-link barranav' title='Mostrar todo' id='lista_reporte2' data-lugar='a_reportes/2_reporte'><i class='fas fa-list-ul'></i><span>Facturas</span></a></li>";
			echo"<li class='nav-item active'><a class='nav-link barranav' title='Mostrar todo' id='lista_reporte3' data-lugar='a_reportes/3_reporte'><i class='fas fa-list-ul'></i><span>Retornos</span></a></li>";
			echo"<li class='nav-item active'><a class='nav-link barranav' title='Mostrar todo' id='lista_reporte4' data-lugar='a_reportes/4_reporte'><i class='fas fa-list-ul'></i><span>Comisionistas</span></a></li>";
			echo "</ul>";
		echo "
	  </div>
	</nav>";

	echo "<div id='trabajo'>";



	echo "</div>";
?>
