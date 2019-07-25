<?php
	require_once("../control_db.php");
	if (isset($_REQUEST['function'])){$function=$_REQUEST['function'];}	else{ $function="";}


	if(strlen($function)>0){
		echo $function();
	}

	function reporte1(){
		$sagyc = new Sagyc();
		$sql="SELECT day(fecha) as dia, sum(monto) as total FROM sagyce18_bbco.operaciones group by day(fecha);";
		$response=$sagyc->general($sql);
		$arreglo=array();
		for($i=0;$i<count($response);$i++){
			$arreglo[$i]=array('nombre'=>$response[$i]['dia'], 'total'=>$response[$i]['total']);
		}
		echo json_encode($arreglo);
	}





?>
