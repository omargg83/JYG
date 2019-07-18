<?php
  require_once("db_.php");
  $row=$db->reporte_2();
	echo "<div class='container-fluid' style='background-color:".$_SESSION['cfondo']."; '>";
?>
<div class="content table-responsive table-full-width">
<table class='table' id='x_lista' style='font-size:10px'>

<thead><tr><th>#</th><th>Operación</th><th>Fecha</th><th>Cliente</th><th>Despacho</th>
<th>Descripción</th><th>Uso</th><th>Forma</th><th>Producto</th><th>Monto</th>

</tr></thead>
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
    echo "<td>".$key['idoperacion']."</td>";
    echo "<td>".fecha($key['fecha'])."</td>";

    echo "<td>".$key['cliente']."<br>".$key['razoncli']."</td>";
    echo "<td>".$key['razonemp']."<br>".$key['desp']."</td>";
    echo "<td>".$key['descripcion']."</td>";

    $monto_t+=$key['monto'];

    echo "<td>".$key['uso']."</td>";
    echo "<td>".$key['forma']."</td>";
    echo "<td>".$key['producto']."</td>";
    echo "<td align='right'>".$key['monto']."</td>";


    echo "</tr>";
  }
  echo "<tr>";
  echo "<td>Total</td>";
  echo "<td>-</td>";
  echo "<td>-</td>";
  echo "<td>-</td>";
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
