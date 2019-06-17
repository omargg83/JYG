<?php
  require_once("db_operaciones.php");
  $valor=$_REQUEST['valor'];
  $row=$db->buscar_empresa($valor);
  echo "<table class='table table-sm'>";
  echo "<tr><th>-</th><th>Despacho</th><th>Razon</th><th>Empresa</th></tr>";
    foreach($row as $key){
      echo "<tr id='".$key['idempresa']."' class='edit-t'>";
        echo "<td>";
          echo "<button class='btn btn-outline-secondary btn-sm' id='seleccomision' title='Editar' onclick='seleccliente(".$key['idempresa'].")'><i class='fas fa-pencil-alt'></i></i></button>";
        echo "</td>";

        echo "<td>";
          echo $key['nombre'];
        echo "</td>";

        echo "<td>";
          echo $key['razon'];
        echo "</td>";

        echo "<td>";
          echo $key['rfc'];
        echo "</td>";


      echo "</tr>";
    }
  echo "</table>";
?>
