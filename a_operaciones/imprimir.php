<?php
	require_once("db_operaciones.php");
	$id=$_REQUEST['id'];
	$tipo=$_REQUEST['tipo'];
	if (isset($_REQUEST['file'])){$file=$_REQUEST['file'];} else{ $file="0";}

	if($tipo==1){			/////////////////solicitud factura
		$row=$db->facturas_edit($id);
		$pers = $db->operacion_edit($id);
		$idrazon=$pers['idrazon'];
		$cli=$db->razon($idrazon);
		
    set_include_path('../librerias15/pdf2/src/'.PATH_SEPARATOR.get_include_path());
    include 'Cezpdf.php';
    $pdf = new Cezpdf('letter','portrait','color',array(255,255,255));
    $pdf->selectFont('../librerias15/fonts/Courier');
		$pdf->addPngFromFile("formato.png",27,0,555);
		$x=665;
		$pdf->addText(170,$x-=45,12,$cli['razon'],200,'left');
		$pdf->addText(170,$x-=20,12,"R.F.C.:",200,'left');
		$pdf->addText(170,$x-=20,12,"REGIMEN FISCAL:",200,'left');
		$pdf->addText(170,$x-=20,12,"USO FACTURA:",200,'left');
		$pdf->addText(170,$x-=20,12,"FECHA",200,'left');
		$pdf->addText(170,$x-=20,12,"CALLE",200,'left');
		$pdf->addText(170,$x-=20,12,"COLONIA",200,'left');
		$pdf->addText(350,500,12,"CODIGO",200,'right');
		$pdf->addText(170,$x-=20,12,"DELEGACION",200,'left');
		$pdf->addText(170,$x-=20,12,"CIUDAD",200,'left');
		$pdf->addText(170,$x-=20,12,"ESTADO",200,'left');
		$pdf->addText(170,$x-=47,12,"EMPRESA FACT",200,'left');
		$pdf->addText(170,$x-=20,12,"DEPOSITO",200,'left');
		$pdf->addText(390,373,12,"FORMA",200,'rigth');
		$pdf->addText(170,$x-=20,12,"FECHA2",200,'left');

		if($file==1){
			$documento_pdf = $pdf->ezOutput();
			$file='historial/'.$id.'_solfact.pdf';
			$fichero = fopen("../".$file,'wb');
			fwrite ($fichero, $documento_pdf);
			fclose ($fichero);
			echo $file;
		}
		else{
			$pdf->ezStream();
		}

	}
	if($tipo==2){			/////////////////formato retorno



	}
?>
