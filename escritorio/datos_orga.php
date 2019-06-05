<?php 
	require_once("../control_db.php");
	if (isset($_REQUEST['function'])){$function=$_REQUEST['function'];}	else{ $function="";}
	
	
	if(strlen($function)>0){
		echo $function();
	}
	function correspondencia(){
		$salud = new Salud();
		$sql="SELECT personal.nombre, count(idpersturna) as total FROM YOFICIOSP 
		left outer join personal on personal.idpersona=yoficiosp.idpersturna WHERE  CONTESTO=0 GROUP BY IDPERSTURNA order by total desc";
		$response=$salud->general($sql);
		$arreglo=array();
		for($i=0;$i<count($response);$i++){
			$arreglo[$i]=array('nombre'=>$response[$i]['nombre'], 'total'=>$response[$i]['total']);
		}
		echo json_encode($arreglo);
	}
	
	function comision(){
		$salud = new Salud();
		
		$sql="SELECT area, count(idcomision) as total  FROM zofcomision 
		left outer join personal on personal.idpersona=zofcomision.idpersona
		left outer join area on area.idarea=personal.idarea
		where personal.idarea<100 and year(del)='".$_SESSION['anio']."'
		group by personal.idarea order by total desc";
		$response=$salud->general($sql);
		$arreglo=array();
		for($i=0;$i<count($response);$i++){
			$arreglo[$i]=array('nombre'=>$response[$i]['area'], 'total'=>$response[$i]['total']);
		}
		echo json_encode($arreglo);
	}
	
	function comite(){
		$salud = new Salud();
		$sql="select nombre,count(con_fechas.fecha) as total from con_fechas 
		left outer join con_reunion on con_reunion.idreunion=con_fechas.idreunion
		left outer join con_comite on con_comite.idcomite=con_reunion.idcomite
		where anio='".$_SESSION['anio']."' group by con_reunion.idreunion order by total desc";

		$response=$salud->general($sql);
		$arreglo=array();
		for($i=0;$i<count($response);$i++){
			$arreglo[$i]=array('nombre'=>$response[$i]['nombre'], 'total'=>$response[$i]['total']);
		}
		echo json_encode($arreglo);
	}
	function personal(){
		$salud = new Salud();
		$fecha=date("Y-m-d");
		$nuevafecha = strtotime ( '-2 month' , strtotime ( $fecha ) ) ;
		$fecha = date ( "Y-m-d" , $nuevafecha );
		$sql="select titulo,count(personal.idpersona) as total, sum(if(personal.fecha>='".$fecha."',1,0)) as validados from personal 
		left outer join area on area.idarea=personal.idarea
		where  personal.idarea<100 group by personal.idarea order by area.idarea";

		$response=$salud->general($sql);
		$arreglo=array();
		for($i=0;$i<count($response);$i++){
			$arreglo[$i]=array('nombre'=>$response[$i]['titulo'], 'total'=>$response[$i]['total'], 'validado'=>$response[$i]['validados']);
		}
		echo json_encode($arreglo);
	}
?>