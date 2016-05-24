@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Vista de Plantilla</div>
                <?php 
                    $url = 'template/'.$id."/pdf";
                    $url2 =  'template/'.$id;
                 ?>
                <form method="post" action="{{url($url)}}"> 
                    <div class="panel-body texto">
                        <p> <?php echo $texto ?> </p>
                    </div>
                    <button class="btn btn-success" type="submit">Generar PDF</button>
                </form>
                <form method="post" action="{{url($url2)}}">
                    <button class="btn btn-success" type="submit">Enviar por correo</button>
                </form>

                    <div class="panel-body col-md-offset-2">
                        
                        <!-- <button class="btn btn-success" type="submit">Generar PDF</button> -->
                        
                        <!-- <a id="btnPDF" class="btn btn-default" onclick="generarPDF({{$id}})">Generar PDF</a> -->
                        
                        <button class="btn btn-success">Enviarmelo por correo</button>
                        <button class="btn btn-success" data-toggle="modal" data-target="#myModal">Enviar PDF a un amigo</button>

                        <!-- Modal -->
                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title" data-dismiss="modal">Enviar PDF por correo</h4>
                                    </div>
                                    <div class="modal-body">
                                        <!-- <form class="form-horizontal" role="form" method="POST" action="{{ url('/mail') }}">
                                            {!! csrf_field() !!} --> 
                                            <div class="panel panel-success">
                                                <label class="col-md-4 control-label">Correo Electr&oacute;nico</label>
                                                <div class="col-md-6">
                                                    <input type="email" class="form-control" name="email" value="">
                                                </div>
                                            </div>
                                            <div class="">
                                                <label class="col-md-4 control-label">Mensaje adjunto al correo</label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="mensaje" value="">
                                                </div>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                            <div class="">
                                                <div class="col-md-6 col-md-offset-4">
                                                    <a href="{{ url('/mail') }}" class="btn btn-default">Enviar</a>
                                                </div>
                                            </div>
                                        <!-- </form> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
            </div>
        </div>
    </div>
</div>
@endsection