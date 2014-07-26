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
                                console.log("!");
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
        bindShit();
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
                    <div id="message_container" class="bs-component" style="display: none">
                        <div class="alert alert-dismissable alert-success">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong id="message_holder" ></strong>
                        </div>
                        <div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div>
                    </div>
                    @if(count($images) != 0)
                        <img width="523" src="{{ URL::asset('/uploads/' . $images[0]->image) }}" />
                        <ul class="pager" style="margin-bottom: -40px">
                            <li class="previous"><a class="previous_click" href="#">← Older</a></li>
                            <li class="next"><a class="next_click" href="#">Newer →</a></li>
                        </ul>
                        <div class="btn-group" style="text-align: center">
                            <button data-url="/rate/{{$images[0]->id}}?rating=1" type="button" class="rate-button btn btn-default btn-lg">1</button>
                            <button data-url="/rate/{{$images[0]->id}}?rating=2" type="button" class="rate-button btn btn-default btn-lg">2</button>
                            <button data-url="/rate/{{$images[0]->id}}?rating=3" type="button" class="rate-button btn btn-default btn-lg">3</button>
                            <button data-url="/rate/{{$images[0]->id}}?rating=4" type="button" class="rate-button btn btn-default btn-lg">4</button>
                            <button data-url="/rate/{{$images[0]->id}}?rating=5" type="button" class="rate-button btn btn-default btn-lg">5</button>
                        </div>
                        <h3 class="text-primary">Rate It!</h3>
                    @else
                        <h3 class="text-primary">No Images for this Filter</h3>
                    @endif
                </div>
            </div>
        </div>

        <div class="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        <p>One fine body…</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
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
                                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                                </div>
                                <div class="modal-body">
                                    <input class="form-control" id="focusedInput" type="text" value="" placeholder="Friends...">
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