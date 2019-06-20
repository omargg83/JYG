<?php
require_once("../control_db.php");
if (isset($_REQUEST['function'])){$function=$_REQUEST['function'];}	else{ $function="";}

class Productos extends Sagyc{

	public $nivel_personal;
	public $nivel_captura;

	public function __construct(){
		parent::__construct();
		$this->doc="a_productostipo/papeles/";

		if(isset($_SESSION['idpersona']) and $_SESSION['autoriza'] == 1) {

		}
		else{
			include "../error.php";
			die();
		}
	}
	public function productos(){
		try{
			parent::set_names();
			$sql="SELECT * FROM productos";
			$sth = $this->dbh->prepare($sql);
			$sth->execute();
			$res=$sth->fetchAll();
			return $res;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}

	public function producto_edit($id){
		try{
			parent::set_names();
			$sql="SELECT * FROM productos where idproducto=:idproducto";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":idproducto",$id);
			$sth->execute();
			$res=$sth->fetch();
			return $res;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}
	function guardar_producto(){
		$x="";
		if (isset($_REQUEST['id'])){$id=$_REQUEST['id'];}
		$arreglo =array();
		if (isset($_REQUEST['producto'])){
			$arreglo+=array('producto'=>$_REQUEST['producto']);
		}
		if (isset($_REQUEST['iddespacho'])){
			$arreglo+=array('iddespacho'=>$_REQUEST['iddespacho']);
		}
		if (isset($_REQUEST['pventa'])){
			$arreglo+=array('pventa'=>$_REQUEST['pventa']);
		}
		if (isset($_REQUEST['pcomisionista'])){
			$arreglo+=array('pcomisionista'=>$_REQUEST['pcomisionista']);
		}
		if (isset($_REQUEST['psocios'])){
			$arreglo+=array('psocios'=>$_REQUEST['psocios']);
		}
		if (isset($_REQUEST['pikito'])){
			$arreglo+=array('pikito'=>$_REQUEST['pikito']);
		}
		if($id==0){
			$x.=$this->insert('productos', $arreglo);
		}
		else{
			$x.=$this->update('productos',array('idproducto'=>$id), $arreglo);
		}
		return $x;
	}
}

if(strlen($function)>0){
	$db = new Productos();
	echo $db->$function();
}
