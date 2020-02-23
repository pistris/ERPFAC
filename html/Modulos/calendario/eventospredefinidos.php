<?php
  session_start();
  if (!isset($_SESSION['usuario'])) {
    header("Location:login.html");
    exit(0);
  }
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calendario de Eventos</title>

  <link href="bootstrap-4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <link href="datatables/datatables.min.css" rel="stylesheet">
  <link href="clockpicker/bootstrap-clockpicker.css" rel="stylesheet">

  <script src="js/jquery-3.4.1.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="bootstrap-4.3.1/js/bootstrap.min.js"></script>
  <script src="datatables/datatables.min.js"></script>
  <script src="clockpicker/bootstrap-clockpicker.js"></script>
  <script src='js/moment-with-locales.js'></script>
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2 style="text-align:center">Administración de eventos predefinidos</h2>
        <table class="table table-striped table-bordered table-hover" id="tabla1">
          <thead>
            <tr>
              <td>Evento</td>
              <td>titulo</td>
              <td>Color de<br>texto</td>
              <td>Color de<br> fondo</td>
              <td>Hora de<br>inicio</td>
              <td>Hora de<br>fin</td>
              <td>Borrar</td>
            </tr>
          </thead>
        </table>

        <!-- FormularioEventosPredefinidos -->
        <div class="modal fade" id="FormularioEventosPredefinidos" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label>Evento predefinido:</label>
                    <input type="text" id="Titulo" name="Titulo" class="form-control" placeholder="">
                  </div>
                </div>

                <div class="form-group">
                  <label>Color de fondo:</label>
                  <input type="color" value="#3788D8" id="ColorFondo" class="form-control" style="height:36px;">
                </div>
                <div class="form-group">
                  <label>Color de texto:</label>
                  <input type="color" value="#ffffff" id="ColorTexto" class="form-control" style="height:36px;">
                </div>

                <div class="form-group">
                  <label>Hora de inicio:</label>

                  <div class="input-group clockpicker" data-autoclose="true">
                    <input type="text" id="HoraInicio" value="" class="form-control" autocomplete="off" />
                  </div>
                </div>
                <div class="form-group">
                  <label>Hora de fin:</label>

                  <div class="input-group clockpicker" data-autoclose="true">
                    <input type="text" id="HoraFin" value="" class="form-control" autocomplete="off" />
                  </div>
                </div>
              </div>
              <div class="modal-footer">

                <button type="submit" id="BotonConfirmarAgregar" class="btn btn-success">Confirmar</button>
                <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>

              </div>
            </div>
          </div>
        </div>

        <div><button type="button" id="BotonAgregar" class="btn btn-success">Agregar evento predefinido</button></div>
        <hr>
        <div style="text-align:center"><button type="button" id="BotonSalir" class="btn btn-success">Retornar al
            calendario</button>
        </div>

      </div>
    </div>
  </div>

  <script>

    document.addEventListener('DOMContentLoaded', function () {

      $('.clockpicker').clockpicker();
            
      let tabla1 = $('#tabla1').DataTable({
        "ajax": {
          url: 'datoseventospredefinidos.php?accion=listar',
          dataSrc: ""
        },
        "columns": [{
          "data": "codigo"
        },
        {
          "data": "titulo"
        },
        {
          "data": "colortexto"
        },
        {
          "data": "colorfondo"
        },
        {
          "data": "horainicio"
        },
        {
          "data": "horafin"
        },
        {
          "data": null,
          "orderable": false
        }
        ],
        columnDefs: [{
          targets: -1,
          className: 'dt-body-center',
          "defaultContent": "<button class='btn btn-sm btn-danger botonborrar'>Borra?</button>",
          data: null
        }, {
          targets: 1,
          className: 'dt-body-center'
        },
        {
          targets: 2,
          className: 'dt-body-center'
        }
        ],
        'rowCallback': function (row, data, index) {
          $(row).find('td:eq(1)').css('color', data.colortexto);
          $(row).find('td:eq(1)').css('background-color', data.colorfondo);
        },
        "language": {
          "url": "datatables/spanish.json",
        },
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "Todos"]
        ],
      });


      $('#tabla1 tbody').on('click', 'button.botonborrar', function () {
        if (confirm("Realmente quiere borrar el evento predefinido?")) {
          let registro = tabla1.row($(this).parents('tr')).data();
          borrarRegistro(registro);
        }
      });


      //Eventos de botones de la aplicación
      $('#BotonAgregar').click(function () {
        limpiarFormulario();
        $("#FormularioEventosPredefinidos").modal();
      });

      $('#BotonConfirmarAgregar').click(function () {
        let registro = recuperarDatosFormulario();
        agregarRegistro(registro);
        $("#FormularioEventosPredefinidos").modal('hide');
      });

      $('#BotonSalir').click(function () {
        window.location = "index.php";
      });

      // funciones para comunicarse con el servidor via ajax
      function agregarRegistro(registro) {
        $.ajax({
          type: 'POST',
          url: 'datoseventospredefinidos.php?accion=agregar',
          data: registro,
          success: function (msg) {
            tabla1.ajax.reload();
          },
          error: function (error) {
            alert("Hay un problema:" + error);
          }
        });
      }

      function borrarRegistro(registro) {
        $.ajax({
          type: 'POST',
          url: 'datoseventospredefinidos.php?accion=borrar',
          data: registro,
          success: function (msg) {
            tabla1.ajax.reload();
          },
          error: function (error) {
            alert("Hay un problema:" + error);
          }
        });
      }


      // funciones que interactuan con el formulario de entrada de datos
      function limpiarFormulario() {
        $('#Titulo').val('');
        $('#HoraInicio').val('');
        $('#HoraFin').val('');
        $('#ColorFondo').val('#3788D8');
        $('#ColorTexto').val('#ffffff');

      }

      function recuperarDatosFormulario() {
        let registro = {
          titulo: $('#Titulo').val(),
          horainicio: $('#HoraInicio').val(),
          horafin: $('#HoraFin').val(),
          colorfondo: $('#ColorFondo').val(),
          colortexto: $('#ColorTexto').val()
        };
        return registro;
      }


    });
  </script>

</body>

</html>