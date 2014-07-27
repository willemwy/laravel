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
                        }
                    });

                } else
                {

                    $("#message_holder").html("All images rated!");
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
                    }
                });
            }
        });
    }

    $(document).ready(function(){

        $(".addUser").click(function(e){
            e.preventDefault();
            var $click = $(this);
            var actionurl = $(this).attr('href');
            $.ajax({
                url: actionurl,
                type: 'get',
                dataType: 'json',
                success: function(data) {
                    $click.remove();
                }
            });
        });
        $('#box').keyup(function(){
            var valThis = $(this).val().toLowerCase();
            $('.navList>a').each(function(){
                var text = $(this).text().toLowerCase();
                (text.indexOf(valThis) == 0) ? $(this).show() : $(this).hide();
            });
        });


        $('#focusedInput').typeahead([
            {
                name: 'planets',
                local: $.parseJSON('{{$users->toJson();}}')
            }
        ]);

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
            }
        });

    });
</script>
<div class="page-header">
    <div class="row">
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
                        <form action="/album/{{$album->id}}" id="upload" class="form-horizontal">
                            <fieldset>
                                <div class="form-group ">
                                    <div class="col-lg-12">
                                        <input name="lounge" type="text" class="form-control" id="loungeInput" placeholder="Image Name">
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div id="drop">
                                    Drop Here
                                    <br>
                                    <a>Browse</a>
                                    <input type="file" name="upl" />
                                    <ul>
                                        <!-- The file uploads will be shown here -->
                                    </ul>
                                </div>
                            </fieldset>
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
                    <a data-toggle="modal" data-target="#myModal" class="btn btn-primary">Invite Friends</a>
                    <a href="#">Delete Friend</a>
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Friends</h4>
                                </div>
                                <div class="row modal-body">
                                    <input placeholder="Search Me" id="box" type="text" />
                                    <div class="list-group navList">
                                        @foreach($users AS $user)
                                            @if($user->id == $currentUser->id)

                                            @elseif(!in_array($user->id, $inGroup))
                                                <a href="/adduser/{{$album->id}}?userId={{$user->id}}" class="list-group-item addUser">{{$user->name}} {{$user->surname}}</a>
                                            @else
                                                {{$user->name}} {{$user->surname}} (Invited)
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop