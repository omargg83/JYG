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
			$sql="SELECT
	    oper.idoperacion,
	    oper.fecha,
	    oper.subtotal,
	    oper.iva,
	    oper.monto,
	    oper.finalizar,
	    oper.comision,
	    oper.tcomision,
	    oper.retorno,
	    oper.creal,
	    oper.tcomision_r,
	    oper.retorno_r,
	    oper.comision_f,
	    oper.retorno_f,
	    oper.pikito,
	    oper.esquema,
	    oper.idempresa,
	    oper.idrazon,
			personal.nombre,
			clientes_razon.razon as razoncli,
			clientes.cliente,
			empresas.razon as razonemp,
			despachos.nombre as desp
			from operaciones oper
			left outer join personal on personal.idpersona=oper.idpersona
			left outer JOIN clientes_razon ON oper.idrazon = clientes_razon.idrazon
			left outer JOIN clientes ON clientes_razon.idcliente = clientes.idcliente
			left outer JOIN empresas ON oper.idempresa = empresas.idempresa
			left outer JOIN despachos ON empresas.iddespacho = despachos.iddespacho
			where oper.fecha between '$desde' and '$hasta'";

			if(strlen($estado)>0){
				$sql.=" and oper.finalizar='$estado'";
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
