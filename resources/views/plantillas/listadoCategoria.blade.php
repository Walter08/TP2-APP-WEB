@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-3 col-md-offset-1">
            <!-- Incluyo panel izquierdo con las categorias -->
            @include('menu_categorias')
        </div>
        <div class="col-md-7">
            <div class="panel panel-default">
                <div class="panel-heading">{{$titulo}}</div>
                <div class="panel-body">
                    @foreach ($resultados as $r)
                           <div class="panel panel-success">
                                <h4 class="alert alert-success flex_der" role="alert">{{ $r->titulo }}
                                <button type="button" class="btn btn-success flex_der" data-toggle="modal" data-target="#myModal">
                                  <span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span>Ver plantilla
                                </button>
                                </h4>
                                <!-- Modal -->
                                <div id="myModal" class="modal fade" role="dialog">
                                  <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">{{ $r->id }} : {{ $r->titulo }}</h4>
                                      </div>
                                      <div class="modal-body">
                                        <p id="modal_cuerpo">{{$r->cuerpo}}</p>
                                      </div>
                                      <div class="modal-footer">
                                        <?php $url = 'template/'.$r->id ?>
                                        <a href="{{url($url)}}" class="btn btn-default">Usar Plantilla</a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        
                    @endforeach
                </div>
                {!! $resultados->render() !!}
            </div>

        </div>
    </div>

</div>

@endsection