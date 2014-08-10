@extends('layouts.master')
@section('content')
<br><br>
<div class="page-header">
    <div class="row">
        <div class="col-lg-8 text-center">
            <div class="panel panel-primary">
                <div class="panel-heading" style="height: 60px;">
                    <h2 class="panel-title" style="font-size: 35px;">
                        Create Lounge
                    </h2>
                </div>
                <div id="lounge_actions" class="panel-body">
                    <div class="well bs-component">
                        <form method="POST" action="/create-lounge" id="upload" class="form-horizontal" enctype="multipart/form-data">
                            <div class="form-group ">
                                <div class="col-lg-12">
                                    <input name="lounge" type="text" class="form-control" id="loungeInput" placeholder="Lounge Name" />
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
            </div>
        </div>
    </div>
</div>
@stop