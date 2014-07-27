<div id="message_container" class="bs-component" style="display: none">
    <div class="alert alert-dismissable alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong id="message_holder" ></strong>
    </div>
    <div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div>
</div>
<img style="margin: 0 auto;" class="img-responsive" src="{{ URL::asset('/uploads/' . $image->image) }}" />
<ul class="pager" style="margin-bottom: -40px">
    <li class="previous"><a class="previous_click" href="#">← Previous</a></li>
    <li class="next"><a class="next_click" href="#">Next →</a></li>
</ul>
@if($hasRated == false && !$ownImage)
<h3 class="text-primary">Rate It!</h3>
<div class="btn-group" style="text-align: center">
    <button type="button" data-url="/rate/{{$image->id}}?rating=1" class="btn btn-default btn-lg rate-button">1</button>
    <button type="button" data-url="/rate/{{$image->id}}?rating=2" class="btn btn-default btn-lg rate-button">2</button>
    <button type="button" data-url="/rate/{{$image->id}}?rating=3" class="btn btn-default btn-lg rate-button">3</button>
    <button type="button" data-url="/rate/{{$image->id}}?rating=4" class="btn btn-default btn-lg rate-button">4</button>
    <button type="button" data-url="/rate/{{$image->id}}?rating=5" class="btn btn-default btn-lg rate-button">5</button>
</div>
@elseif($hasRated != false)
<div class="btn-group" style="text-align: center">
    <h3 class="text-primary">You rated: </h3>
    @for($i = 1; $i < 6; $i++)
    <button disabled="disabled" @if($hasRated == $i) style='background-color: bisque;' @endif type="button" data-url="/rate/{{$image->id}}?rating={{$i}}" class="btn btn-default btn-lg rate-button">{{$i}}</button>
    @endfor
</div><br><br>
<img src="/img/star.png" /><div style="margin-top: -44px; margin-bottom: 44px;"><strong>{{round($rating, 1)}}</strong></div>
@elseif($rating == false && $ownImage)
<h3 class="text-primary">Rating Pending</h3>
@else
<img src="/img/star.png" /><div style="margin-top: -44px; margin-bottom: 44px;"><strong>{{round($rating, 1)}}</strong></div>
@endif
