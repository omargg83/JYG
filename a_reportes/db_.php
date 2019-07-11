<?php
require_once("../control_db.php");
if (isset($_REQUEST['function'])){$function=$_REQUEST['function'];}	else{ $function="";}

class Reportes extends Sagyc{

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
	public function reporte_1(){
		try{
			parent::set_names();
			$desde=$_REQUEST['desde'];
		  $hasta=$_REQUEST['hasta'];
			$desde = date("Y-m-d", strtotime($desde));
			$hasta = date("Y-m-d", strtotime($hasta));
			$sql="select fecha,subtotal,iva,monto,nombre from operaciones
			left outer join personal on personal.idpersona=operaciones.idpersona
			where fecha between '$desde' and '$hasta'";
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

$db = new Reportes();
if(strlen($function)>0){
	echo $db->$function();
}
