<!doctype html>
<html>

<head>
  <title>Administración de categorías</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="../../SRC/css/bootstrap.min.css">
  <script src="../../SRC/js/jquery.min.js"></script>
  <script src="../../SRC/js/popper.min.js"></script>
  <script src="../../SRC/js/bootstrap.min.js"></script>

</head>
 
<body>

  <div class="container">
    <h1>Administracion de Categorias</h1>

    <table class="table table-striped">
      <thead>
        <tr>
          <th>Código</th>
          <th>Descripcion</th>
          <th>Edición</th>
        </tr>
      </thead>
      <tbody id="datos">
      </tbody>      
    </table>

    <button type="button" id="btnAgregar" class="btn btn-success">Agregar</button>
    <hr>
    <button type="button" id="btnFinalizar" class="btn btn-success">Finalizar</button>
  </div>

  <div class="modal fade" id="ModalEditar" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="Codigo">
          <div class="form-row">
            <div class="form-group col-md-12">
              <label>Descripción:</label>
              <input type="text" id="Descripcion" class="form-control" placeholder="">
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" id="btnConfirmarAgregar" class="btn btn-success">Agregar</button>
          <button type="button" id="btnModificar" class="btn btn-success">Modificar</button>
          <button type="button" id="btnBorrar" class="btn btn-success">Borrar</button>
          <button type="button" data-dismiss="modal" class="btn btn-success">Cancelar</button>
        </div>
      </div>
    </div>
  </div>


  <!-- ModalConfirmarCancelar -->
  <div class="modal fade" id="ModalConfirmarBorrar" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="max-width: 600px" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1>Realmente quiere borrarlo?</h1>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-footer">
          <button type="button" id="btnConfirmarBorrado" class="btn btn-success">Confirmar</button>
          <button type="button" data-dismiss="modal" class="btn btn-success">Cancelar</button>
        </div>
      </div>
    </div>
  </div>


  <script>
    document.addEventListener("DOMContentLoaded", function() {

      var categoria;
      MostrarCategorias();

      //Boton que vuelve a la página principal
      $('#btnFinalizar').click(function() {
        window.location = '../../index.php';
      });

      //Boton que muestra el diálogo de agregar
      $('#btnAgregar').click(function() {
        LimpiarFormulario();
        $('#btnConfirmarAgregar').show();
        $('#btnModificar').hide();
        $('#btnBorrar').hide();
        $("#ModalEditar").modal();
      });

      $('#btnConfirmarAgregar').click(function() {
        RecolectarDatosFormulario();
        if (!EntradaFormularioCorrecto())
          return;
        $("#ModalEditar").modal('hide');
        EnviarInformacion("agregar");
      });

      $('#btnBorrar').click(function() {
        $("#ModalEditar").modal('hide');
        $("#ModalConfirmarBorrar").modal();
      });


      $('#btnConfirmarBorrado').click(function() {
        $("#ModalConfirmarBorrar").modal('hide');
        RecolectarDatosFormulario();
        $("#ModalEditar").modal('hide');
        EnviarInformacion("borrar");
      });

      $('#btnModificar').click(function() {
        RecolectarDatosFormulario();
        if (!EntradaFormularioCorrecto())
          return;
        $("#ModalEditar").modal('hide');
        EnviarInformacion("modificar");
      });
      //******************************************************* 

      function MostrarCategorias() {
        $.ajax({
          type: 'GET',
          url: 'ProCategoriaProductos.php?accion=listar',
          success: function(categorias) {
            let filas = '';
            for (let categoria of categorias) {
              filas += '<tr><td>' + categoria.codigo + '</td><td>' + categoria.descripcion + '</td>';
              filas += '<td><a class="btn btn-primary botoneditar" role="button" href="#" data-codigo="' + categoria.codigo + '">Edita?</a> </td></tr>';
            }
            $('#datos').html(filas);
            //Boton que muestra el diálogo de modificar y borrar
            $('.botoneditar').click(function() {
              $('#Codigo').val($(this).get(0).dataset.codigo);
              RecolectarDatosFormulario();
              RecuperarCategoria("recuperar");
              $('#btnConfirmarAgregar').hide();
              $('#btnModificar').show();
              $('#btnBorrar').show();
              $("#ModalEditar").modal();
            });

          },
          error: function() {
            alert("Hay un error ..");
          }
        });
      }

      //Funciones AJAX para enviar y recuperar datos del servidor
      //******************************************************* 
      function EnviarInformacion(accion) {
        $.ajax({
          type: 'POST',
          url: 'ProCategoriaProductos.php?accion=' + accion,
          data: categoria,
          success: function(msg) {
            MostrarCategorias();
          },
          error: function() {
            alert("Hay un error ..");
          }
        });
      }

      function RecuperarCategoria(accion) {
        $.ajax({
          type: 'POST',
          url: 'ProCategoriaProductos.php?accion=' + accion,
          data: categoria,
          success: function(datos) {
            $('#Descripcion').val(datos[0]['descripcion']);
          },
          error: function() {
            alert("Hay un error ..");
          }
        });
      }
      //******************************************************* 

      function RecolectarDatosFormulario() {
        categoria = {
          codigo: $('#Codigo').val(),
          descripcion: $('#Descripcion').val()
        };
      }

      function LimpiarFormulario() {
        $('#Codigo').val('');
        $('#Descripcion').val('');
      }

      function EntradaFormularioCorrecto() {
        if (categoria['descripcion'] == '') {
          alert("No Puede estar vacía la descripción");
          return false;
        }
        return true;
      }

    });
  </script>

</body>

</html>