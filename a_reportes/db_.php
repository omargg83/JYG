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
			$estado=$_REQUEST['estado'];
			echo $estado;

			$desde = date("Y-m-d", strtotime($desde));
			$hasta = date("Y-m-d", strtotime($hasta));
			$sql="select operaciones.idoperacion, fecha, subtotal, iva, monto, nombre, finalizar, operaciones.comision, operaciones.tcomision, operaciones.retorno,
			operaciones.creal, operaciones.tcomision_r, operaciones.retorno_r, operaciones.comision_f, operaciones.retorno_f, operaciones.pikito, operaciones.esquema,
			operaciones.idempresa, operaciones.idrazon from operaciones
			left outer join personal on personal.idpersona=operaciones.idpersona
			where fecha between '$desde' and '$hasta'";
			if(strlen($estado)>0){
				$sql.=" and operaciones.finalizar='$estado'";
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

$db = new Reportes();
if(strlen($function)>0){
	echo $db->$function();
}
