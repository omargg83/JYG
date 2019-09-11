<?php
require_once("../control_db.php");
if (isset($_REQUEST['function'])){$function=$_REQUEST['function'];}	else{ $function="";}

class Personal extends Sagyc{
	public $nivel_personal;
	public $nivel_captura;

	public function __construct(){
		parent::__construct();
		$this->doc="a_personal/papeles/";

		if(isset($_SESSION['idpersona']) and $_SESSION['autoriza'] == 1) {

		}
		else{
			include "../error.php";
			die();
		}
	}
	public function personal(){
		try{
			parent::set_names();
			$sql="SELECT * FROM personal order by tipo";
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
	public function cambiar_user(){
		$personal = new Personal();
		if (isset($_REQUEST['id'])){$id=$_REQUEST['id'];}

		$sql="SELECT * FROM personal where idpersona='$id'";
		$sth = $this->dbh->prepare($sql);
		$sth->execute();
		$CLAVE=$sth->fetch();
		$_SESSION['autoriza']=1;
		$_SESSION['nombre']=$CLAVE['nombre'];
		$_SESSION['idfondo']=$CLAVE['idfondo'];
		$_SESSION['nick']=$CLAVE['nick'];
		$_SESSION['estudio']=$CLAVE['estudio'];
		$_SESSION['idpersona']=$CLAVE['idpersona'];
		$_SESSION['foto']=$CLAVE['file_foto'];
		$_SESSION['tipousuario']=$CLAVE['tipo'];
		$_SESSION['foco']=mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"));
		return 1;
	}
	public function guardar_personal(){
		$x="";
		if (isset($_REQUEST['id'])){$id=$_REQUEST['id'];}
		$arreglo =array();
		if (isset($_REQUEST['estudio'])){
			$arreglo+=array('estudio'=>$_REQUEST['estudio']);
		}
		if (isset($_REQUEST['nombre'])){
			$arreglo+=array('nombre'=>$_REQUEST['nombre']);
		}
		if (isset($_REQUEST['rfc'])){
			$rfc=$_REQUEST['rfc'];
			$arreglo+=array('rfc'=>$rfc);
		}

		if (isset($_REQUEST['cumple'])){
			$fx=explode("-",$_REQUEST['cumple']);
			$arreglo+=array('cumple'=>$fx['2']."-".$fx['1']."-".$fx['0']);
		}
		
		if (isset($_REQUEST['correo'])){
			$correo=$_REQUEST['correo'];
			$arreglo+=array('correo'=>$correo);
		}
		if (isset($_REQUEST['nick'])){
			$arreglo+=array('nick'=>$_REQUEST['nick']);
		}
		if (isset($_REQUEST['telefono'])){
			$arreglo+=array('telefono'=>$_REQUEST['telefono']);
		}
		if (isset($_REQUEST['puesto'])){
			$arreglo+=array('puesto'=>$_REQUEST['puesto']);
		}
		if (isset($_REQUEST['cuenta'])){
			$arreglo+=array('cuenta'=>$_REQUEST['cuenta']);
		}
		if (isset($_REQUEST['comision'])){
			$arreglo+=array('comision'=>$_REQUEST['comision']);
		}
		if (isset($_REQUEST['tipo'])){
			$arreglo+=array('tipo'=>$_REQUEST['tipo']);
		}

		if($id==0){
			$sql="select * from personal where correo='$correo' or rfc='$rfc'";
			$buscar=$personal->general($sql);
			if(count($buscar)==0){
				$arreglo+=array('autoriza'=>1);
				$x.=$this->insert('personal', $arreglo);
			}
			else{
				$x.="Ya existe usuario con esta información favor de verificar ";
			}
		}
		else{
			if($_SESSION['administrador']==1){
				if (isset($_REQUEST['autoriza'])){
					$arreglo+=array('autoriza'=>$_REQUEST['autoriza']);
				}
				else{
					$arreglo+=array('autoriza'=>0);
				}
			}

			$x.=$this->update('personal',array('idpersona'=>$id), $arreglo);
		}
		return $x;
	}
	public function password(){
		$personal = new Personal();
		if (isset($_REQUEST['id'])){$id=$_REQUEST['id'];}
		if (isset($_REQUEST['pass1'])){$pass1=$_REQUEST['pass1'];}
		if (isset($_REQUEST['pass2'])){$pass2=$_REQUEST['pass2'];}
		if(trim($pass1)==($pass2)){
			$arreglo=array();
			$passPOST=md5(trim($pass1));
			$arreglo=array('pass'=>$passPOST);
			$x=$personal->update('personal',array('idpersona'=>$id), $arreglo);
			return $x;
		}
		else{
			return "La contraseña no coincide";
		}
	}
	public function permisos(){
		$personal = new Personal();
		$x="";

		$arreglo =array();

		if (isset($_REQUEST['id'])) {
			$id=$_REQUEST['id'];
		}
		if (isset($_REQUEST['acceso'])) {
			$acceso=$_REQUEST['acceso'];
		}
		else{
			$acceso=0;
		}
		if (isset($_REQUEST['aplicacion'])) {
			$aplicacion=$_REQUEST['aplicacion'];
			$arreglo+=array('nombre'=>$_REQUEST['aplicacion']);
		}

		$arreglo+=array('acceso'=>$acceso);

		if (isset($_REQUEST['captura'])) $arreglo+=array('captura'=>$_REQUEST['captura']);
		if (isset($_REQUEST['nivelx'])) $arreglo+=array('nivel'=>$_REQUEST['nivelx']);

		$sql="select * from personal_permiso where idpersona='$id' and nombre='$aplicacion'";
		$a=$personal->general($sql);

		$arreglo+=array('idpersona'=>$id);

		if(count($a)>0){
			$x.=$personal->update('personal_permiso',array('idpermiso'=>$a[0]['idpermiso']),$arreglo);
		}
		else{
			$x.=$personal->insert('personal_permiso', $arreglo);
		}
		return $id;
	}
	public function borrapermiso(){
		$personal = new Personal();
		if (isset($_REQUEST['id'])){$id=$_REQUEST['id'];}
		return $personal->borrar('personal_permiso','idpermiso',$id);
	}

//////////////////////////////////////////////////////j&d
}

$db = new Personal();
if(strlen($function)>0){
	echo $db->$function();
}


?>
