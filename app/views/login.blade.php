@extends('layouts.master')
@section('content')
<br><br><br>
<div class="row">
    <div class="col-lg-12">
        <div class="well bs-component">
            <form class="form-horizontal">
                <fieldset>
                    <legend>Profile</legend>
                    <input id="fb_id" name="fb_id" type="hidden" value="{{$userProfile->identifier}}">
                    <input id="use_fb" name="use_fb" type="hidden" value="1">
                    <div class="form-group">
                        <label for="email" class="col-lg-2 control-label">Email</label>
                        <div class="col-lg-10">
                            <input type="text" value="{{$userProfile->email}}" class="form-control" id="email" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-lg-2 control-label">Name</label>
                        <div class="col-lg-10">
                            <input type="text" value="{{$userProfile->firstName}}" class="form-control" id="name" placeholder="Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="surname" class="col-lg-2 control-label">Surname</label>
                        <div class="col-lg-10">
                            <input type="text" value="{{$userProfile->lastName}}" class="form-control" id="surname" placeholder="Surname">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="image" class="col-lg-2 control-label">Facebook Image</label>
                        <div class="col-lg-10">
                            <img src="{{$userProfile->photoURL}}" />
                            <input name="fb_image" value="{{$userProfile->photoURL}}" type="hidden" class="form-control" id="fb_image" placeholder="image">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </fieldset>
            </form>
            <div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div></div>
    </div>
</div>
@stop