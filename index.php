<?php
	session_start();
    if(isset($_SESSION['idpersona']) and $_SESSION['autoriza'] == 1) {
		include "_ses.php";
		require_once("control_db.php");
		$bdd = new Sagyc();
    } else {
		include('acceso/login.php');
		die();
	};

?>
<!DOCTYPE HTML>
<html lang="es">
<head>
	<title>J&G</title>
	<link rel="icon" type="image/png" href="img/favicon.ico">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<meta http-equiv="Expires" content="0">
	<meta http-equiv="Last-Modified" content="0">
	<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
	<meta http-equiv="Pragma" content="no-cache">
	
	<link rel="stylesheet" href="librerias15/load/dist/css-loader.css">
</head>
<body>
<!--Main Header-->

<nav class="navbar navbar-expand-md navbar-dark bg-dark nav-principal">
      <a class="navbar-brand" href="#">J&G</a>
      <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarsExample06" aria-controls="navbarsExample06" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <img src='img/logo.png' width='40' height='30' alt=''>

      <div class="navbar-collapse collapse" id="navbarsExample06" style="">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href='#escritorio/dashboard'>Inicio <span class="sr-only">(current)</span></a>
          </li>

           <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="" id="dropdown06" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Catálogos</a>
            <div class="dropdown-menu" aria-labelledby="dropdown06">
              <a class="dropdown-item" href="#a_prospectos/index"><i class="fas fa-street-view"></i>Prospectos</a>
              <a class="dropdown-item" href="#a_clientes/index"><i class="fas fa-user-check"></i>Clientes</a>
              <hr>
              <a class="dropdown-item" href="#a_despachos/index"><i class="fas fa-store-alt"></i>Despachos</a>
              <a class="dropdown-item" href="#a_empresas/index"><i class="far fa-building"></i>Empresas</a>
            </div>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="" id="dropdown06" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Productos</a>
            <div class="dropdown-menu" aria-labelledby="dropdown06">
            <!--  <a class="dropdown-item" href="#a_productostipo/index"><i class='fas fa-people-carry'></i>Tipo de productos</a> -->
              <a class="dropdown-item" href="#a_productos/index"><i class="fas fa-archive"></i>Consulta y alta de Productos</a>
            </div>
          </li>

           <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="" id="dropdown06" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Operaciones</a>
            <div class="dropdown-menu" aria-labelledby="dropdown06">
              <a class="dropdown-item" href="#a_operaciones/index"><i class="fas fa-hand-holding-usd"></i>Operaciones</a>
            </div>
          </li>
         

           <li class="nav-item active">
            <a class="nav-link" href="#a_personal/index"><i class="fas fa-user-shield"></i></i>Usuarios</a>
          </li>
        </ul>

		
		<ul class="nav navbar-nav navbar-right" id="chatx"></ul>
		<ul class="nav navbar-nav navbar-right" id="fondo"></ul>
		

        <ul class='nav navbar-nav navbar-right'>
				<li class="nav-item">
					<a class="nav-link pull-left" href="acceso/salir.php">
						<i class="fas fa-door-open" style="color:red;"></i>Salir
					</a>
				</li>
			</ul>
      </div>
</nav>

<div class="fijaproceso main animated slideInDown delay-2s" id='contenido'>
					
</div>
	
<div class="loader loader-default is-active" id='cargando' data-text="Cargando">
</div>


<div class="modal animated fadeIn delay-2s" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog modal-lg" role="document">
	<div class="modal-content" id='modal_form' style='max-height:580px;overflow: auto;'>
		  
	</div>
  </div>
</div>
	
	
	
<div id="myModal" class="modal">

  <!-- The Close Button -->
  <span class="close">&times;</span>

  <!-- Modal Content (The Image) -->
  <img class="modal-content" id="img01">

  <!-- Modal Caption (Image Text) -->
  <div id="caption"></div>
</div>

</body>
	<!--   Core JS Files   -->
	<script src="librerias15/jquery-3.3.1.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="librerias15/loader.js"></script>
	
	<!--   url   -->
	<script src="librerias15/jquery/jquery-ui.js"></script>
	
	<!--   Tablas  -->
	<script type="text/javascript" src="librerias15/DataTables/datatables.js"></script>
	<script type="text/javascript" src="librerias15/DataTables/DataTables-1.10.18/js/dataTables.bootstrap4.min.js"></script>
	
	<link rel="stylesheet" type="text/css" href="librerias15/DataTables/datatables.min.css"/>
	<link rel="stylesheet" type="text/css" href="librerias15/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.css"/>
	
	<!-- Animation library for notifications   -->
    <link href="librerias15/animate.min.css" rel="stylesheet"/>
	
	<!--   Alertas   -->
	<script src="librerias15/swal/dist/sweetalert2.min.js"></script>
	<link rel="stylesheet" href="librerias15/swal/dist/sweetalert2.min.css">
	
	<!--   para imprimir   -->
	<script src="librerias15/VentanaCentrada.js" type="text/javascript"></script>
	
	<!--   Cuadros de confirmación y dialogo   -->
	<link rel="stylesheet" href="librerias15/jqueryconfirm/css/jquery-confirm.css">
	<script src="librerias15/jqueryconfirm/js/jquery-confirm.js"></script>
	
	<!--   iconos   -->
	<link rel="stylesheet" href="librerias15/fontawesome-free-5.8.1-web/css/all.css">
	<link rel="stylesheet" href="librerias15/jquery/jquery-ui-1.10.0.custom.css" />
	
	<script src="chat/chat.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="chat/chat.css"/>
	
	<!--   carrusel de imagenes   -->
	<link rel="stylesheet" href="librerias15/baguetteBox.js-dev/baguetteBox.css">
	<script src="librerias15/baguetteBox.js-dev/baguetteBox.js" async></script>
	<script src="librerias15/baguetteBox.js-dev/highlight.min.js" async></script>
	
	<script src="librerias15/popper.js"></script>
	<script src="librerias15/tooltip.js"></script>
	
	<!--   Boostrap   -->
	<link rel="stylesheet" href="librerias15/css/bootstrap.min.css">
	<script src="librerias15/js/bootstrap.js"></script>
	
	<!--   Propios   -->
	<script src="sagyc.js"></script>
	<link rel="stylesheet" type="text/css" href="librerias15/modulos.css"/>
	
	<script src="librerias15/chartjs/Chart.js"></script>
	<link href='librerias15/fullcalendar-4.0.1/packages/core/main.css' rel='stylesheet' />
	<link href='librerias15/fullcalendar-4.0.1/packages/daygrid/main.css' rel='stylesheet' />
	<script src='librerias15/fullcalendar-4.0.1/packages/core/main.js'></script>
	<script src='librerias15/fullcalendar-4.0.1/packages/interaction/main.js'></script>
	<script src='librerias15/fullcalendar-4.0.1/packages/daygrid/main.js'></script>
	
</html>
