@extends('layouts.app')
@section('title', 'Editar plantilla')
@section('content')
<link href='/css/ajuste.css' rel="stylesheet">
<link rel="stylesheet" href="/css/bootstrap3-wysihtml5.min.css">
<link rel="stylesheet" href="/css/jquery.timepicker.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<div class="container">
    <div class="row">
        <div class="col-md-7 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Mensaje</div>
                        
                <div class="panel-body texto">
                    <p> <?php echo $texto ?> </p>
                </div>
                
                <div class="panel-body col-md-offset-2">
                    <button class="btn btn-success" id="pdf">Descargar PDF</button>
                    <button class="btn btn-success" onclick="mostrarModal()">Enviar PDF</button>
                    <button class="btn btn-success" onclick="guardarPdf({{$id}})">Guardar PDF</button>
                </div>
                
            </div>
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
        <button type="button" class="btn btn-primary" onclick="enviarPdf({{$id}})">Enviar Mail</button>
      </div>
    </div>
  </div>
</div>

<script src="/js/jquery-1.6.2.min.js"></script>
<script src="/js/ajustar.js"></script>
<script type="text/javascript" src="/js/jquery-1.11.1.min.js"></script>
<script src="/js/jquery.timepicker.min.js"></script>
<!--<script src="//code.jquery.com/jquery-1.10.2.js"></script>-->
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="/js/bootstrap3-wysihtml5.all.min.js"></script>
<script>
    
    $(document).ready(function()
    {
    $("#pdf").click(function(){
        var form = '';
        $("input[type=text]").each(function (){
            var valor = $(this).val();
            var nombre = $(this).attr("name");
            form += '<input type="text" name="'+nombre+'" value="'+valor+'">';
        });
        $('<form method="POST">'+form+'</form>').submit();
    });
    });
        
    //$(function() {
        $('#hora').timepicker({ 'timeFormat': 'h:i A' });
    //});

  //$(function() {
    $( "#fecha" ).datepicker();
  //});

    function mostrarModal(){
        $('#myModal').modal('show');
    };
    
    function enviarPdf(id){
        var form = '';
        $("input[type=text]").each(function (){
            var valor = $(this).val();
            var nombre = $(this).attr("name");
            form += '<input type="text" name="'+nombre+'" value="'+valor+'">';
        });
        valor = $("#email").val();
        form += '<input type="email" name="email" value="'+valor+'">';
        valor =$("#asunto").val();
        form += '<input type="text" name="asunto" value="'+valor+'">';
        valor =$('#contenido_mail').val();
        form += '<textarea name="contenido_mail" id="contenido_mail">'+valor+'</textarea>';
        form += '<input type="number" name="id" value="'+id+'">';
        $('<form method="POST" action="{{url('/enviarpdf')}}">'+form+'</form>').submit();
    };
    
    function guardarPdf(id){
        var form = '';
        $("input[type=text]").each(function (){
            var valor = $(this).val();
            var nombre = $(this).attr("name");
            form += '<input type="text" name="'+nombre+'" value="'+valor+'">';
        });
        
        form += '<input type="number" name="id" value="'+id+'">';
        $('<form method="POST" action="{{url('/guardarpdf')}}">'+form+'</form>').submit();
    };
    
    function activareditor(){   
        $("#contenido_mail").wysihtml5();
      };

      activareditor();

</script>
@endsection