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
                <div class="panel-heading">titulo</div>
                <div class="panel-body">
                    @foreach ($template as $t)
						{{$t -> titulo}}
					@endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection