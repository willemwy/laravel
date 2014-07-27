@extends('layouts.master')
@section('content')
<br><br>
<style>
#add_longe
{
    cursor: pointer;
}
</style>
<div class="page-header">
    <div class="row">
        <div class="col-lg-8">
            <div class="well bs-component">
                <form action="/profile" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <fieldset>
                        <legend>Profile</legend>
                        <div class="form-group">
                            <label for="inputEmail" class="col-lg-2 control-label">Email</label>
                            <div class="col-lg-10">
                                <input value="{{$user->email}}" type="text" class="form-control" id="inputEmail" placeholder="Email" name="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-lg-2 control-label">Name</label>
                            <div class="col-lg-10">
                                <input value="{{$user->name}}" type="text" class="form-control" id="name" placeholder="Name" name="name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="surname" class="col-lg-2 control-label">Surname</label>
                            <div class="col-lg-10">
                                <input type="text" value="{{$user->surname}}" class="form-control" id="surname" placeholder="Surname" name="surname">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="surname" class="col-lg-2 control-label">Profile Picture</label>
                            <img style="padding-left: 15px; max-height: 200px; max-width: 200px;" src="/uploads/{{$user->image}}" />
                            <input style="padding-left: 127px; padding-top: 21px;" type="file" class="" id="image" name="image">
                        </div>
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
@stop