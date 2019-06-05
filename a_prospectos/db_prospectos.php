<?php
require_once("../control_db.php");
if (isset($_REQUEST['function'])){$function=$_REQUEST['function'];}	else{ $function="";}
	
class Prospectos extends Sagyc{
	public $nivel_personal;
	public $nivel_captura;
	
	public function __construct(){
		parent::__construct();
		$this->doc="a_prospectos/papeles/";

		if(isset($_SESSION['idpersona']) and $_SESSION['autoriza'] == 1) {
			
		}
		else{
			include "../error.php";
			die();
		}
	}
	public function prospecto(){
		try{
			parent::set_names();
			$sql="SELECT * FROM clientes where prospecto=1";
			$sth = $this->dbh->prepare($sql);
			$sth->execute();
			$res=$sth->fetchAll();
			return $res;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}

	public function prospecto_edit($id){
		try{
			parent::set_names();
			$sql="SELECT * FROM clientes where idcliente=:idcliente";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":idcliente",$id);
			$sth->execute();
			$res=$sth->fetch();
			return $res;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}
	function guardar_prospecto(){
		$x="";
		if (isset($_REQUEST['id'])){$id=$_REQUEST['id'];}
		$arreglo =array();
		if (isset($_REQUEST['cliente'])){
			$arreglo+=array('cliente'=>$_REQUEST['cliente']);
		}
		if (isset($_REQUEST['contacto'])){
			$arreglo+=array('contacto'=>$_REQUEST['contacto']);
		}
		if (isset($_REQUEST['rfc'])){
			$arreglo+=array('rfc'=>$_REQUEST['rfc']);
		}
		if (isset($_REQUEST['domicilio'])){
			$arreglo+=array('domicilio'=>$_REQUEST['domicilio']);
		}
		if (isset($_REQUEST['correo'])){
			$arreglo+=array('correo'=>$_REQUEST['correo']);
		}
		if (isset($_REQUEST['prospecto'])){
			$arreglo+=array('prospecto'=>$_REQUEST['prospecto']);
		}
		if (isset($_REQUEST['venta'])){
			$arreglo+=array('venta'=>$_REQUEST['venta']);
		}
		if (isset($_REQUEST['producto'])){
			$arreglo+=array('producto'=>$_REQUEST['producto']);
		}
		if (isset($_REQUEST['seguimiento'])){
			$arreglo+=array('seguimiento'=>$_REQUEST['seguimiento']);
		}
		if($id==0){					
			$x.=$this->insert('clientes', $arreglo);
		}
		else{
			$x.=$this->update('clientes',array('idcliente'=>$id), $arreglo);
		}
		return $x;
	}	
}

if(strlen($function)>0){
	$personal = new Prospectos();
	echo $personal->$function();
}

