@extends('layouts.empty')
@section('content')
<nav class="navbar navbar-default navbar-fixed-top header" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand logo" href="/"><img style="max-height:50px; " src="/img/wl.png"></a>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
<div class="top-header" style="background: #01c6d6;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="top-message">
                    <h1>wingle. <br>Be Cool.</h1>
                    <h3>The Rating App that keeps you Cool. Always.</h3>
                    <hr class="top-divider">
                    <br>
                    <p>Ever wondered how that new dress looks? Or that photo from last night? Well, now your friends can rate your photos!</p>
                    <ul class="list-inline top-buttons">
                        <li><a href="#" class="btn btn-lg btn-primary"><i class="fa fa-facebook-square"></i> Login With Facebook</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <img style="max-height: 600px; padding: 56px;" src="/img/wingle_stock.jpeg" />
            </div>
        </div>
    </div>
    <!-- /.container -->
</div>
<div class="section text-center welcome">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 style="font-family: 'Raleway', 'Helvetica Neue', Helvetica, Arial, sans-serif;" class="page-header">Wingle Beta &copy;</h1>
                <p>We are still at early Days.</p>
                <div class="cl-effect-2 btn2">
                    <a href="mailto:winglelounge@gmail.com" class="btn btn-primary " target="_blank"><i class="fa fa-inbox"></i>  Give Feedback</a></li>
                </div>
                <hr>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</div>
<div id="services" class="services">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 text-center">
                <div class="service-item">
                    <i class="service-icon fa fa-rocket"></i>
                    <h4>Upload Image</h4>
                </div>
            </div>
            <div class="col-lg-4 text-center">
                <div class="service-item">
                    <i class="service-icon fa fa-users"></i>
                    <h4>Get Rated</h4>
                </div>
            </div>
            <div class="col-lg-4 text-center">
                <div class="service-item">
                    <i class="service-icon fa fa-desktop"></i>
                    <h4>Be Cool</h4>
                </div>
            </div>
        </div>
    </div>
</div>

@stop