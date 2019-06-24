<?php
	require_once("db_operaciones.php");
	$id=$_REQUEST['id'];


	//$row = $comision->comision_imprime($idcomision);

	if($tipo==1){			/////////////////solicitud factura
		$row=$db->facturas_edit($id);

    set_include_path('../librerias15/pdf2/src/'.PATH_SEPARATOR.get_include_path());
    include 'Cezpdf.php';
    $pdf = new Cezpdf('letter','portrait','color',array(255,255,255));
    $pdf->selectFont('../librerias15/fonts/Courier');
		//$pdf->addJpegFromFile("../img/ssh.jpg",56,528,70);

		$pdf->addPngFromFile("formato.png",27,0,555);
		$pdf->addText(0,730,16,"<b>FORMATO DE SOLICITUD DE FACTURA</b>",600,'center');

		$x=665;
		$pdf->addText(40,$x-=15,12,"RAZON SOCIAL:",200,'left');
		$pdf->addText(40,$x-=15,12,"R.F.C.:",200,'left');
		$pdf->addText(40,$x-=15,12,"REGIMEN FISCAL:",200,'left');

/*
		$pdf->addJpegFromFile("../img/ssh.jpg",56,528,70);
		$pdf->addJpegFromFile("../img/gobierno.jpg",360,540,85);
		$pdf->addJpegFromFile("../img/escudo.jpg",678,525,70);
		$pdf->ezSetMargins(150,20,40,40);

		$pdf->addText(0,510,12,"<b>SERVICIOS DE SALUD DE HIDALGO</b>",800,'center');
		$pdf->addText(0,495,12,"<b>FORMATO ÚNICO DE COMISIÓN</b>",800,'center');
		$pdf->addText(0,480,12,"<b>INFORME NARRATIVO</b>",800,'center');

		$pdf->addText(150,450,12,"Mes: ".$mes." - ".$año,100,'left');

		$pdf->addText(650,450,12,"Folio: ".$row['numero'],100,'left');
		$pdf->ezText("",12);
		$pdf->ezText("",12);

		$i=0;
		$total=0;
		if(count($pd)>1){

			for($i=0;$i<count($pd);$i++){
				$data[$i]=array('fecha'=>$pd[$i]["fecha"],'lugar'=>$pd[$i]["lugar"],'lugar2'=>$pd[$i]["destino"],'medio'=>$pd[$i]['medio'],'monto'=>moneda($pd[$i]['monto']));
				$total+=$pd[$i]['monto'];
			}
			$data[$i]=array('fecha'=>"",'lugar'=>"",'lugar2'=>"",'medio'=>"TOTAL",'monto'=>moneda($total));

			$cols1 = array('fecha'=>'FECHA',
					'lugar'=>'LUGAR DE SALIDA',
					'lugar2'=>'LUGAR DE DESTINO',
					'medio'=>'MEDIO DE TRANSPORTE',
					'monto'=>'IMPORTE');

			$pdf->ezTable($data,$cols1,"",array('xPos'=>'left','rowGrap'=>55,'shadeHeadingCol'=>array(0.7,0.7,0.7),'xOrientation'=>'right','width'=>780,'shaded'=>0,'showHeadings'=>1,'gridlines'=>31,'innerLineThickness' => 0.5,'outerLineThickness' =>0.5,'cols'=>array(
			'fecha'=>array('width'=>80,'justification'=>'center'),
			'lugar'=>array('width'=>190,'justification'=>'center'),
			'lugar2'=>array('width'=>190,'justification'=>'center'),
			'medio'=>array('width'=>150,'justification'=>'center'),
			'monto'=>array('width'=>100,'justification'=>'center')
			),'fontSize' => 10));
		}
		$pdf->addText(100,150,10,"Vo. Bo.",200,'center');
		$pdf->addText(500,150,10,"COMISIONADO",200,'center');

		$pdf->addText(100,100,12,"_______________________________________",200,'center');
		$pdf->addText(500,100,12,"_______________________________________",200,'center');
		$pdf->addText(100,80,10,"$vobox",200,'center');
		$pdf->addText(500,80,10,"$nombre",200,'center');

		$a=$pdf->addText(100,70,10,$vobo['cargo'],200,'center');
		$a=$pdf->addText(100,60,9,$a,200,'center');
		$a=$pdf->addText(100,50,9,$a,200,'center');
*/
		$pdf->ezStream();
	}

?>
