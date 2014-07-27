<html>
<head>
    <title>Wingle | For Wing Girls</title>
    <link rel="stylesheet" href="/css/bootstrap.css" />
    <link rel="stylesheet" href="/css/flexslider.css" />
    <link rel="stylesheet" href="/css/ie8.css" />
    <link rel="stylesheet" href="/css/prettyphoto.css" />
    <link rel="stylesheet" href="/css/custom.css" />
    <link rel="stylesheet" href="/css/style.css" />
    <link rel="stylesheet" href="/css/style_old.css" />
    <script type="text/javascript" src="/packages/bootstrap/js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="/packages/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/jquery.knob.js"></script>
    <script type="text/javascript" src="/js/jquery.ui.widget.js"></script>
    <script type="text/javascript" src="/js/jquery.iframe-transport.js"></script>
    <script type="text/javascript" src="/js/jquery.fileupload.js"></script>
    <script type="text/javascript" src="/js/typeahead.js"></script>
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
                    <li class="dropdown">
                        @if($albums !== FALSE)
                        <a href="#" class="dropdown-toggle" disabled="disabled" data-toggle="dropdown">Albums<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            @foreach($albums as $album)
                                <li><a href="/album/{{$album->id}}">{{$album->name}}</a></li>
                            @endforeach
                        </ul>
                        @else
                            <a href="#" class="dropdown-toggle" disabled="disabled" data-toggle="dropdown">No Albums</a>
                        @endif

                    </li>
                    <li><a href="#">Albums</a></li>
                    <li><a href="/profile">Profile</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" style="padding: 0px;" data-toggle="dropdown"><img style="max-height: 50px" src="/uploads/{{$currentUser->image}}" /> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="/logout">Logout</a></li>
                            <li><a href="/profile">Profile</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container ">
        @yield('content')
    </div>
</div>
</body>
</html>
