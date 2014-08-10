@extends('layouts.master')
@section('content')
<br><br>
<style>
    #add_longe
    {
        cursor: pointer;
    }
</style>
<script type="application/javascript">

    var images = {{$images->toJson();}};
    var selectedImage = 0;

    function bindShit()
    {
        if(selectedImage == 0)
        {
            $(".previous_click").parent("li").addClass("disabled");
        }else if(selectedImage >= (images.length -1))
        {
            $(".next_click").parent("li").addClass("disabled");
        }

        $(".rate-button").click(function(e){
            var actionurl = $(this).data('url');
            e.preventDefault();
            $.ajax({
                url: actionurl,
                type: 'get'
            }).done(function(){

                if(selectedImage < images.length)
                {
                    selectedImage++;
                    //do your own request an handle the results
                    $.ajax({
                        url: "/image/" + images[selectedImage]["id"],
                        type: 'get',
                        dataType: 'json',
                        success: function(data) {
                            $("#lounge_container").html(data.html);
                            $("#message_container").show();
                            if(selectedImage == (images.length - 1))
                            {
                                $(".next_click").parent("li").addClass("disabled");
                            } else
                            {
                                $(".next_click").parent("li").removeClass("disabled");
                            }
                            bindShit();
                            $("#message_holder").html("Image was rated!");
                        }
                    });

                } else
                {
                    location.reload();
                }

            });
        });

        $(".next_click").click(function(e){
            if(selectedImage < images.length || !$(".next_click").hasClass("disabled"))
            {
                selectedImage++;
                //do your own request an handle the results
                $.ajax({
                    url: "/image/" + images[selectedImage]["id"],
                    type: 'get',
                    dataType: 'json',
                    success: function(data) {
                        $("#lounge_container").html(data.html);
                        $("#message_container").show();
                        if(selectedImage == (images.length - 1))
                        {
                            $(".next_click").parent("li").addClass("disabled");
                        } else
                        {
                            $(".next_click").parent("li").removeClass("disabled");
                        }
                        bindShit();
                        $( "#message_container" ).remove();
                    }
                });

            }
        });

        $(".previous_click").click(function(e){
            if(selectedImage >= 0 || !$(".next_click").hasClass("disabled"))
            {
                selectedImage--;
                //do your own request an handle the results
                $.ajax({
                    url: "/image/" + images[selectedImage]["id"],
                    type: 'get',
                    dataType: 'json',
                    success: function(data) {
                        $("#lounge_container").html(data.html);
                        $("#message_container").show();

                        console.log(selectedImage);
                        if(selectedImage == 0)
                        {
                            $(".previous_click").parent("li").addClass("disabled");
                        } else
                        {
                            $(".previous_click").parent("li").removeClass("disabled");
                        }
                        bindShit();
                        $( "#message_container" ).remove();
                    }
                });
            }
        });
    }

    $(document).ready(function(){

        if($.trim($("#friendsToInvite").html()) == "")
        {
            $("#friendsToInvite").html("There are no friends to invite");
        }

        $(".addUser").click(function(e){
            e.preventDefault();
            var $click = $(this);
            var actionurl = $(this).attr('href');
            console.log(actionurl);
            $.ajax({
                url: actionurl,
                type: 'get',
                dataType: 'json',
                success: function(data) {
                    location.reload();
                }
            });
        });

        $(".removeUser").click(function(e){
            e.preventDefault();
            var $click = $(this);
            var actionurl = $(this).attr('href');
            $.ajax({
                url: actionurl,
                type: 'get',
                dataType: 'json',
                success: function(data) {
                    location.reload();
                }
            });
        });

        $(".sideImage").click(function(e)
        {
            e.preventDefault();
            //get the action-url of the form
            var actionurl = $(this).attr('href');

            //do your own request an handle the results
            $.ajax({
                url: actionurl,
                type: 'get',
                dataType: 'json',
                success: function(data) {
                    $("#lounge_container").html(data.html);
                    $("#message_container").show();

                    bindShit();
                    $( "#message_container" ).remove();
                }
            });
        });

        $("#lounge_actions").hide();
        $("#lounge_actions_btn").click(function(e){
            e.preventDefault();

            var a_click = $(this);

            if($(this).data("active") == "0")
            {
                $("#lounge_actions").slideDown("slow", function(){
                    a_click.data("active", "1");
                });
            }
            else
            {
                $("#lounge_container").show();
                $("#lounge_actions").slideUp("slow", function(){
                    $("#lounge_actions").hide();
                    a_click.data("active", "0");
                });
            }
        });

        $.ajax({
            url: "/image/" + images[selectedImage]["id"],
            type: 'get',
            dataType: 'json',
            success: function(data) {
                $("#lounge_container").html(data.html);
                $("#message_container").show();

                if(selectedImage == (images.length - 1))
                {
                    $(".next_click").parent("li").addClass("disabled");
                } else
                {
                    $(".next_click").parent("li").removeClass("disabled");
                }
                bindShit();
                $( "#message_container" ).remove();
            }
        });

        $(".toInvite").each(function(index, element){
            $(element).parent().hide();
        });

        $('#textSearch').keyup(function() {
            searchTerm = $(this).val();
            $(".textToFilter").each(function(index, element){
                if($(element).text().indexOf(searchTerm) == -1)
                {
                    $(element).parent().hide();
                }
                else
                {
                    $(element).parent().show();
                }
            });
        });

    });
</script>
<div class="page-header">
    <div class="row">
        @if($showLounges != false && $albums != false)
            <div class="col-lg-8 text-center">
                <div class="panel panel-primary">
                    <div class="panel-heading" style="height: 60px;">
                        <h2 class="panel-title" style="font-size: 35px;">
                            Lounges
                        </h2>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            @foreach($albums AS $album)
                            <div class="col-xs-6 col-md-4">
                                <a style="overflow: hidden;" href="/album/{{$album->id}}" title="View {{$album->name}}" class="thumbnail">
                                    <img style="height: 60px; width: 60px" src="/uploads/{{$album->image}}" data-src="holder.js/100%x180" alt="...">
                                    {{$album->name}}
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-lg-8 text-center">
            <div class="panel panel-primary">
                <div class="panel-heading" style="height: 60px;">
                    <h2 class="panel-title" style="font-size: 35px;">
                        {{$album->name}}
                        <a id="lounge_actions_btn" data-active="0" class="pull-right btn btn-default" style="color: #2fa4e7;">+</a>
                    </h2>
                </div>
                <div id="lounge_actions" class="panel-body">
                    <div class="well bs-component">
                        <form method="POST" action="/create-image/{{$album->id}}" id="upload" class="form-horizontal" enctype="multipart/form-data">
                            <div class="form-group ">
                                <div class="col-lg-12">
                                    <input name="lounge" type="text" class="form-control" id="loungeInput" placeholder="Image Name" />
                                </div>
                                <div class="col-lg-12">
                                    <br>
                                    <input id="upl" type="file" name="upl" />
                                    <a href="#" id="createLounge" class="btn btn-primary">Submit</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="lounge_container" class="panel-body">
                </div>
            </div>
        </div>
        <div class="col-lg-4 text-center">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 style="display: -webkit-inline-box;" class="panel-title"><strong>Images in Lounge</strong></h3>
                    <div class="btn-group">
                        <button type="button" class="btn-xs btn btn-default dropdown-toggle" data-toggle="dropdown">
                            Filters <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            @foreach($filters as $key => $filter)
                                <li><a href="/album/{{$album->id}}?filter={{$key}}">{{$filter}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($images AS $key => $image)
                        <div class="col-xs-6 col-md-4">
                            <a data-current="0" href="/image/{{$image->id}}" class="thumbnail sideImage">
                                <img style="height: 60px; width: 60px" src="/uploads/{{$image->image}}" data-src="holder.js/100%x180" alt="...">
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Friends in Lounge</strong><br><br>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">@</span>
                            <input id="textSearch" type="text" class="form-control " placeholder="Username">
                        </div>
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($users AS $user)
                            @if($user->id != $currentUser->id)
                                @if(in_array($user->id, $inGroup) && $ownsLounge)
                                <div class="col-xs-6 col-md-4">
                                    <a style="overflow: hidden;" href="/remove_user?user_id={{$user->id}}&album_id={{$album->id}}" title="{{$user->name}} {{$user->surname}} " data-current="0" class="textToFilter removeUser thumbnail">
                                        <img style="height: 60px; width: 60px" src="/uploads/{{$user->image}}" data-src="holder.js/100%x180" alt="...">
                                        {{$user->name}} {{$user->surname}}<br>Remove
                                    </a>
                                </div>
                                @elseif(!in_array($user->id, $inGroup) )
                                    <div class="col-xs-6 col-md-4">
                                        <a style="overflow: hidden;" href="/adduser/{{$album->id}}?userId={{$user->id}}" class="textToFilter thumbnail addUser toInvite">
                                            <img style="height: 60px; width: 60px" src="/uploads/{{$user->image}}" data-src="holder.js/100%x180" alt="...">
                                            {{$user->name}} {{$user->surname}}<br>Add
                                        </a>
                                    </div>
                                @else
                                    <div class="col-xs-6 col-md-4">
                                        <a style="overflow: hidden;" href="/adduser/{{$album->id}}?userId={{$user->id}}" class="textToFilter thumbnail">
                                            <img style="height: 60px; width: 60px" src="/uploads/{{$user->image}}" data-src="holder.js/100%x180" alt="...">
                                            {{$user->name}} {{$user->surname}}<br>
                                        </a>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    </div>
                    @if($ownsLounge)<a href="/remove_album/{{$album->id}}" >Delete Lounge</a>@else<a href="/remove_user?user_id={{$currentUser->id}}&album_id={{$album->id}}&redirect=1" >Leave Lounge</a>@endif
                </div>
            </div>
        </div>
    </div>
</div>
@stop