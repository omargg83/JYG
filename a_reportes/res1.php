<?php
  require_once("db_.php");
  $row=$db->reporte_1();
	echo "<div class='container-fluid' style='background-color:".$_SESSION['cfondo']."; '>";
?>
<div class="content table-responsive table-full-width">
<table class='table' id='x_lista' style='font-size:10px'>
<thead><tr><th>#</th><th>Fecha</th><th>Subtotal</th><th>IVA</th><th>Monto</th><th>Ejecutivo</th><th>Estado</th></tr></thead>
<?php
  foreach($row as $key){
    echo "<tr id=".$key['idoperacion']." class='edit-t'>";
    echo "<td>";
    	echo "<button class='btn btn-outline-secondary btn-sm' id='edit_persona' title='Editar' data-lugar='a_operaciones/editar'><i class='fas fa-pencil-alt'></i></button>";
    echo "</td>";
    ?>

    <td><?php echo fecha($key['fecha']); ?> </td>
    <td><?php echo moneda($key['subtotal']); ?> </td>
    <td><?php echo moneda($key['iva']); ?> </td>
    <td><?php echo moneda($key['monto']); ?> </td>
    <td><?php echo $key['nombre']; ?> </td>
    <?php
      echo "<td>";
      if($key["finalizar"]==1){
          echo "Finalizada";
      }
      else{
        echo "En proceso";
      }
      echo "</td>";
    ?>

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
