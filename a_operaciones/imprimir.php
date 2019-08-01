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
		$pdf->addPngFromFile("formato2.png",27,0,555);
		$x=665;
		$pdf->addText(170,$x-=45,12,$cli['razon'],200,'left');
		$pdf->addText(170,$x-=20,12,$cli['rfc'],200,'left');
		$pdf->addText(170,$x-=20,12,"REGIMEN FISCAL:",200,'left');
		$pdf->addText(170,$x-=20,12,$row['uso'],200,'left');
		$pdf->addText(170,$x-=20,12,$row['fecha'],200,'left');
		$pdf->addText(170,$x-=20,12,$cli['domicilio'],200,'left');
		$pdf->addText(170,$x-=20,12,$cli['colonia'],200,'left');
		$pdf->addText(350,500,12,$cli['cp'],200,'right');
		$pdf->addText(170,$x-=20,12,$cli['municipio'],200,'left');
		$pdf->addText(170,$x-=20,12,$cli['ciudad'],200,'left');
		$pdf->addText(170,$x-=20,12,$cli['estado'],200,'left');
		/*$pdf->addText(170,$x-=47,12,$empresa['razon'],200,'left');*/
		$pdf->addText(170,373,12,$row['monto'],200,'left');
		$pdf->addText(390,373,12,$row['forma'],200,'left');
		$pdf->addText(170,353,12,$row['fecha'],200,'left');

		$pdf->addText(170,250,12,$row['producto'],200,'left');
		$pdf->addText(170,200,12,$row['descripcion'],200,'left');

		$pdf->addText(505,140,12,$row['subtotal'],200,'left');
		$pdf->addText(505,120,12,$row['iva'],200,'left');
		$pdf->addText(505,100,12,$row['monto'],200,'left');
		////////////////////////////////esto genera el archivo o para adjuntarlo en mail
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
		//////////////////////////////aqui poner lo de retorno men
		set_include_path('../librerias15/pdf2/src/'.PATH_SEPARATOR.get_include_path());
    include 'Cezpdf.php';
    $pdf = new Cezpdf('letter','portrait','color',array(255,255,255));
    $pdf->selectFont('../librerias15/fonts/Courier');


		$pers = $db->operacion_edit($id);
		$despa=$db->empresa_despacho($idempresa);
		$prod=$db->producto_despacho($iddespacho);
		$row=$db->retorno_edit($id);
		$idrazon=$pers['idrazon'];
		$cli=$db->razon($idrazon);

		//////////////////////tu magia va aqui


		$x=665;
		$pdf->addText(115,620,12,"BENEFICIARIO:",200,'left');
		$pdf->addText(210,$x-=45,12,$row['persona'],200,'left');
		$pdf->addText(115,600,12,"RFC:",200,'left');
		$pdf->addText(170,$x-=20,12,$cli['rfc'],200,'left');
		$pdf->addText(115,580,12,"CURP:",200,'left');
		$pdf->addText(170,$x-=20,12,"CURP",200,'left');
		$pdf->addText(115,560,12,"TIPO:",200,'left');
		$pdf->addText(170,$x-=20,12,$val['producto'],200,'left');
		/*$pdf->addText(170,$x-=20,12,"BANCO",200,'left');*/
		$pdf->addText(115,540,12,"MONTO:",200,'left');
		$pdf->addText(170,$x-=20,12,$row['monto'],200,'left');

		///////hasta aca
		////////////////////////////////esto genera el archivo o para adjuntarlo en mail
		if($file==1){
			$documento_pdf = $pdf->ezOutput();
			$file='historial/'.$id.'_forretorno.pdf';
			$fichero = fopen("../".$file,'wb');
			fwrite ($fichero, $documento_pdf);
			fclose ($fichero);
			echo $file;
		}
		else{
			$pdf->ezStream();
		}


	}
?>
