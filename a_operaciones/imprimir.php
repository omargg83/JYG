<?php
	require_once("db_operaciones.php");
	$id=$_REQUEST['id'];
	$tipo=$_REQUEST['tipo'];
	if (isset($_REQUEST['file'])){$file=$_REQUEST['file'];} else{ $file="0";}

	if($tipo==1){			/////////////////solicitud factura
		$row=$db->facturas_edit($id);
		$id_oper=$row['idoperacion'];
		$pers = $db->operacion_edit($id_oper);
		$idrazon=$pers['idrazon'];
		$cli=$db->razon($idrazon);

    set_include_path('../librerias15/pdf2/src/'.PATH_SEPARATOR.get_include_path());
    include 'Cezpdf.php';
    $pdf = new Cezpdf('letter','portrait','color',array(255,255,255));
    $pdf->selectFont('../librerias15/fonts/Courier');
		//$pdf->addPngFromFile("formato2.png",27,0,555); #error
		$x=665;
		$pdf->addText(200,680,12,"---SOLICITUD DE FACTURA---",200,'left');

		$pdf->addText(60,620,12,"Razón Social:",200,'left');
		$pdf->addText(170,$x-=45,12,$cli['razon'],800,'left');
		$pdf->addText(60,600,12,"Rfc:",200,'left');
		$pdf->addText(170,$x-=20,12,$cli['rfcrazon'],250,'left');
		$pdf->addText(60,$x-=20,12,"DATOS DE FACTURA:",200,'left');
		$pdf->addText(60,560,12,"Uso factura:",200,'left');
		$pdf->addText(170,$x-=20,12,$row['uso'],400,'left');
		$pdf->addText(60,540,12,"Fecha factura:",200,'left');
		$pdf->addText(170,$x-=20,12,$row['fecha'],200,'left');
		$pdf->addText(60,520,12,"Calle y No.:",200,'left');
		$pdf->addText(170,$x-=20,12,$cli['domicilio'],600,'left');
		$pdf->addText(60,500,12,"Colonia:",200,'left');
		$pdf->addText(170,$x-=20,12,$cli['colonia'],400,'left');
		$pdf->addText(480,500,12,"Cp:",200,'left');
		$pdf->addText(350,500,12,$cli['cp'],200,'right');
		$pdf->addText(60,480,12,"Del. o Mun.:",200,'left');
		$pdf->addText(170,$x-=20,12,$cli['municipio'],300,'left');
		$pdf->addText(60,460,12,"Ciudad:",200,'left');
		$pdf->addText(170,$x-=20,12,$cli['ciudad'],200,'left');
		$pdf->addText(60,440,12,"Estado:",200,'left');
		$pdf->addText(170,$x-=20,12,$cli['estado'],200,'left');
		//$pdf->addText(170,$x-=47,12,$empresa['razon'],200,'left');
		$pdf->addText(60,400,12,"Monto:",200,'left');
		$pdf->addText(170,400,12,$row['monto'],200,'left');
		$pdf->addText(280,400,12,"Forma de pago:",300,'left');
		$pdf->addText(390,400,12,$row['forma'],400,'left');
		$pdf->addText(60,380,12,"Fecha:",200,'left');
		$pdf->addText(170,380,12,$row['fecha'],200,'left');

		$pdf->addText(60,360,12,"Metodo de pago:",200,'left');
		$pdf->addText(170,360,12,$row['metodo'],400,'left');

		$pdf->addText(60,320,12,"Clave Sat:",200,'left');
		$pdf->addText(170,320,12,$row['producto'],400,'left');
		$pdf->addText(60,300,12,"Descripción:",200,'left');
		$pdf->addText(170,300,12,$row['descripcion'],600,'left');

		$pdf->addText(60,280,12,"Unidad:",200,'left');
		$pdf->addText(170,280,12,$row['unidad'],600,'left');

		$pdf->addText(430,240,12,"Sub-Total",200,'left');
		$pdf->addText(505,240,12,$row['subtotal'],200,'left');
		$pdf->addText(430,220,12,"Iva",200,'left');
		$pdf->addText(505,220,12,$row['iva'],200,'left');
		$pdf->addText(430,200,12,"Total",200,'left');
		$pdf->addText(505,200,12,$row['monto'],200,'left');

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

		$row=$db->retorno_edit($id);
		$id_oper=$row['idoperacion'];
		$id_prod=$row['idproducto'];


		$pers = $db->operacion_edit($id_oper);
		$idrazon=$pers['idrazon'];
		$idempresa=$pers['idempresa'];

		$despa=$db->empresa_despacho($idempresa);

		$pers2 = $db->producto_edit($id_prod);
		$producto=$pers2['producto'];

		$idrazon=$pers['idrazon'];
		$cli=$db->razon($idrazon);

		//////////////////////tu magia va aqui


		$x=665;
		$pdf->addText(115,620,12,"BENEFICIARIO:",200,'left');
		$pdf->addText(210,$x-=45,12,$row['persona'],600,'left');
		$pdf->addText(115,600,12,"MONTO:",200,'left');
		$pdf->addText(170,600,12,$row['monto'],300,'left');
		$pdf->addText(115,580,12,"TIPO DE RETORNO:",200,'left');
		$pdf->addText(240,580,12,$pers2['producto'],300,'left');

		$pdf->addText(115,560,12,"FECHA:",200,'left');
		$pdf->addText(170,560,12,$row['fecha'],200,'left');

		$pdf->addText(115,540,12,"FOLIO:",200,'left');
		$pdf->addText(170,540,12,$row['folio'],200,'left');

		$pdf->addText(115,520,12,"EMPRESA QUE EMITE:",200,'left');
		$pdf->addText(250,520,12,$row['empresa'],300,'left');

		$pdf->addText(115,500,12,"LUGAR DE ENTREGA:",00,'left');
		$pdf->addText(250,500,12,$row['lugar'],400,'left');

		$pdf->addText(115,460,12,"NO. CUENTA / CLABE:",00,'left');
		$pdf->addText(270,460,12,$row['cuenta'],400,'left');
		$pdf->addText(115,440,12,"BANCO:",00,'left');
		$pdf->addText(270,440,12,$row['banco'],400,'left');

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
