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
    $(document).ready(function(){
        $("#source-button").click(function(e){
            e.preventDefault()
            //get the action-url of the form
            var actionurl = e.currentTarget.action;

            alert("tits");
            $.ajax({
                url: actionurl,
                type: 'post',
                dataType: 'json',
                data: $("#upload").serialize(),
                success: function(data) {
                    alert("boobs");
                    window.location = "/album/" + data.albumId;

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
                        Create Album
                    </h2>
                </div>
                <div id="lounge_actions" class="panel-body">
                    <div class="well bs-component">
                        <form action="/" id="upload" class="form-horizontal">
                            <fieldset>
                                <div class="form-group ">
                                    <div class="col-lg-12">
                                        <input name="lounge" type="text" class="form-control" id="loungeInput" placeholder="Lounge Name">
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
            </div>
        </div>
    </div>
</div>
@stop