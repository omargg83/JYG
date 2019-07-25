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
				despachos.nombre,
				oper.finalizar
				FROM
				operaciones AS oper
				left outer JOIN clientes_razon ON oper.idrazon = clientes_razon.idrazon
				left outer JOIN clientes ON clientes_razon.idcliente = clientes.idcliente
				left outer JOIN empresas ON oper.idempresa = empresas.idempresa
				left outer JOIN despachos ON empresas.iddespacho = despachos.iddespacho
				where oper.finalizar=0;
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
				despachos.nombre,
				oper.finalizar
				FROM
				operaciones AS oper
				left outer JOIN clientes_razon ON oper.idrazon = clientes_razon.idrazon
				left outer JOIN clientes ON clientes_razon.idcliente = clientes.idcliente
				left outer JOIN empresas ON oper.idempresa = empresas.idempresa
				left outer JOIN despachos ON empresas.iddespacho = despachos.iddespacho
				where oper.idpersona='".$_SESSION['idpersona']."' and oper.finalizar=0 order by oper.fecha asc";
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
		$idrazon=$_REQUEST['idrazon'];
		$cli=$this->razon($idrazon);

		$arreglo=array();
		$arreglo+=array('id'=>$idrazon);
		$arreglo+=array('valor'=>$cli['cliente']." - ".$cli['razon']);
		return json_encode($arreglo);
	}
	public function guarda_empresa(){
		$x="";
		parent::set_names();
		$idempresa=$_REQUEST['idempresa'];
		$empresa=$this->empresa($idempresa);
		$arreglo=array();
		$arreglo+=array('id'=>$idempresa);
		$arreglo+=array('valor'=>$empresa['nombre']." - ".$empresa['razon']);
		$arreglo+=array('comision'=>$empresa['comision']);
		return json_encode($arreglo);
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
	public function uso(){
		try{
			parent::set_names();
			$sql="SELECT * FROM sat_uso order by descripcion";
			$sth = $this->dbh->prepare($sql);
			$sth->execute();
			return $sth->fetchAll();
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}
	public function forma_buscar(){
		try{
			parent::set_names();
			$sql="SELECT * FROM sat_fpago order by pago";
			$sth = $this->dbh->prepare($sql);
			$sth->execute();
			return $sth->fetchAll();
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
		if (isset($_REQUEST['subtotal'])){
			$arreglo+=array('subtotal'=>$_REQUEST['subtotal']);
		}
		if (isset($_REQUEST['iva'])){
			$arreglo+=array('iva'=>$_REQUEST['iva']);
		}
		if (isset($_REQUEST['idrazon'])){
			$idrazon=$_REQUEST['idrazon'];
			$arreglo+=array('idrazon'=>$idrazon);
		}

		if (isset($_REQUEST['idempresa'])){
			$arreglo+=array('idempresa'=>$_REQUEST['idempresa']);
		}
		if (isset($_REQUEST['comision'])){
			$arreglo+=array('comision'=>$_REQUEST['comision']);
		}
		if (isset($_REQUEST['esquema'])){
			$arreglo+=array('esquema'=>$_REQUEST['esquema']);
		}
		if (isset($_REQUEST['esquema2'])){
			$arreglo+=array('esquema2'=>$_REQUEST['esquema2']);
		}

		$creal=0;
		if (isset($_REQUEST['creal'])){
			$creal=$_REQUEST['creal'];
			$arreglo+=array('creal'=>$creal);
		}

		$tcomision=0;
		$retorno=0;
		if (isset($_REQUEST['tcomision'])){
			$com=$_REQUEST['tcomision'];
			$tcomision_f=$com;
			$arreglo+=array('tcomision'=>$com);
		}
		if (isset($_REQUEST['retorno'])){
			$ret=$_REQUEST['retorno'];
			$retorno_f=$ret;
			$arreglo+=array('retorno'=>$ret);
		}

		if (isset($_REQUEST['tcomision_r'])){
			$com=$_REQUEST['tcomision_r'];
			if($creal>0){
				$tcomision_f=$com;
			}
			$arreglo+=array('tcomision_r'=>$com);
		}
		if (isset($_REQUEST['retorno_r'])){
			$ret=$_REQUEST['retorno_r'];
			if($creal>0){
				$retorno_f=$ret;
			}
			$arreglo+=array('retorno_r'=>$ret);
		}

		if (isset($_REQUEST['pikito'])){
			$arreglo+=array('pikito'=>$_REQUEST['pikito']);
		}
		if (isset($_REQUEST['comdespa'])){
			$arreglo+=array('comdespa'=>$_REQUEST['comdespa']);
		}
		if (isset($_REQUEST['comdespa_t'])){
			$arreglo+=array('comdespa_t'=>$_REQUEST['comdespa_t']);
		}
		if (isset($_REQUEST['req_contrato'])){
			$arreglo+=array('req_contrato'=>$_REQUEST['req_contrato']);
		}
		else{
			$arreglo+=array('req_contrato'=>0);
		}

		$arreglo+=array('comision_f'=>$tcomision_f);
		$arreglo+=array('retorno_f'=>$retorno_f);

		if (isset($_REQUEST['comisionistas'])){
			$comisionistas=$_REQUEST['comisionistas'];
			$arreglo+=array('comisionistas'=>$comisionistas);
		}
		if($id==0){
			$arreglo+=array('idpersona'=>$_SESSION['idpersona']);
			$id=$this->insert('operaciones', $arreglo);
		}
		else{
			$id=$this->update('operaciones',array('idoperacion'=>$id), $arreglo);
		}

		//////////////////////////comisionistas
			$cliente=$this->razon($idrazon);
			$comis=$this->comisionista($cliente['idcliente']);
			foreach ($comis as $key) {
				$sql="select * from operaciones_comi where idoperacion='$id' and idcom='".$key['idcom']."'";
				$seek=$this->general($sql);
				$total=($key['comision']*$comisionistas)/100;
				$arreglo =array();
				$arreglo+=array('porcentaje'=>$key['comision']);
				$arreglo+=array('monto'=>$total);
				if(count($seek)==0){
					$arreglo+=array('idcom'=>$key['idcom']);
					$arreglo+=array('idoperacion'=>$id);
					$x.=$this->insert('operaciones_comi', $arreglo);
				}
				else{
					$x.=$this->update('operaciones_comi',array('idoperacion'=>$id,'idcom'=>$key['idcom']), $arreglo);
				}
			}
		//////////////////////////fin de comisionistas
		return $id;
	}
	public function guardar_factura(){
		$x="";
		parent::set_names();
		if (isset($_REQUEST['id'])){$id=$_REQUEST['id'];}

		$arreglo =array();
		$idoperacion=$_REQUEST['idoper_fact'];
		$arreglo+=array('idoperacion'=>$idoperacion);


		if (isset($_REQUEST['fecha_fact'])){
			$fx=explode("-",$_REQUEST['fecha_fact']);
			$arreglo+=array('fecha'=>$fx['2']."-".$fx['1']."-".$fx['0']);
		}
		$monto=0;
		if (isset($_REQUEST['monto_fact'])){
			$monto=$_REQUEST['monto_fact'];
			$arreglo+=array('monto'=>$monto);
		}

		if (isset($_REQUEST['subtotal_fact'])){
			$arreglo+=array('subtotal'=>$_REQUEST['subtotal_fact']);
		}

		if (isset($_REQUEST['iva_fact'])){
			$arreglo+=array('iva'=>$_REQUEST['iva_fact']);
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

		$pers = $this->operacion_edit($idoperacion);
		$esquema=$pers['esquema'];
		$creal=$pers['creal'];
		$retorno=$pers['retorno'];

		$llave=1;
		if($esquema<5){
			if($creal>0){
				$retorno=$pers['retorno_r'];
			}
			$sql="select sum(monto) as monto from facturas where idoperacion=$idoperacion";
			$fact=$this->general($sql);
			$total=$fact[0]['monto']+$monto;
			if($retorno<$total){
				$x.="Revisar monto de facturas<br>";
				$llave=0;
			}
		}

		if($llave==1){
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
		else{
			return $x;
		}
	}
	public function guardar_retorno(){
		$x="";
		parent::set_names();
		if (isset($_REQUEST['id'])){$id=$_REQUEST['id'];}
		$idoperacion=$_REQUEST['idoper_fact'];
		$pers = $this->operacion_edit($idoperacion);
		$esquema=$pers['esquema'];
		$comdespa=$pers['comdespa'];
		$idrazon=$pers['idrazon'];

		$arreglo =array();
		$arreglo+=array('idoperacion'=>$idoperacion);

		if (isset($_REQUEST['idproducto_selx'])){
			$arreglo+=array('idproducto'=>$_REQUEST['idproducto_selx']);
		}
		if (isset($_REQUEST['fecha_fact'])){
			$fx=explode("-",$_REQUEST['fecha_fact']);
			$arreglo+=array('fecha'=>$fx['2']."-".$fx['1']."-".$fx['0']);
		}

		if (isset($_REQUEST['folio'])){
			$arreglo+=array('folio'=>$_REQUEST['folio']);
		}
		if (isset($_REQUEST['persona'])){
			$arreglo+=array('persona'=>$_REQUEST['persona']);
		}
		if (isset($_REQUEST['empresa'])){
			$arreglo+=array('empresa'=>$_REQUEST['empresa']);
		}
		if (isset($_REQUEST['lugar'])){
			$arreglo+=array('lugar'=>$_REQUEST['lugar']);
		}
		$monto=0;
		if (isset($_REQUEST['monto_ret'])){
			$monto=$_REQUEST['monto_ret'];
			$arreglo+=array('monto'=>$monto);
		}

		if (isset($_REQUEST['comision_ret'])){
			$arreglo+=array('comision'=>$_REQUEST['comision_ret']);
		}
		if (isset($_REQUEST['tcomision_retcli'])){
			$arreglo+=array('tcomision'=>$_REQUEST['tcomision_retcli']);
		}
		if (isset($_REQUEST['retorno_retcli'])){
			$arreglo+=array('retorno'=>$_REQUEST['retorno_retcli']);
		}

		$creal_ret=0;
		if (isset($_REQUEST['creal_ret'])){
			$creal_ret=$_REQUEST['creal_ret'];
			$arreglo+=array('creal'=>$creal_ret);
		}
		if (isset($_REQUEST['tcomision_retjg'])){
			$arreglo+=array('tcomisionjg'=>$_REQUEST['tcomision_retjg']);
		}
		if (isset($_REQUEST['retorno_retjg'])){
			$arreglo+=array('retornojg'=>$_REQUEST['retorno_retjg']);
		}


		$creal=$pers['creal'];
		$retorno=$pers['retorno'];
		$llave=1;
		if($esquema<5){
			if($creal>0){
				$retorno=$pers['retorno_r'];
			}
			$sql="select sum(monto) as monto from retorno where idoperacion=$idoperacion";
			$ret=$this->general($sql);
			$total=$ret[0]['monto']+$monto;
			if($retorno<$total){
				$x.="Revisar monto de retornos<br>";
				$llave=0;
			}
		}

		if($llave==1){
			if($id==0){
				$x.=$this->insert('retorno', $arreglo);
			}
			else{
				$x.=$this->update('retorno',array('idretorno'=>$id), $arreglo);
			}
			if($esquema==5){
				$sql="select sum(tcomision) as scomision, sum(retorno) as sretorno,
				sum(if(creal=0,tcomision,tcomisionjg)) stcomisionjg,
				sum(if(creal=0,retorno,retornojg)) sretornojg
				from retorno where idoperacion=$idoperacion";

				$val=$this->general($sql);
				$arreglo=array();

				$arreglo+=array('tcomision'=>$val[0]['scomision']);
				$arreglo+=array('retorno'=>$val[0]['sretorno']);

				$arreglo+=array('tcomision_r'=>$val[0]['stcomisionjg']);
				$arreglo+=array('retorno_r'=>$val[0]['sretornojg']);

				$pikito=$val[0]['sretorno']-$val[0]['sretornojg'];
				$arreglo+=array('pikito'=>$pikito);

				$comdesp=($val[0]['scomision']*$comdespa)/100;
				$arreglo+=array('comdespa_t'=>$comdesp);

				$comisionistas=($val[0]['stcomisionjg']-$comdesp);
				$arreglo+=array('comisionistas'=>$comisionistas);

				$sql="select SUM(if(creal=0,tcomision,tcomisionjg)) com_total, SUM(if(creal=0,retorno,retornojg)) ret_total from retorno where idoperacion=$idoperacion";
				$total=$this->general($sql);

				$arreglo+=array('comision_f'=>$total[0]['com_total']);
				$arreglo+=array('retorno_f'=>$total[0]['ret_total']);
				$this->update('operaciones',array('idoperacion'=>$idoperacion), $arreglo);


				//////////////////////////comisionistas
					$cliente=$this->razon($idrazon);
					$comis=$this->comisionista($cliente['idcliente']);
					foreach ($comis as $key) {
						$sql="select * from operaciones_comi where idoperacion='$idoperacion' and idcom='".$key['idcom']."'";
						$seek=$this->general($sql);
						$total=($key['comision']*$comisionistas)/100;
						$arreglo =array();
						$arreglo+=array('porcentaje'=>$key['comision']);
						$arreglo+=array('monto'=>$total);
						if(count($seek)==0){
							$arreglo+=array('idcom'=>$key['idcom']);
							$arreglo+=array('idoperacion'=>$idoperacion);
							$x.=$this->insert('operaciones_comi', $arreglo);
						}
						else{
							$x.=$this->update('operaciones_comi',array('idoperacion'=>$idoperacion,'idcom'=>$key['idcom']), $arreglo);
						}
					}
				//////////////////////////fin de comisionistas
			}

			if(is_numeric($x)){
				return $idoperacion;
			}
			else{
				return $x;
			}
		}
		else{
			return $x;
		}
	}
	public function producto_tipo(){
		$x="";
		$idproducto=$_REQUEST['idproducto'];
		$val=$this->producto_edit($idproducto);
		$pventa=$val['pventa'];

		$arreglo=array();
		$arreglo=array('pventa'=>$pventa);

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
		if (isset($_REQUEST['id'])){$id=$_REQUEST['id'];}
		return $this->borrar('retorno',"idretorno",$id);
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
	public function opercomisionista($id){
		try{
			parent::set_names();
			$sql="SELECT * FROM operaciones_comi left outer join comisionistas on comisionistas.idcom=operaciones_comi.idcom where idoperacion=:id";
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
	public function operadores($id){
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
	public function guardar_operador(){
		$x="";
		parent::set_names();
		if (isset($_REQUEST['id'])){$id=$_REQUEST['id'];}
		$arreglo =array();
		$arreglo+=array('idoper'=>$_REQUEST['idoper']);
		if($id==0){
			$arreglo+=array('idoperacion'=>$_REQUEST['idoperacion']);
			$x.=$this->insert('operaciones_oper', $arreglo);
		}
		else{
			$x.=$this->update('operaciones_oper',array('id'=>$id), $arreglo);
		}
		return $_REQUEST['idoperacion'];
	}
	public function operadores_oper($id){
		try{
			parent::set_names();
			$sql="SELECT * FROM operaciones_oper left outer join despachos_oper on despachos_oper.idoper=operaciones_oper.idoper where idoperacion=:idoperacion";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":idoperacion",$id);
			$sth->execute();
			$res=$sth->fetchAll();
			return $res;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}
	public function borrar_operador(){
		if (isset($_REQUEST['id'])){$id=$_REQUEST['id'];}
		return $this->borrar('operaciones_oper',"id",$id);
	}
	public function operador_edit($id){
		try{
			self::set_names();
			$sql="SELECT * FROM despachos_oper where idoper=:id";
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
	public function notificar(){
		$cal = new Sagyc();
		$x="";
		require '../librerias15/PHPMailer-5.2-stable/PHPMailerAutoload.php';

		$telefono="";
		if (isset($_REQUEST['correo'])){$correo=$_REQUEST['correo'];}
		if (isset($_REQUEST['texto'])){$texto=$_REQUEST['texto'];}
		if (isset($_REQUEST['file'])){$file=$_REQUEST['file'];}
		if (isset($_REQUEST['file_ret'])){$file_ret=$_REQUEST['file_ret'];}


		$x.=$correo;
		$mail = new PHPMailer;
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = "mail.sagyc2.com.mx";						  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = "sistema_jyg@sagyc2.com.mx";       // SMTP username
		$mail->Password = "sagyc123$";                       // SMTP password
		$mail->SMTPSecure = "ssl";                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 465;                                    // TCP port to connect to
		$mail->CharSet = 'UTF-8';

		$mail->From = "sistema_jyg@sagyc2.com.mx";
		$mail->FromName = "Sistema JYG";
		$mail->Subject = "Notificacion";
		$mail->AltBody = "Notificacion2";
		$mail->addAddress($correo);     // Add a recipient
		//$mail->addCC('omargg83@gmail.com');

		// $mail->addAddress('ellen@example.com');               // Name is optional
		// $mail->addReplyTo('info@example.com', 'Information');
		// $mail->addCC('cc@example.com');
		// $mail->addBCC('bcc@example.com');
		if(strlen($file)>0){
			$mail->addAttachment("../".$file,"Solicitud.pdf");         // Add attachments
		}
		if(strlen($file_ret)>0){
			$mail->addAttachment("../".$file_ret,"Retorno.pdf");         // Add attachments
		}
		$mail->isHTML(true);

		$mail->Body    = $texto;
		$mail->AltBody = "Solicitud";

		if(!$mail->send()) {
				$x.= 'Message could not be sent.';
				$x.= 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
				$x= 'Se envío correo correctamente';
		}
		return $x;
	}
	public function finalizar(){
		$x="";
		parent::set_names();
		$arreglo =array();

		if (isset($_REQUEST['id'])){$id=$_REQUEST['id'];}
		$pers = $this->operacion_edit($id);
		$monto=$pers['monto'];
		$comision=$pers['comision'];
		$creal=$pers['creal'];
		$esquema=$pers['esquema'];
		$retorno=$pers['retorno'];
		$req_contrato=$pers['req_contrato'];
		$contrato=$pers['contrato'];
		$actualiza=0;

		$sql="select sum(monto) as monto from facturas where idoperacion=$id";
		$fact=$this->general($sql);

		if($esquema<5){
			if($creal>0){
				$retorno=$pers['retorno_r'];
			}
			$sql="select sum(monto) as monto from facturas where idoperacion=$id";
			$fact=$this->general($sql);

			$sql="select sum(monto) as monto from retorno where idoperacion=$id";
			$ret=$this->general($sql);

			if($retorno==$fact[0]['monto'] and $retorno==$ret[0]['monto']){
				$actualiza=1;
			}
			else{
				if($retorno!=$fact[0]['monto']){
					$x.="Revisar monto de facturas<br>";
				}
				if($retorno!=$ret[0]['monto']){
					$x.="Revisar monto de retornos<br>";
				}
			}
		}
		if($esquema==5){
			$com=$pers['comision_f'];
			$ret=$pers['retorno_f'];
			//////////////////////falta esto
			$acumulado=$com+$ret;
			if($acumulado==$monto and $fact[0]['monto']==$ret){
				$actualiza=1;
			}
			else{
				if($acumulado!=$monto){
					$x.="Verificar montos de retorno<br>";
				}
				if($fact[0]['monto']!=$ret){
					$x.="Verificar montos de facturas<br>";
				}
			}
		}
		if($req_contrato==1){
			if(strlen($contrato)<2 or !file_exists("../".$this->doc.trim($contrato))){
				$actualiza=0;
				$x.="Falta contrato";
			}
		}

		if($actualiza==1){
			$arreglo+=array('finalizar'=>1);
			$arreglo+=array('idper_fin'=>$_SESSION['idpersona']);
			$x.=$this->update('operaciones',array('idoperacion'=>$id), $arreglo);
		}
		return $x;
	}
	public function buscar($texto){
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
				despachos.nombre,
				oper.finalizar
				FROM
				operaciones AS oper
				left outer JOIN clientes_razon ON oper.idrazon = clientes_razon.idrazon
				left outer JOIN clientes ON clientes_razon.idcliente = clientes.idcliente
				left outer JOIN empresas ON oper.idempresa = empresas.idempresa
				left outer JOIN despachos ON empresas.iddespacho = despachos.iddespacho
				where
				oper.idoperacion like '%$texto%' OR clientes.cliente like '%$texto%' OR clientes_razon.razon like '%$texto%' OR empresas.razon like '%$texto%' OR despachos.nombre like '%$texto%'
				order by oper.fecha asc limit 100";
			}
			else{
				$sql="SELECT
				oper.idoperacion,
				oper.fecha,
				oper.monto,
				clientes_razon.razon as razoncli,
				clientes.cliente,
				empresas.razon as razonemp,
				despachos.nombre,
				oper.finalizar
				FROM
				operaciones AS oper
				left outer JOIN clientes_razon ON oper.idrazon = clientes_razon.idrazon
				left outer JOIN clientes ON clientes_razon.idcliente = clientes.idcliente
				left outer JOIN empresas ON oper.idempresa = empresas.idempresa
				left outer JOIN despachos ON empresas.iddespacho = despachos.iddespacho
				where oper.idpersona='".$_SESSION['idpersona']."' and
				(oper.idoperacion like '%$texto%' OR clientes.cliente like '%$texto%' OR clientes_razon.razon like '%$texto%' OR empresas.razon like '%$texto%' OR despachos.nombre like '%$texto%')
				order by oper.fecha asc limit 100";
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

$db = new Operaciones();
if(strlen($function)>0){
	echo $db->$function();
}
