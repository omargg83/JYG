<?php
require_once("db_.php");
$fecha=date("d-m-Y");
$nuevafecha = strtotime ( '-1 month' , strtotime ( $fecha ) ) ;
$fecha1 = date ( "d-m-Y" , $nuevafecha );
?>
<form id='consulta_avanzada' action='' data-destino='a_reportes/4_res' data-div='resultado' data-funcion='reporte_4' autocomplete='off'>
  <div class='container' >
    <div class='jumbotron'>
      <h5><center>Comisionistas</center></h5>
      <div class='row'>
        <div class='col-sm-3'>
            <label>Del</label>
            <input class="form-control fechaclass" placeholder="Desde...." type="text" id='desde' name='desde' value='<?php echo $fecha1; ?>' autocomplete="off">
        </div>

        <div class='col-sm-3'>
          <label>Al</label>
          <input class="form-control fechaclass" placeholder="Hasta...." type="text" id='hasta' name='hasta' value='<?php echo $fecha; ?>' autocomplete="off">
        </div>

      </div>

      <div class='row'>
        <div class='col-sm-4'>
          <div class='btn-group'>
            <button title='Buscar' class='btn btn-outline-primary' id='buscar_canalizado' type='submit' id='lista_buscar' data-lugar='a_corresp/lista' data-valor='buscar' data-funcion='buscar'><i class='fa fa-search'></i><span> Buscar</span></button>
          </div>
        </div>
      </div>

    </div>
  </div>
</form>

<div id='resultado'>

</div>

<script>
$(function() {
  fechas();
  $(document).ready( function () {
    $('table.datatable').DataTable({
      "pageLength": 100,
      "language": {
        "sSearch": "Buscar aqui",
        "lengthMenu": "Mostrar _MENU_ registros",
        "zeroRecords": "No se encontró",
        "info": " Página _PAGE_ de _PAGES_",
        "infoEmpty": "No records available",
        "infoFiltered": "(filtered from _MAX_ total records)",
        "paginate": {
          "first":      "Primero",
          "last":       "Ultimo",
          "next":       "Siguiente",
          "previous":   "Anterior"
        },
      }
    });
  });
});
</script>
