<?php
require_once("../control_db.php");
if (isset($_REQUEST['function'])){$function=$_REQUEST['function'];}	else{ $function="";}

class Despachos extends Sagyc{

	public $nivel_personal;
	public $nivel_captura;

	public function __construct(){
		parent::__construct();
		$this->doc="a_clientes/papeles/";

		if(isset($_SESSION['idpersona']) and $_SESSION['autoriza'] == 1) {

		}
		else{
			include "../error.php";
			die();
		}
	}
	public function operador($id){
		try{
			parent::set_names();
			$sql="SELECT * FROM despachos_oper where iddespacho=:iddespacho";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":iddespacho",$id);
			$sth->execute();
			$res=$sth->fetchAll();
			return $res;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}
	public function operador_edit($id){
		try{
			parent::set_names();
			$sql="SELECT * FROM despachos_oper where idoper=:idoper";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":idoper",$id);
			$sth->execute();
			$res=$sth->fetch();
			return $res;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}

	public function guardar_oper(){
		$x="";
		parent::set_names();
		if (isset($_REQUEST['id'])){$id=$_REQUEST['id'];}
		$arreglo =array();
		if (isset($_REQUEST['operador'])){
			$arreglo+=array('operador'=>$_REQUEST['operador']);
		}
		if (isset($_REQUEST['correo'])){
			$arreglo+=array('correo'=>$_REQUEST['correo']);
		}
		if (isset($_REQUEST['iddespacho'])){
			$iddespacho=$_REQUEST['iddespacho'];
			$arreglo+=array('iddespacho'=>$iddespacho);
		}

		if($id==0){
			$x.=$this->insert('despachos_oper', $arreglo);
		}
		else{
			$x.=$this->update('despachos_oper',array('idoper'=>$id), $arreglo);
		}
		if(is_numeric($x)){
			return $iddespacho;
		}
		else{
			return $x;
		}

	}

	public function despacho_edit($id){
		try{
			parent::set_names();
			$sql="SELECT * FROM despachos where iddespacho=:iddespacho";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":iddespacho",$id);
			$sth->execute();
			$res=$sth->fetch();
			return $res;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}
	function guardar_despacho(){

		$x="";
		if (isset($_REQUEST['id'])){$id=$_REQUEST['id'];}
		$arreglo =array();
		if (isset($_REQUEST['nombre'])){
			$arreglo+=array('nombre'=>$_REQUEST['nombre']);
		}
		if (isset($_REQUEST['socio'])){
			$arreglo+=array('socio'=>$_REQUEST['socio']);
		}
		if (isset($_REQUEST['telefono'])){
			$arreglo+=array('telefono'=>$_REQUEST['telefono']);
		}
		if (isset($_REQUEST['email'])){
			$arreglo+=array('email'=>$_REQUEST['email']);
		}
		if (isset($_REQUEST['comision'])){
			$arreglo+=array('comision'=>$_REQUEST['comision']);
		}
		if($id==0){
			$x.=$this->insert('despachos', $arreglo);
		}
		else{
			$x.=$this->update('despachos',array('iddespacho'=>$id), $arreglo);
		}
		return $x;
	}

	public function empresas_lista($id){
		try{
			self::set_names();
			$sql="SELECT * FROM empresas where iddespacho=:iddespa";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":iddespa",$id);
			$sth->execute();
			$res=$sth->fetchAll();
			return $res;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
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
	public function guardar_empresa(){
		$x="";
		$id=$_REQUEST['id'];
		$iddespacho=$_REQUEST['iddespacho'];

		$arreglo =array();
		$arreglo+=array('iddespacho'=>$iddespacho);
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
		if (isset($_REQUEST['activo'])){
			$arreglo+=array('activo'=>$_REQUEST['activo']);
		}
		else{
			$arreglo+=array('activo'=>0);
		}

		if($id==0){
			$x.=$this->insert('empresas', $arreglo);
		}
		else{
			$x.=$this->update('empresas',array('idempresa'=>$id), $arreglo);
		}
		if(is_numeric($x)){
			return $iddespacho;
		}
		else{
			return $x;
		}
	}

	public function productos($id){
		try{
			parent::set_names();
			$sql="SELECT * FROM productos where iddespacho=:iddespa";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":iddespa",$id);
			$sth->execute();
			$res=$sth->fetchAll();
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
	public function guardar_producto(){
		$x="";
		$id=$_REQUEST['id'];
		$iddespacho=$_REQUEST['iddespacho'];

		$arreglo =array();
		$arreglo+=array('iddespacho'=>$iddespacho);

		if (isset($_REQUEST['producto'])){
			$arreglo+=array('producto'=>$_REQUEST['producto']);
		}
		if (isset($_REQUEST['pventa'])){
			$arreglo+=array('pventa'=>$_REQUEST['pventa']);
		}
		if($id==0){
			$x.=$this->insert('productos', $arreglo);
		}
		else{
			$x.=$this->update('productos',array('idproducto'=>$id), $arreglo);
		}
		if(is_numeric($x)){
			return $iddespacho;
		}
		else{
			return $x;
		}
	}
}



$db = new Despachos();
if(strlen($function)>0){
	echo $db->$function();
}
