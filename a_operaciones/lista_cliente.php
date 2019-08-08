<?php
  require_once("db_operaciones.php");
  $valor=$_REQUEST['valor'];
  $row=$db->buscar_cliente($valor);
  echo "<table class='table table-sm'>";
  echo "<tr><th>-</th><th>Cliente</th><th>RFC</th><th>Razon</th></tr>";
    foreach($row as $key){
      echo "<tr id='".$key['idrazon']."' class='edit-t'>";
        echo "<td>";
          echo "<button class='btn btn-outline-secondary btn-sm' id='seleccomision' title='Seleccionar' onclick='seleccomision(".$key['idrazon'].")'><i class='fas fa-check'></i></i></button>";
        echo "</td>";

        echo "<td>";
          echo $key['cliente'];
        echo "</td>";

        echo "<td>";
          echo $key['rfc'];
        echo "</td>";

        echo "<td>";
          echo $key['razon'];
        echo "</td>";
      echo "</tr>";
    }
  echo "</table>";
?>
