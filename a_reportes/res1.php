<?php
  require_once("db_.php");
  $row=$db->reporte_1();
	echo "<div class='container-fluid' style='background-color:".$_SESSION['cfondo']."; '>";
?>
<div class="content table-responsive table-full-width">
<table class='table' id='x_lista' style='font-size:10px'>
<thead><tr><th>#</th><th>Fecha</th><th>Cliente</th><th>Despacho</th><th>Esquema</th><th>Monto</th>
<th>% Comisión<br> Cli/Desp</th><th>Comisión<br> Cli/Desp</th><th>Retorno<br> Cli/Desp</th>
<th>% Comisión<br> J&G</th><th>Comisión<br> J&G</th><th>Retorno<br> J&G</th>

<th>Comisión</th><th>Retorno</th><th>Pikito</th>
<th>Ejecutivo</th><th>Estado</th></tr></thead>
<?php
  $monto_t=0;
  $com=0;
  $ret=0;
  $pik=0;
  foreach($row as $key){
    echo "<tr id=".$key['idoperacion']." class='edit-t";

    if($key["finalizar"]==0){
      echo " table-danger ";
    }
    echo "'>";

    echo "<td>";
    	echo "<button class='btn btn-outline-secondary btn-sm' id='edit_persona' title='Editar' data-lugar='a_operaciones/editar'><i class='fas fa-pencil-alt'></i>".$key['idoperacion']."</button>";
    echo "</td>";

    echo "<td>".fecha($key['fecha'])."</td>";

    echo "<td>".$key['cliente']."<br>".$key['razoncli']."</td>";
    echo "<td>".$key['razonemp']."<br>".$key['desp']."</td>";


    echo "<td>".$key['esquema']."</td>";
    echo "<td align='right'>".moneda($key['monto'])."</td>";
    $monto_t+=$key['monto'];

    echo "<td align='right'>".$key['comision']."</td>";
    echo "<td align='right'>".$key['tcomision']."</td>";
    echo "<td align='right'>".$key['retorno']."</td>";

    echo "<td align='right'>".$key['creal']."</td>";

    echo "<td align='right'>".$key['tcomision_r']."</td>";
    echo "<td align='right'>".$key['retorno_r']."</td>";

    echo "<td bgcolor='silver' align='right'><b>".$key['comision_f']."</b></td>";
    $com+=$key['comision_f'];

    echo "<td bgcolor='silver' align='right'><b>".$key['retorno_f']."</b></td>";
    $ret+=$key['retorno_f'];

    echo "<td bgcolor='silver' align='right'><b>".$key['pikito']."</b></td>";
    $pik+=$key['pikito'];

    echo "<td>".$key['nombre']."</td>";
    echo "<td>";
    if($key["finalizar"]==1){
        echo "Finalizada";
    }
    else{
      echo "En proceso";
    }
    echo "</td>";
    echo "</tr>";
  }
  echo "<tr>";
  echo "<td>Total</td>";
  echo "<td>-</td>";
  echo "<td>-</td>";
  echo "<td>-</td>";
  echo "<td>-</td>";
  echo "<td align='right'><b>".moneda($monto_t)."</b></td>";
  echo "<td>-</td>";
  echo "<td>-</td>";
  echo "<td>-</td>";
  echo "<td>-</td>";
  echo "<td>-</td>";
  echo "<td>-</td>";
  echo "<td align='right'><b>".moneda($com)."</b></td>";
  echo "<td align='right'><b>".moneda($ret)."</b></td>";
  echo "<td align='right'><b>".moneda($pik)."</b></td>";
  echo "<td>-</td>";
  echo "<td>-</td>";

  echo "</tr>";




?>
</table>
</div>
</div>


<script>
	$(document).ready( function () {
		lista("x_lista");
	});
</script>
