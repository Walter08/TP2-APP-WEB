@extends('layouts.app')
@section('title', 'Listado de Categorias')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
        	@if (session('msj'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ session('msj') }}
            </div>
          @endif
          @if (session('error'))
            <div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ session('error') }}
            </div>
          @endif
            @include('menu_categorias')
        </div>
    </div>
</div>
@endsection
