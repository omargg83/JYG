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
		}		if (isset($_REQUEST['email'])){		$arreglo+=array('email'=>$_REQUEST['email']);	}
		if($id==0){					
			$x.=$this->insert('despachos', $arreglo);
		}
		else{
			$x.=$this->update('despachos',array('iddespacho'=>$id), $arreglo);
		}
		return $x;
	}
}

if(strlen($function)>0){
	$bd = new Despachos();
	echo $bd->$function();
}

