<?php
require_once("../control_db.php");
if (isset($_REQUEST['function'])){$function=$_REQUEST['function'];}	else{ $function="";}

class Comisionistas extends Sagyc{
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

	public function comisionista(){
		try{
			self::set_names();
			$sql="SELECT * FROM comisionistas";
			$sth = $this->dbh->prepare($sql);
			$sth->execute();
			$res=$sth->fetchAll();
			return $res;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}

	public function comisionista_edit($idcom){
		try{
			parent::set_names();
			$sql="SELECT * FROM comisionistas where idcom=:idcom";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":idcom",$idcom);
			$sth->execute();
			$res=$sth->fetch();
			return $res;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}

	function guardar_comisionista(){
		$x="";
		if (isset($_REQUEST['id'])){$id=$_REQUEST['id'];}
		$arreglo =array();
		if (isset($_REQUEST['nombre'])){
			$arreglo+=array('nombre'=>$_REQUEST['nombre']);
		}
		if (isset($_REQUEST['email'])){
			$arreglo+=array('email'=>$_REQUEST['email']);
		}
		if (isset($_REQUEST['telefono'])){
			$arreglo+=array('telefono'=>$_REQUEST['telefono']);
		}
		if (isset($_REQUEST['banco'])){
			$arreglo+=array('banco'=>$_REQUEST['banco']);
		}
		if (isset($_REQUEST['cuentabanco'])){
			$arreglo+=array('cuentabanco'=>$_REQUEST['cuentabanco']);
		}
		if (isset($_REQUEST['comision'])){
			$arreglo+=array('comision'=>$_REQUEST['comision']);
		}

		if($id==0){
			$x.=$this->insert('comisionistas', $arreglo);
		}
		else{
			$x.=$this->update('comisionistas',array('idcom'=>$id), $arreglo);
		}
		return $x;
	}
}


if(strlen($function)>0){
	$personal = new Comisionistas();
	echo $personal->$function();
}
