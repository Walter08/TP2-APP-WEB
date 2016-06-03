@extends('layouts.app')
@section('content')

<link rel="stylesheet" href="/css/bootstrap3-wysihtml5.min.css">
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Notas PDF</th>
                        <th>Descargar</th>
                        <th>Enviar Nota</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notas as $n)
                        <?php $url = '/misNotas/'.$n->id ?>
                        <tr>
                            <td>{{ $n->pdf }}</td>
                            <td> <a href="{{url($url)}}">Descargar</a></td>
                            <td><a href="#" onclick="mostrarModal({{$n->id}})">Enviar A</a></td>
                        </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Enviar PDF</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="message-text" class="control-label">Enviar a:</label>
            <input type="email" id="email" class="form-control" name="email" id="message-text" required placeholder="Para:">
          </div>
          <div class="form-group">
            <input class="form-control" placeholder="Asunto:" id="asunto" name="asunto">
          </div>
          <div class="form-group">
            <textarea id="contenido_mail" name="contenido_mail" class="form-control" style="height: 200px" placeholder="escriba aquí..."> </textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="enviarPdf()">Enviar Mail</button>
      </div>
    </div>
  </div>
</div>
<script src="/js/jquery-1.6.2.min.js"></script>
<script src="/js/bootstrap3-wysihtml5.all.min.js"></script>
<script>
    var id;
    function mostrarModal(nota){
        id = nota;
        $('#myModal').modal('show');
    }
    
    function enviarPdf(){
        var form = '';
        valor = $("#email").val();
        form += '<input type="email" name="email" value="'+valor+'">';
        valor =$("#asunto").val();
        form += '<input type="text" name="asunto" value="'+valor+'">';
        valor =$('#contenido_mail').val();
        form += '<textarea name="contenido_mail" id="contenido_mail">'+valor+'</textarea>';
        form += '<input type="number" name="id" value="'+id+'">';
        $('<form method="POST" action="{{url('/reenviarpdf')}}">'+form+'</form>').submit();
    }
    
    function activareditor(){   
        $("#contenido_mail").wysihtml5();
      };

      activareditor();

</script>

@endsection

