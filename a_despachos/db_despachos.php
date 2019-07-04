<?php
require_once("../control_db.php");
if (isset($_REQUEST['function'])){$function=$_REQUEST['function'];}	else{ $function="";}

class Despachos extends Sagyc{

	public $nivel_personal;
	public $nivel_captura;

	public function __construct(){
		parent::__construct();
		$this->doc="a_clientes/papeles/";

		if(isset($_SESSION['idpersona']) and $_SESSION['autoriza'] == 1) {

		}
		else{
			include "../error.php";
			die();
		}
	}
	public function operador($id){
		try{
			parent::set_names();
			$sql="SELECT * FROM despachos_oper where iddespacho=:iddespacho";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":iddespacho",$id);
			$sth->execute();
			$res=$sth->fetchAll();
			return $res;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}
	public function operador_edit($id){
		try{
			parent::set_names();
			$sql="SELECT * FROM despachos_oper where idoper=:idoper";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":idoper",$id);
			$sth->execute();
			$res=$sth->fetch();
			return $res;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}

	public function guardar_oper(){
		$x="";
		parent::set_names();
		if (isset($_REQUEST['id'])){$id=$_REQUEST['id'];}
		$arreglo =array();
		if (isset($_REQUEST['operador'])){
			$arreglo+=array('operador'=>$_REQUEST['operador']);
		}
		if (isset($_REQUEST['correo'])){
			$arreglo+=array('correo'=>$_REQUEST['correo']);
		}
		if (isset($_REQUEST['iddespacho'])){
			$iddespacho=$_REQUEST['iddespacho'];
			$arreglo+=array('iddespacho'=>$iddespacho);
		}

		if($id==0){
			$x.=$this->insert('despachos_oper', $arreglo);
		}
		else{
			$x.=$this->update('despachos_oper',array('idoper'=>$id), $arreglo);
		}
		if(is_numeric($x)){
			return $iddespacho;
		}
		else{
			return $x;
		}

	}

	public function despacho_edit($id){
		try{
			parent::set_names();
			$sql="SELECT * FROM despachos where iddespacho=:iddespacho";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":iddespacho",$id);
			$sth->execute();
			$res=$sth->fetch();
			return $res;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}
	function guardar_despacho(){

		$x="";
		if (isset($_REQUEST['id'])){$id=$_REQUEST['id'];}
		$arreglo =array();
		if (isset($_REQUEST['nombre'])){
			$arreglo+=array('nombre'=>$_REQUEST['nombre']);
		}
		if (isset($_REQUEST['socio'])){
			$arreglo+=array('socio'=>$_REQUEST['socio']);
		}
		if (isset($_REQUEST['telefono'])){
			$arreglo+=array('telefono'=>$_REQUEST['telefono']);
		}
		if (isset($_REQUEST['email'])){
			$arreglo+=array('email'=>$_REQUEST['email']);
		}
		if (isset($_REQUEST['comision'])){
			$arreglo+=array('comision'=>$_REQUEST['comision']);
		}
		if($id==0){
			$x.=$this->insert('despachos', $arreglo);
		}
		else{
			$x.=$this->update('despachos',array('iddespacho'=>$id), $arreglo);
		}
		return $x;
	}
}



$db = new Despachos();
if(strlen($function)>0){
	echo $db->$function();
}
