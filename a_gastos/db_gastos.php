<?php
require_once("../control_db.php");
if (isset($_REQUEST['function'])){$function=$_REQUEST['function'];}	else{ $function="";}

class Gastos extends Sagyc{
	public $nivel_personal;
	public $nivel_captura;

	public function __construct(){
		parent::__construct();

		if(isset($_SESSION['idpersona']) and $_SESSION['autoriza'] == 1) {

		}
		else{
			include "../error.php";
			die();
		}
	}

	public function gastos(){
		try{
			self::set_names();
			$sql="SELECT * FROM gastos";
			$sth = $this->dbh->prepare($sql);
			$sth->execute();
			$res=$sth->fetchAll();
			return $res;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}

	public function gastos_edit($idgastos){
		try{
			parent::set_names();
			$sql="SELECT * FROM gastos where idgastos=:idgastos";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":idgastos",$idgastos);
			$sth->execute();
			$res=$sth->fetch();
			return $res;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}

	function guardar_gastos(){
		$x="";
		if (isset($_REQUEST['id'])){$id=$_REQUEST['id'];}
		$arreglo =array();
		if (isset($_REQUEST['fecha'])){
			$arreglo+=array('fecha'=>$_REQUEST['fecha']);
		}
		if (isset($_REQUEST['gasto'])){
			$arreglo+=array('gasto'=>$_REQUEST['gasto']);
		}
		if (isset($_REQUEST['descripcion'])){
			$arreglo+=array('descripcion'=>$_REQUEST['descripcion']);
		}
		if (isset($_REQUEST['costo'])){
			$arreglo+=array('costo'=>$_REQUEST['costo']);
		}

		if($id==0){
			$x.=$this->insert('gastos', $arreglo);
		}
		else{
			$x.=$this->update('gastos',array('idgastos'=>$id), $arreglo);
		}
		return $x;
	}
}


if(strlen($function)>0){
	$personal = new gastos();
	echo $personal->$function();
}
