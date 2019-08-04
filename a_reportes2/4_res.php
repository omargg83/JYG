<?php
  require_once("db_.php");
  $row=$db->reporte_4();
	echo "<div class='container-fluid' style='background-color:".$_SESSION['cfondo']."; '>";
?>
<div class="content table-responsive table-full-width">
<table class='table' id='x_lista' style='font-size:10px'>

<thead><tr><th>#</th><th>Fecha</th><th>Gasto</th><th>Descripción</th><th>Costo</th>


</tr></thead>

<?php
  $monto_t=0;
  $com=0;
  $ret=0;
  $pik=0;
  foreach($row as $key){
    echo "<tr id=".$key['idgastos']." class='edit-t";

    if($key["finalizar"]==0){
      echo " table-danger ";
    }
    echo "'>";
    echo "<td>";
    	echo "<button class='btn btn-outline-secondary btn-sm' id='edit_persona' title='Editar' data-lugar='a_gastos/editar'><i class='fas fa-pencil-alt'></i>".$key['idgastos']."</button>";
    echo "</td>";
    echo "<td>".fecha($key['fecha'])."</td>";
    echo "<td>".$key['gasto']."</td>";
    echo "<td>".$key['descripcion']."</td>";
    $monto_t+=$key['costo'];
    echo "<td align='right'>".$key['costo']."</td>";
    echo "</tr>";
  }


  echo "<tr>";
  echo "<td>Total</td>";
  echo "<td>-</td>";
  echo "<td>-</td>";
  echo "<td>-</td>";
  echo "<td>-</td>";
  echo "<td>-</td>";
  echo "<td align='right'><b>".moneda($monto_t)."</b></td>";
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
