@extends('layouts.app')

@section('content')
<link href="css/ajuste.css" rel="stylesheet">
<div class="container">
    <div class="row">
        <div class="col-md-7 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Mensaje</div>
                <form method="post">
                    <div class="panel-body texto">
                        <p> <?php echo $texto ?> </p>
                    </div>
                    <div class="panel-body col-md-offset-2">
                        <button class="btn btn-success" type="submit">Descargar PDF</button>
                        <button class="btn btn-success">Enviar PDF</button>
                        <button class="btn btn-success">Guardar PDF</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{ elixir('js/ajustar.js')" ></script>
@endsection