<?php
require_once("../control_db.php");
if (isset($_REQUEST['function'])){$function=$_REQUEST['function'];}	else{ $function="";}
	
class Empresas extends Sagyc{
	
	public $nivel_personal;
	public $nivel_captura;
	
	public function __construct(){
		parent::__construct();
		$this->doc="a_empresas/papeles/";
		if(isset($_SESSION['idpersona']) and $_SESSION['autoriza'] == 1) {
			
		}
		else{
			include "../error.php";
			die();
		}
	}
	
	public function empresa_edit($id){
		try{
			parent::set_names();
			$sql="SELECT * FROM empresas where idempresa=:idempresa";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":idempresa",$id);
			$sth->execute();
			$res=$sth->fetch();
			return $res;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}
	function guardar_empresa(){
		$x="";
		if (isset($_REQUEST['id'])){$id=$_REQUEST['id'];}
		$arreglo =array();
		if (isset($_REQUEST['razon'])){
			$arreglo+=array('razon'=>$_REQUEST['razon']);
		}
		if (isset($_REQUEST['rfc'])){
			$arreglo+=array('rfc'=>$_REQUEST['rfc']);
		}
		if (isset($_REQUEST['giro'])){
			$arreglo+=array('giro'=>$_REQUEST['giro']);
		}
		if (isset($_REQUEST['objeto'])){
			$arreglo+=array('objeto'=>$_REQUEST['objeto']);
		}
		if (isset($_REQUEST['banco'])){
			$arreglo+=array('banco'=>$_REQUEST['banco']);
		}
		if (isset($_REQUEST['clabe'])){
			$arreglo+=array('clabe'=>$_REQUEST['clabe']);
		}
		if (isset($_REQUEST['cuenta'])){
			$arreglo+=array('cuenta'=>$_REQUEST['cuenta']);
		}
		if (isset($_REQUEST['iddespacho'])){
			$arreglo+=array('iddespacho'=>$_REQUEST['iddespacho']);
		}
		if($id==0){					
			$x.=$this->insert('empresas', $arreglo);
		}
		else{
			$x.=$this->update('empresas',array('idempresa'=>$id), $arreglo);
		}
		return $x;
	}
}


if(strlen($function)>0){
	$db = new Empresas();
	echo $db->$function();
}

