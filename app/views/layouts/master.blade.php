<html>
<head>
    <title>Wingle | The Best image rating app</title>
    <link rel='shortcut icon' type='image/x-icon' href='/favicon.ico' />
    <link rel="stylesheet" href="/css/bootstrap.css" />
    <link rel="stylesheet" href="/css/flexslider.css" />
    <link rel="stylesheet" href="/css/ie8.css" />
    <link rel="stylesheet" href="/css/prettyphoto.css" />
    <link rel="stylesheet" href="/css/custom.css" />
    <link rel="stylesheet" href="/css/style.css" />
    <link rel="stylesheet" href="/css/style_old.css" />
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    <script type="text/javascript" src="/packages/bootstrap/js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="/packages/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/jquery.knob.js"></script>
    <script type="text/javascript" src="/js/custom.js"></script>

</head>
<body>
<div class="">
    <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="" href="/"><img style="max-height:50px; " src="/img/wl.png"></a>
            </div>
            <div class="navbar-collapse collapse navbar-responsive-collapse">
                <ul class="nav navbar-nav">
                    @if($albums !== FALSE)
                        <li><a href="/album/{{$albums[0]->id}}?showLounges=1">View Lounges</a></li>
                    @else
                    <li><a href="#" class="dropdown-toggle" disabled="disabled" data-toggle="dropdown">No Lounges</a></li>
                        @endif
                    <li><a href="/create-lounge">Add a Lounge</a></li>
                    <li><a href="/profile">Profile</a></li>
                    <li><a href="/logout">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container ">
        @yield('content')
    </div>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-inline">
                        <li><a href="/landing">Home</a></li>
                        <li>⋅</li>
                        <li><a href="/privacy">Privacy</a></li>
                        <li>⋅</li>
                        <li><a href="/conditions">Terms & Conditions</a></li>
                        <li>⋅</li>
                        <li><a target="_blank" href="mailto:winglelounge@gmail.com">Contact</a></li>
                    </ul>
                    <p class="copyright text-center medium">Copyright © <a href="http://www.wingle.com/landing">Wingle</a> 2013. All Rights Reserved</p>
                </div>
            </div>
        </div>
    </footer>
</div>
</body>
</html>
