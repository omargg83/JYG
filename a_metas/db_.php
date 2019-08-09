<?php
require_once("../control_db.php");
error_reporting(E_ALL);
ini_set('display_errors', '1');

if (isset($_REQUEST['function'])){$function=$_REQUEST['function'];}	else{ $function="";}

class Metas extends Sagyc{
	public $nivel_personal;
	public $nivel_captura;

	public function __construct(){
		parent::__construct();
		$this->doc="a_operaciones/documentos/";

		if(isset($_SESSION['idpersona']) and $_SESSION['autoriza'] == 1) {

		}
		else{
			include "../error.php";
			die();
		}
	}
  public function metas_factura(){
		try{
			parent::set_names();
			$sql="SELECT * FROM meta_factura";
			$sth = $this->dbh->prepare($sql);
			$sth->execute();
			$res=$sth->fetchAll();
			return $res;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}
	public function meta_edit($id){
		try{
			parent::set_names();
			$sql="SELECT * FROM meta_factura where id=:id";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":id",$id);
			$sth->execute();
			$res=$sth->fetch();
			return $res;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}
	public function guardar_meta(){
		$x="";
		parent::set_names();
		if (isset($_REQUEST['id'])){$id=$_REQUEST['id'];}
		$arreglo =array();
		if (isset($_REQUEST['mes'])){
			$arreglo+=array('mes'=>$_REQUEST['mes']);
		}
		if (isset($_REQUEST['anio'])){
			$arreglo+=array('anio'=>$_REQUEST['anio']);
		}
		if (isset($_REQUEST['meta'])){
			$arreglo+=array('meta'=>$_REQUEST['meta']);
		}
		if($id==0){
			$x.=$this->insert('meta_factura', $arreglo);
		}
		else{
			$x.=$this->update('meta_factura',array('id'=>$id), $arreglo);
		}
		return $x;
	}

}

$db = new Metas();
if(strlen($function)>0){
	echo $db->$function();
}
