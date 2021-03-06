<?php
require_once("../control_db.php");
if (isset($_REQUEST['function'])){$function=$_REQUEST['function'];}	else{ $function="";}

class Reportes2 extends Sagyc{

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

	public function reporte_4(){
		try{
			parent::set_names();
			$desde=$_REQUEST['desde'];
			$hasta=$_REQUEST['hasta'];

			$desde = date("Y-m-d", strtotime($desde));
			$hasta = date("Y-m-d", strtotime($hasta));

			$sql="SELECT * from gastos where fecha between '$desde' and '$hasta'";
			$sth = $this->dbh->prepare($sql);
			$sth->execute();
			$res=$sth->fetchAll();
			return $res;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}
	public function reporte4(){
		$sql="SELECT month(fecha) as mes, sum(costo) as total FROM gastos where year(fecha)=year(now()) group by month(fecha);";
		$response=$this->general($sql);
		$arreglo=array();
		for($i=0;$i<count($response);$i++){
			$arreglo[$i]=array('mes'=>$response[$i]['mes'], 'total'=>$response[$i]['total']);
		}
		return json_encode($arreglo);
	}
}

$db = new Reportes2();
if(strlen($function)>0){
	echo $db->$function();
}
