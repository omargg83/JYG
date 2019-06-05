<?php
require_once("../control_db.php");
if (isset($_REQUEST['function'])){$function=$_REQUEST['function'];}	else{ $function="";}
	
class Tipo extends Sagyc{
	
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
	public function tipo_edit($id){
		try{
			parent::set_names();
			$sql="SELECT * FROM producto_tipo where idtipo=:idtipo";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":idtipo",$id);
			$sth->execute();
			$res=$sth->fetch();
			return $res;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}	
	
	function guardar_tipo(){
		$x="";
		if (isset($_REQUEST['id'])){$id=$_REQUEST['id'];}
		$arreglo =array();
		if (isset($_REQUEST['tipo'])){
			$arreglo+=array('tipo'=>$_REQUEST['tipo']);
		}
		if($id==0){					
			$x.=$this->insert('producto_tipo', $arreglo);
		}
		else{
			$x.=$this->update('producto_tipo',array('idtipo'=>$id), $arreglo);
		}
		return $x;
	}
}


if(strlen($function)>0){
	$db = new Tipo();
	echo $db->$function();
}


