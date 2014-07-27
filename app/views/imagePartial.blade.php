<div id="message_container" class="bs-component" style="display: none">
    <div class="alert alert-dismissable alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong id="message_holder" ></strong>
    </div>
    <div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div>
</div>
<img width="523" src="{{ URL::asset('/uploads/' . $image->image) }}" />
<ul class="pager" style="margin-bottom: -40px">
    <li class="previous"><a class="previous_click" href="#">← Older</a></li>
    <li class="next"><a class="next_click" href="#">Newer →</a></li>
</ul>
@if($rating != null)
<img src="/img/star.png" /><div style="margin-top: -44px; margin-bottom: 44px;"><strong>{{round($rating, 1)}}</strong></div>
@elseif(!empty($hasRated))
<div class="btn-group" style="text-align: center">
    <h3 class="text-primary">You rated: </h3>
    @for($i = 1; $i < 6; $i++)
    <button disabled="disabled" type="button" data-url="/rate/{{$image->id}}?rating={{$i}}" class="btn btn-default btn-lg rate-button @if($hasRated == $i) active @endif">{{$i}}</button>
    @endfor
</div>
@else
<h3 class="text-primary">Rate It!</h3>
<div class="btn-group" style="text-align: center">
    <button type="button" data-url="/rate/{{$image->id}}?rating=1" class="btn btn-default btn-lg rate-button">1</button>
    <button type="button" data-url="/rate/{{$image->id}}?rating=2" class="btn btn-default btn-lg rate-button">2</button>
    <button type="button" data-url="/rate/{{$image->id}}?rating=3" class="btn btn-default btn-lg rate-button">3</button>
    <button type="button" data-url="/rate/{{$image->id}}?rating=4" class="btn btn-default btn-lg rate-button">4</button>
    <button type="button" data-url="/rate/{{$image->id}}?rating=5" class="btn btn-default btn-lg rate-button">5</button>
</div>
@endif
