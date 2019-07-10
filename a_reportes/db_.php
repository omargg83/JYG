<?php
require_once("../control_db.php");
if (isset($_REQUEST['function'])){$function=$_REQUEST['function'];}	else{ $function="";}

class Clientes extends Sagyc{

	public $nivel_personal;
	public $nivel_captura;

	public function __construct(){
		parent::__construct();
		$this->doc="a_clientes/documentos/";

		if(isset($_SESSION['idpersona']) and $_SESSION['autoriza'] == 1) {

		}
		else{
			include "../error.php";
			die();
		}
	}
	public function clientes(){
		try{
			parent::set_names();
			if($_SESSION['tipousuario']=="administrativo"){
				$sql="SELECT clientes.*,personal.nombre as ejecutivo FROM clientes left outer join personal on personal.idpersona=clientes.idpersona where prospecto=0";
			}
			else{
				$sql="SELECT clientes.*,personal.nombre as ejecutivo FROM clientes left outer join personal on personal.idpersona=clientes.idpersona where prospecto=0 and clientes.idpersona='".$_SESSION['idpersona']."'";
			}
			$sth = $this->dbh->prepare($sql);
			$sth->execute();
			$res=$sth->fetchAll();
			return $res;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}



}

}

$db = new Clientes();
if(strlen($function)>0){
	echo $db->$function();
}
