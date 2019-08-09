<?php
	require_once("../control_db.php");
	if (isset($_REQUEST['function'])){$function=$_REQUEST['function'];}	else{ $function="";}


	if(strlen($function)>0){
		echo $function();
	}

	function reporte1(){
		$sagyc = new Sagyc();
		$sql="SELECT month(fecha) as mes, sum(monto) as total FROM operaciones where year(fecha)=year(now()) group by month(fecha);";
		$response=$sagyc->general($sql);
		$arreglo=array();
		for($i=0;$i<count($response);$i++){
			$arreglo[$i]=array('mes'=>$response[$i]['mes'], 'total'=>$response[$i]['total']);
		}
		echo json_encode($arreglo);
	}

	function reporte2(){
		$sagyc = new Sagyc();
		$sql="SELECT month(fecha) as mes, sum(monto) as total FROM facturas where year(fecha)=year(now()) group by month(fecha);";
		$response=$sagyc->general($sql);
		$arreglo=array();
		for($i=0;$i<count($response);$i++){
			$arreglo[$i]=array('mes'=>$response[$i]['mes'], 'total'=>$response[$i]['total']);
		}
		echo json_encode($arreglo);
	}

	function reporte3(){
		$sagyc = new Sagyc();
		$sql="SELECT month(fecha) as mes, sum(monto) as total FROM retorno where year(fecha)=year(now()) group by month(fecha);";
		$response=$sagyc->general($sql);
		$arreglo=array();
		for($i=0;$i<count($response);$i++){
			$arreglo[$i]=array('mes'=>$response[$i]['mes'], 'total'=>$response[$i]['total']);
		}
		echo json_encode($arreglo);
	}

	function reporte4(){
		$sagyc = new Sagyc();
		$sql="SELECT mes as mes, sum(meta) as total FROM meta_factura where anio=year(now()) group by mes;";
		$response=$sagyc->general($sql);
		$arreglo=array();
		for($i=0;$i<count($response);$i++){
			$arreglo[$i]=array('mes'=>$response[$i]['mes'], 'total'=>$response[$i]['total']);
		}
		echo json_encode($arreglo);
	}







?>
