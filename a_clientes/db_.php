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
	public function personal(){
		try{
			parent::set_names();
			if($_SESSION['tipousuario']=="administrativo"){
				$sql="SELECT * FROM personal where tipo='ejecutivo'";
			}
			else{
				$sql="SELECT * FROM personal where idpersona='".$_SESSION['idpersona']."' and tipo='ejecutivo'";
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
	public function comisionistas(){
		try{
			parent::set_names();
			if($_SESSION['tipousuario']=="administrativo"){
				$sql="SELECT * FROM comisionistas";
			}
			else{
				$sql="SELECT * FROM comisionistas";
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
	public function cliente_edit($id){
		try{
			parent::set_names();
			$sql="SELECT * FROM clientes where idcliente=:idcliente";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":idcliente",$id);
			$sth->execute();
			$res=$sth->fetch();
			return $res;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}
	public function razon($id){
		try{
			parent::set_names();
			$sql="SELECT * FROM clientes_razon where idcliente=:idcliente";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":idcliente",$id);
			$sth->execute();
			$res=$sth->fetchAll();
			return $res;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}
	public function razon_edit($id){
		try{
			parent::set_names();
			$sql="SELECT * FROM clientes_razon where idrazon=:idrazon";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":idrazon",$id);
			$sth->execute();
			$res=$sth->fetch();
			return $res;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}
	public function comi($id){
		try{
			parent::set_names();

			$sql="SELECT * FROM clientes_comi c LEFT OUTER JOIN comisionistas com ON c.idcomi = com.idcom where idcliente=:idcliente";

			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":idcliente",$id);
			$sth->execute();
			$res=$sth->fetchAll();
			return $res;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}
	public function comi_edit($id){
		try{
			parent::set_names();
			$sql="SELECT * FROM clientes_comi where idcomi=:idcomi";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":idcomi",$id);
			$sth->execute();
			$res=$sth->fetch();
			return $res;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}
	public function guardar_cliente(){
		$x="";
		parent::set_names();
		if (isset($_REQUEST['id'])){$id=$_REQUEST['id'];}
		$arreglo =array();
		if (isset($_REQUEST['cliente'])){
			$arreglo+=array('cliente'=>$_REQUEST['cliente']);
		}
		if (isset($_REQUEST['contacto'])){
			$arreglo+=array('contacto'=>$_REQUEST['contacto']);
		}
		if (isset($_REQUEST['rfc'])){
			$arreglo+=array('rfc'=>$_REQUEST['rfc']);
		}
		if (isset($_REQUEST['domicilio'])){
			$arreglo+=array('domicilio'=>$_REQUEST['domicilio']);
		}
		if (isset($_REQUEST['colonia'])){
			$arreglo+=array('colonia'=>$_REQUEST['colonia']);
		}
		if (isset($_REQUEST['ciudad'])){
			$arreglo+=array('ciudad'=>$_REQUEST['ciudad']);
		}
		if (isset($_REQUEST['municipio'])){
			$arreglo+=array('municipio'=>$_REQUEST['municipio']);
		}
		if (isset($_REQUEST['estado'])){
			$arreglo+=array('estado'=>$_REQUEST['estado']);
		}
		if (isset($_REQUEST['cp'])){
			$arreglo+=array('cp'=>$_REQUEST['cp']);
		}
		if (isset($_REQUEST['correo'])){
			$arreglo+=array('correo'=>$_REQUEST['correo']);
		}
		if (isset($_REQUEST['telefono'])){
			$arreglo+=array('telefono'=>$_REQUEST['telefono']);
		}
		if (isset($_REQUEST['idpersona'])){
			$arreglo+=array('idpersona'=>$_REQUEST['idpersona']);
		}
		if($id==0){
			$x.=$this->insert('clientes', $arreglo);
		}
		else{
			$x.=$this->update('clientes',array('idcliente'=>$id), $arreglo);
		}
		return $x;
	}
	public function guardar_razon(){
		$x="";
		parent::set_names();
		if (isset($_REQUEST['id'])){$id=$_REQUEST['id'];}
		$arreglo =array();
		if (isset($_REQUEST['razon'])){
			$arreglo+=array('razon'=>$_REQUEST['razon']);
		}
		if (isset($_REQUEST['idcliente'])){
			$idcliente=$_REQUEST['idcliente'];
			$arreglo+=array('idcliente'=>$idcliente);
		}

		if($id==0){
			$x.=$this->insert('clientes_razon', $arreglo);
		}
		else{
			$x.=$this->update('clientes_razon',array('idrazon'=>$id), $arreglo);
		}
		if(is_numeric($x)){
			return $idcliente;
		}
		else{
			return $x;
		}

	}
	public function guardar_comi(){
		$x="";
		parent::set_names();
		if (isset($_REQUEST['id'])){$id=$_REQUEST['id'];}
		$arreglo =array();
		if (isset($_REQUEST['comisionista'])){
			$arreglo+=array('comisionista'=>$_REQUEST['comisionista']);
		}
		if (isset($_REQUEST['comision'])){
			$arreglo+=array('comision'=>$_REQUEST['comision']);
		}
		if (isset($_REQUEST['idcliente'])){
			$idcliente=$_REQUEST['idcliente'];
			$arreglo+=array('idcliente'=>$idcliente);
		}

		if($id==0){
			$x.=$this->insert('clientes_comi', $arreglo);
		}
		else{
			$x.=$this->update('clientes_comi',array('idcomi'=>$id), $arreglo);
		}
		if(is_numeric($x)){
			return $idcliente;
		}
		else{
			return $x;
		}

	}

}

$db = new Clientes();
if(strlen($function)>0){
	echo $db->$function();
}
