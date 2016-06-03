@extends('layouts.app')
@section('title', 'Plantillas Easy')
@section('content')
<link href="/css/welcome.css" rel="stylesheet" type='text/css'>
<link href="/css/animate.css" rel="stylesheet">

<style type="text/css">
    @media only screen and (max-width: 767px) {
        body {background-image: url(img/fondito.jpg);}
    }
</style>
<!--<div class="container">
    <div class="row">
        <div class="col-md-7 col-md-offset-3">-->
            <!-- <div class="panel panel-default">
                <div class="panel-heading">Bienvenidos a Plantillas de manera easy!</div>

                <div class="panel-body content_portada">
                    <div class="clear"></div> -->
                
                    <!--<div class="alert alert-success" id="content">-->
                    <!--<div id="content">
                        <h1>{{ $quote }}</h1>
                    </div>-->
                
                <!-- </div>
            </div> -->
        <!--</div>
    </div>
</div>-->
<header id="container">
    <section class="content">
        <!--<div class="funny">Sean Bienvenidos Todos!</div>
        <br/>
        <br/>-->
        <blockquote><div class="funny">Sean Bienvenidos Todos!</div> <br/>
        <br/>"{{$quote}}"</blockquote>
    </section>
</header>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="/js/jquery.lettering.js"></script>
<script src="/js/jquery.textillate.js"></script>
<script type="text/javascript">

    $('.funny').textillate({ in: { effect: 'zoomInDown', sync: false, } });

</script>
@endsection
