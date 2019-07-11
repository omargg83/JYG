<?php
  require_once("db_.php");
  $row=$db->reporte_1();
	echo "<div class='container-fluid' style='background-color:".$_SESSION['cfondo']."; '>";
?>
<div class="content table-responsive table-full-width">
<table class='table' id='x_lista' style='font-size:10px'>
<thead><tr><th>Fecha</th><th>Subtotal</th><th>IVA</th><th>Monto</th><th>Ejecutivo</th></tr></thead>
<?php
  foreach($row as $key){
    ?>
    <tr>
    <td><?php echo fecha($key['fecha']); ?> </td>
    <td><?php echo moneda($key['subtotal']); ?> </td>
    <td><?php echo moneda($key['iva']); ?> </td>
    <td><?php echo moneda($key['monto']); ?> </td>
    <td><?php echo $key['nombre']; ?> </td>
    </tr>
<?php
  }
?>
</table>
</div>
</div>


<script>
	$(document).ready( function () {
		lista("x_lista");
	});
</script>
