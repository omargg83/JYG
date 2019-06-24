<?php
require_once("../control_db.php");
if (isset($_REQUEST['function'])){$function=$_REQUEST['function'];}	else{ $function="";}

class Operaciones extends Sagyc{
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
	public function operaciones(){
		try{
			parent::set_names();
			if ($_SESSION['tipousuario']=='administrativo'){
				$sql="SELECT
				oper.idoperacion,
				oper.fecha,
				oper.monto,
				clientes_razon.razon as razoncli,
				clientes.cliente,
				empresas.razon as razonemp,
				despachos.nombre
				FROM
				operaciones AS oper
				left outer JOIN clientes_razon ON oper.idrazon = clientes_razon.idrazon
				left outer JOIN clientes ON clientes_razon.idcliente = clientes.idcliente
				left outer JOIN empresas ON oper.idempresa = empresas.idempresa
				left outer JOIN despachos ON empresas.iddespacho = despachos.iddespacho
				order by oper.fecha asc";
			}
			else{
				$sql="SELECT
				oper.idoperacion,
				oper.fecha,
				oper.monto,
				clientes_razon.razon as razoncli,
				clientes.cliente,
				empresas.razon as razonemp,
				despachos.nombre
				FROM
				operaciones AS oper
				left outer JOIN clientes_razon ON oper.idrazon = clientes_razon.idrazon
				left outer JOIN clientes ON clientes_razon.idcliente = clientes.idcliente
				left outer JOIN empresas ON oper.idempresa = empresas.idempresa
				left outer JOIN despachos ON empresas.iddespacho = despachos.iddespacho
				where oper.idpersona='".$_SESSION['idpersona']."' order by oper.fecha asc";
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
	public function razon($idrazon){
		try{
			parent::set_names();
			$sql="SELECT * FROM clientes_razon left outer join clientes on clientes.idcliente=clientes_razon.idcliente where idrazon=:idrazon";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":idrazon",$idrazon);
			$sth->execute();
			$res=$sth->fetch();
			return $res;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}
	public function comisionista($idcliente){
		try{
			parent::set_names();
			$sql="SELECT * FROM clientes_comi where idcliente=:idcliente";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":idcliente",$idcliente);
			$sth->execute();
			$res=$sth->fetchAll();
			return $res;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}
	public function buscar_cliente($texto){
		try{
			parent::set_names();
			if ($_SESSION['tipousuario']=='administrativo'){
				$sql="SELECT * FROM clientes_razon
				left outer join clientes on clientes.idcliente=clientes_razon.idcliente
				where (clientes.cliente like :texto or clientes_razon.razon like :texto)";
				$sth = $this->dbh->prepare($sql);
			}
			else{
				$sql="SELECT * FROM clientes_razon
				left outer join clientes on clientes.idcliente=clientes_razon.idcliente
				where clientes.idpersona=:idpersona and
				(clientes.cliente like :texto or clientes_razon.razon like :texto)";
				$sth = $this->dbh->prepare($sql);
				$sth->bindValue(":idpersona",$_SESSION['idpersona']);
			}
			$sth->bindValue(":texto","%$texto%");
			$sth->execute();
			$res=$sth->fetchAll();
			return $res;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}
	public function guarda_razon(){
		$x="";
		parent::set_names();
		if (isset($_REQUEST['id'])){$id=$_REQUEST['id'];}
		$arreglo =array();

		if (isset($_REQUEST['idrazon']) and strlen($_REQUEST['idrazon'])>0){
			$arreglo+=array('idrazon'=>$_REQUEST['idrazon']);
		}

		if (isset($_REQUEST['idempresa'])  and strlen($_REQUEST['idempresa'])>0){
			$arreglo+=array('idempresa'=>$_REQUEST['idempresa']);
		}

		$x.=$this->update('operaciones',array('idoperacion'=>$id), $arreglo);
		return $x;
	}
	public function empresa($idempresa){
		try{
			parent::set_names();
			$sql="SELECT * FROM empresas left outer join despachos on empresas.iddespacho=despachos.iddespacho where idempresa=:idempresa";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":idempresa",$idempresa);
			$sth->execute();
			$res=$sth->fetch();
			return $res;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}
	public function buscar_empresa($texto){
		try{
			parent::set_names();

			$sql="SELECT * FROM empresas left outer join despachos on empresas.iddespacho=despachos.iddespacho where (empresas.razon like :texto or despachos.nombre like :texto)";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":texto","%$texto%");
			$sth->execute();
			$res=$sth->fetchAll();
			return $res;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}
	public function uso_buscar(){
		try{
			parent::set_names();
			$x="";
			$texto=$_REQUEST['valor'];
			$sql="SELECT * FROM sat_uso where descripcion like '%$texto%' or clave like '%$texto%'";
			$sth = $this->dbh->prepare($sql);
			$sth->execute();
			$res=$sth->fetchAll();
			$x.="<table class='table table-sm' id='usotb' style='font-size:12px'>";
			$x.="<tr><th>Uso de la factura</th></tr>";
			foreach ($res as $key) {
				$x.="<tr><td>";
				$x.=$key['clave']." - ".$key['descripcion'];
				$x.="</td></tr>";
			}
			$x.="</table>";
			return $x;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}
	public function forma_buscar(){
		try{
			parent::set_names();
			$x="";
			$texto=$_REQUEST['valor'];
			$sql="SELECT * FROM sat_fpago where pago like '%$texto%'";
			$sth = $this->dbh->prepare($sql);
			$sth->execute();
			$res=$sth->fetchAll();
			$x.="<table class='table table-sm' id='formatb' style='font-size:12px'>";
			$x.="<tr><th>Forma de pago</th></tr>";
			foreach ($res as $key) {
				$x.="<tr><td>";
				$x.=$key['pago'];
				$x.="</td></tr>";
			}
			$x.="</table>";
			return $x;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}
	public function empresa_despacho($id){
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
	public function producto_buscar(){
		try{
			parent::set_names();
			$x="";
			$texto=$_REQUEST['valor'];
			$sql="SELECT * FROM sat_prodserv where descripcion like '%$texto%'";
			$sth = $this->dbh->prepare($sql);
			$sth->execute();
			$res=$sth->fetchAll();
			$x.="<table class='table table-sm' id='formatb' style='font-size:12px'>";
			$x.="<tr><th>Descripción</th></tr>";
			foreach ($res as $key) {
				$x.="<tr><td>";
				$x.=$key['claveprod']." - ".$key['descripcion'];
				$x.="</td></tr>";
			}
			$x.="</table>";
			return $x;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}
	public function personal_edit($id){
		try{
			parent::set_names();
			$sql="SELECT * FROM personal where idpersona=:idpersona";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":idpersona",$id);
			$sth->execute();
			$res=$sth->fetch();
			return $res;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}
	public function producto_edit($id){
		try{
			parent::set_names();
			$sql="SELECT * FROM productos where idproducto=:idproducto";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":idproducto",$id);
			$sth->execute();
			$res=$sth->fetch();
			return $res;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}
	public function producto_despacho($iddespacho){
		try{
			parent::set_names();
			$sql="SELECT * FROM productos where iddespacho=:iddespacho";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":iddespacho",$iddespacho);
			$sth->execute();
			$res=$sth->fetchAll();
			return $res;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}
	public function operacion_edit($id){
		try{
			self::set_names();
			$sql="SELECT * FROM operaciones where idoperacion=:id";
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
	public function facturas($id){
		try{
			self::set_names();
			$sql="SELECT * FROM facturas where idoperacion=:id";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":id",$id);
			$sth->execute();
			$res=$sth->fetchAll();
			return $res;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}
	public function facturas_edit($id){
		try{
			self::set_names();
			$sql="SELECT * FROM facturas where idfactura=:id";
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
	public function retorno($id){
		try{
			self::set_names();
			$sql="SELECT * FROM retorno where idoperacion=:id";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":id",$id);
			$sth->execute();
			$res=$sth->fetchAll();
			return $res;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}
	public function retorno_edit($id){
		try{
			self::set_names();
			$sql="SELECT * FROM retorno where idretorno=:id";
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
	public function guardar_operacion(){
		$x="";
		parent::set_names();
		if (isset($_REQUEST['id'])){$id=$_REQUEST['id'];}
		$arreglo =array();

		if (isset($_REQUEST['fecha'])){
			$fx=explode("-",$_REQUEST['fecha']);
			$arreglo+=array('fecha'=>$fx['2']."-".$fx['1']."-".$fx['0']);
		}
		if (isset($_REQUEST['monto'])){
			$arreglo+=array('monto'=>$_REQUEST['monto']);
		}

		if (isset($_REQUEST['idrazon']) and strlen($_REQUEST['idrazon'])>0){
			$arreglo+=array('idrazon'=>$_REQUEST['idrazon']);
		}
		else{
			$arreglo+=array('idrazon'=>null);
		}
		if (isset($_REQUEST['idempresa'])  and strlen($_REQUEST['idempresa'])>0){
			$arreglo+=array('idempresa'=>$_REQUEST['idempresa']);
		}
		else{
			$arreglo+=array('idempresa'=>null);
		}

		if($id==0){
			$arreglo+=array('idpersona'=>$_SESSION['idpersona']);
			$x.=$this->insert('operaciones', $arreglo);
		}
		else{
			$x.=$this->update('operaciones',array('idoperacion'=>$id), $arreglo);
		}
		return $x;
	}
	public function guardar_factura(){
		$x="";
		parent::set_names();
		if (isset($_REQUEST['id'])){$id=$_REQUEST['id'];}

		$arreglo =array();
		if (isset($_REQUEST['idoper_fact'])){
			$idoperacion=$_REQUEST['idoper_fact'];
			$arreglo+=array('idoperacion'=>$idoperacion);
		}

		if (isset($_REQUEST['fecha_fact'])){
			$fx=explode("-",$_REQUEST['fecha_fact']);
			$arreglo+=array('fecha'=>$fx['2']."-".$fx['1']."-".$fx['0']);
		}

		if (isset($_REQUEST['monto_fact'])){
			$arreglo+=array('monto'=>$_REQUEST['monto_fact']);
		}

		if (isset($_REQUEST['subtotal'])){
			$arreglo+=array('subtotal'=>$_REQUEST['subtotal']);
		}

		if (isset($_REQUEST['iva'])){
			$arreglo+=array('iva'=>$_REQUEST['iva']);
		}

		if (isset($_REQUEST['uso'])){
			$arreglo+=array('uso'=>$_REQUEST['uso']);
		}

		if (isset($_REQUEST['forma'])){
			$arreglo+=array('forma'=>$_REQUEST['forma']);
		}

		if (isset($_REQUEST['producto'])){
			$arreglo+=array('producto'=>$_REQUEST['producto']);
		}

		if (isset($_REQUEST['descripcion'])){
			$arreglo+=array('descripcion'=>$_REQUEST['descripcion']);
		}

		if($id==0){
			$x.=$this->insert('facturas', $arreglo);
		}
		else{
			$x.=$this->update('facturas',array('idfactura'=>$id), $arreglo);
		}
		if(is_numeric($x)){
			return $idoperacion;
		}
		else{
			return $x;
		}
	}
	public function guardar_retorno(){
		$x="";
		parent::set_names();
		if (isset($_REQUEST['id'])){$id=$_REQUEST['id'];}

		$arreglo =array();
		if (isset($_REQUEST['idoper_fact'])){
			$idoperacion=$_REQUEST['idoper_fact'];
			$arreglo+=array('idoperacion'=>$idoperacion);
		}

		if (isset($_REQUEST['fecha_fact'])){
			$fx=explode("-",$_REQUEST['fecha_fact']);
			$arreglo+=array('fecha'=>$fx['2']."-".$fx['1']."-".$fx['0']);
		}

		if (isset($_REQUEST['idproducto_selx'])){
			$arreglo+=array('idproducto'=>$_REQUEST['idproducto_selx']);
		}

		if (isset($_REQUEST['monto_r'])){
			$arreglo+=array('monto'=>$_REQUEST['monto_r']);
		}

		if (isset($_REQUEST['pventa'])){
			$arreglo+=array('pventa'=>$_REQUEST['pventa']);
		}

		if (isset($_REQUEST['monto_retorno'])){
			$arreglo+=array('monto_retorno'=>$_REQUEST['monto_retorno']);
		}

		if (isset($_REQUEST['comision'])){
			$arreglo+=array('comision'=>$_REQUEST['comision']);
		}

		if (isset($_REQUEST['pikito'])){
			$arreglo+=array('pikito'=>$_REQUEST['pikito']);
		}

		if (isset($_REQUEST['monto_pikito'])){
			$arreglo+=array('monto_pikito'=>$_REQUEST['monto_pikito']);
		}

		if (isset($_REQUEST['saldo'])){
			$arreglo+=array('saldo'=>$_REQUEST['saldo']);
		}

		if (isset($_REQUEST['despacho'])){
			$arreglo+=array('despacho'=>$_REQUEST['despacho']);
		}

		if (isset($_REQUEST['monto_despacho'])){
			$arreglo+=array('monto_despacho'=>$_REQUEST['monto_despacho']);
		}

		if (isset($_REQUEST['saldodesp'])){
			$arreglo+=array('saldodesp'=>$_REQUEST['saldodesp']);
		}


		if($id==0){
			$x.=$this->insert('retorno', $arreglo);
		}
		else{
			$x.=$this->update('retorno',array('idretorno'=>$id), $arreglo);
		}
		if(is_numeric($x)){
			return $idoperacion;
		}
		else{
			return $x;
		}
	}
	public function producto_tipo(){
		$x="";

		$idproducto=$_REQUEST['idproducto'];
		$monto=$_REQUEST['monto'];
		$pikito=$_REQUEST['pikito'];
		$despacho=$_REQUEST['despacho'];

		$val=$this->producto_edit($idproducto);
		$pventa=$val['pventa'];
		$producto=$val['producto'];



		$comision=$monto/$pventa;
		$retorno=$monto-$comision;


		$monto_pikito=($comision*$pikito)/100;
		$saldo=$comision-$monto_pikito;

		$monto_despacho=($despacho*$saldo)/100;
		$saldodesp=$saldo-$monto_despacho;



		$arreglo=array();
		$arreglo=array('pventa'=>$pventa);
		$arreglo+=array('comision'=>$comision);
		$arreglo+=array('retorno'=>$retorno);
		$arreglo+=array('monto_pikito'=>$monto_pikito);
		$arreglo+=array('saldo'=>$saldo);
		$arreglo+=array('monto_despacho'=>$monto_despacho);
		$arreglo+=array('saldodesp'=>$saldodesp);

		return json_encode($arreglo);
	}
	public function forma(){
		try{
			parent::set_names();
			$sql="SELECT * FROM sat_fpago order by pago asc";
			$sth = $this->dbh->prepare($sql);
			$sth->execute();
			$res=$sth->fetchAll();
			return $res;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}
	public function borrar_factura(){
		if (isset($_POST['id'])){$id=$_POST['id'];}
		return $this->borrar('facturas',"idfactura",$id);
	}
	public function borrar_retorno(){
		if (isset($_POST['id'])){$id=$_POST['id'];}
		return $this->borrar('retorno',"idretorno",$id);
	}

}

$db = new Operaciones();
if(strlen($function)>0){
	echo $db->$function();
}
