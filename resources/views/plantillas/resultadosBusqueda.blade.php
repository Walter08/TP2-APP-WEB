@extends('layouts.app')
@section('title', 'Sugerencia de Plantillas')
@section('content')

<div class="container">
    <div class="row">
        <!--<div class="col-md-3 col-md-offset-1">-->
            <!-- Incluyo panel izquierdo con las categorias -->
            <!--@include('menu_categorias')-->
        <!--</div>-->
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-info">
                <div class="panel-heading">{{$titulo}}</div>
                <div class="panel-body">
                    @foreach ($resultados as $r)
                           <div class="panel panel-success">
                              <div class="panel-heading">
                                <?php $data = '#myModal'.$r->id ?>
                                <h4 class="panel-title flex_der" role="alert">{{ $r->titulo }}
                                <button type="button" class="btn btn-success flex_der" data-toggle="modal" data-target="{{$data}}">
                                  <span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span>&nbsp;Ver plantilla
                                </button>
                                </h4>
                              </div>
                              <div class="panel-body">
                                <!--<div class="texto" id="{{$r->id}}">
                                  <div class="convertir" style="visibility: hidden;"> {{$r -> cuerpo}} </div>
                                  <div class="widget" id="{{$r->id}}"></div>
                                </div>-->
                                <!-- Modal -->
                                <?php $d = 'myModal'.$r->id ?>
                                <div id="{{$d}}" class="modal fade" role="dialog">
                                  <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title"> {{ $r->titulo }}</h4>
                                      </div>
                                      <div class="modal-body">
                                        <p>{{$r->cuerpo}}</p>
                                      </div>
                                      <div class="modal-footer">
                                        <?php $url = 'template/'.$r->id ?>
                                        <a href="{{url($url)}}" class="btn btn-default">Usar Plantilla</a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

</div>
@endsection