<?php
require_once("../control_db.php");
if (isset($_REQUEST['function'])){$function=$_REQUEST['function'];}	else{ $function="";}

class Operaciones extends Sagyc{
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
				INNER JOIN clientes_razon ON oper.idrazon = clientes_razon.idrazon
				INNER JOIN clientes ON clientes_razon.idcliente = clientes.idcliente
				INNER JOIN empresas ON oper.idempresa = empresas.idempresa
				INNER JOIN despachos ON empresas.iddespacho = despachos.iddespacho
				order by oper.idoperacion desc";
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
				INNER JOIN clientes_razon ON oper.idrazon = clientes_razon.idrazon
				INNER JOIN clientes ON clientes_razon.idcliente = clientes.idcliente
				INNER JOIN empresas ON oper.idempresa = empresas.idempresa
				INNER JOIN despachos ON empresas.iddespacho = despachos.iddespacho
				where operaciones.idpersona='".$_SESSION['idpersona']."' order by oper.idoperacion desc";
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

	public function razon(){
		try{
			parent::set_names();
			if($_SESSION['tipousuario']=="administrativo"){
				$sql="SELECT * FROM clientes_razon left outer join clientes on clientes.idcliente=clientes_razon.idcliente";
				$sth = $this->dbh->prepare($sql);
			}
			else{
				$sql="SELECT * FROM clientes_razon left outer join clientes on clientes.idcliente=clientes_razon.idcliente where clientes.idpersona=:idpersona";
				$sth = $this->dbh->prepare($sql);
				$sth->bindValue(":idpersona",$_SESSION['idpersona']);
			}
			$sth->execute();
			$res=$sth->fetchAll();
			return $res;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}
	public function empresa(){
		try{
			parent::set_names();

			$sql="SELECT * FROM empresas left outer join despachos on empresas.iddespacho=despachos.iddespacho ";
			$sth = $this->dbh->prepare($sql);

			$sth->execute();
			$res=$sth->fetchAll();
			return $res;
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

		if (isset($_REQUEST['idrazon']) ){
			$arreglo+=array('idrazon'=>$_REQUEST['idrazon']);
		}

		if (isset($_REQUEST['idempresa']) ){
			$arreglo+=array('idempresa'=>$_REQUEST['idempresa']);
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

		if (isset($_REQUEST['iduso'])){
			$arreglo+=array('iduso'=>$_REQUEST['iduso']);
		}

		if (isset($_REQUEST['idforma'])){
			$arreglo+=array('idforma'=>$_REQUEST['idforma']);
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

		if (isset($_REQUEST['monto'])){
			$arreglo+=array('monto'=>$_REQUEST['monto']);
		}

		if (isset($_REQUEST['tipo'])){
			$arreglo+=array('tipo'=>$_REQUEST['tipo']);
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
		if (isset($_REQUEST['idproducto'])){
			$idproducto=$_REQUEST['idproducto'];
		}
		$val=$this->producto_edit($idproducto);
		$pventa=$val['pventa'];
		$pcomisionista=$val['pcomisionista'];
		$psocios=$val['psocios'];
		$producto=$val['producto'];
		$pikito=$val['pikito'];
		$monto="";
		$x.="<div class='row'>";
		$x.="<div class='col-4'>
		<label for='monto'>Pventa</label>
		<input type='text' placeholder='monto' id='pventa' name='pventa' value='$pventa' class='form-control' autocomplete=off readonly>
		</div>";

		$x.="<div class='col-4'>
		<label for='monto'>pcomisionista</label>
		<input type='text' placeholder='pcomisionista' id='pcomisionista' name='pcomisionista' value='$pcomisionista' class='form-control' autocomplete=off readonly>
		</div>";

		$x.="<div class='col-4'>
		<label for='monto'>psocios</label>
		<input type='text' placeholder='psocios' id='psocios' name='psocios' value='$psocios' class='form-control' autocomplete=off readonly>
		</div>";

		$x.="<div class='col-4'>
		<label for='monto'>pikito</label>
		<input type='text' placeholder='pikito' id='pikito' name='pikito' value='$pikito' class='form-control' autocomplete=off readonly>
		</div>";
		$x.="</div>";

		$total=0;
		$x.="<div class='row'>";
		if($producto=="CHEQUE"){
			$x.="<div class='col-4'>
			<label for='total'>Total</label>
			<input type='text' placeholder='total' id='total' name='total' value='$total' class='form-control' autocomplete=off>
			</div>";
		}
		if($producto=="SPEI"){
			$x.="<div class='col-4'>
			<label for='total'>Total</label>
			<input type='text' placeholder='total' id='total' name='total' value='$total' class='form-control' autocomplete=off>
			</div>";
		}
		if($producto=="ASIMILADOS"){
			$x.="<div class='col-4'>
			<label for='total'>Total</label>
			<input type='text' placeholder='total' id='total' name='total' value='$total' class='form-control' autocomplete=off>
			</div>";
		}
		if($producto=="PLAN PRIVADO"){
			$x.="<div class='col-4'>
			<label for='total'>Total</label>
			<input type='text' placeholder='total' id='total' name='total' value='$total' class='form-control' autocomplete=off>
			</div>";
		}
		if($producto=="EFECTIVO"){
			$x.="<div class='col-4'>
			<label for='total'>Total</label>
			<input type='text' placeholder='total' id='total' name='total' value='$total' class='form-control' autocomplete=off>
			</div>";
		}
		if($producto=="CUCA"){
			$x.="<div class='col-4'>
			<label for='total'>Total</label>
			<input type='text' placeholder='total' id='total' name='total' value='$total' class='form-control' autocomplete=off>
			</div>";
		}
		if($producto=="SINDICATO"){
			$x.="<div class='col-4'>
			<label for='total'>Total</label>
			<input type='text' placeholder='total' id='total' name='total' value='$total' class='form-control' autocomplete=off>
			</div>";
		}
		return $x;
	}

	public function uso_fact(){
		try{
			parent::set_names();
			$sql="SELECT * FROM sat_uso";
			$sth = $this->dbh->prepare($sql);
			$sth->execute();
			$res=$sth->fetchAll();
			return $res;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
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

}

$db = new Operaciones();
if(strlen($function)>0){
	echo $db->$function();
}
