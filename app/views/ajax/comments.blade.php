@foreach($comments as $comment)

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 cm-comment" id="{{$comment->post_id}}">
    <img src="img/user_3.png" class="cm-thumbnail img-responsive img-rounded cm-img-pop" data-img_canvas_id="result-chart5" data-toggle="tooltip" data-placement="bottom" data-html="true" title="<canvas id='result-chart5' width='100' height='100'></canvas>">
    
    <p>
      {{$comment->comment}}
    </p>
    
    <div class="row like-dislike-comment">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
           <span class="pull-right count">{{$likes[''.$comment->id]}}</span>
           <img src="img/like_2.png" class="img-responsive like-img">
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
           <span class="pull-right count">{{$dislikes[''.$comment->id]}}</span>
           <img src="img/like_2.png" class="img-responsive dislike-img">
      </div>
    </div>
</div>
@endforeach


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 cm-comment">
    <textarea rows="3" cols="40" class="form-control"></textarea>
    <button type="button" class="col-sm-2 col-xs-4 btn btn-primary button-class pull-right">Post</button>
    <button type="button" class="col-sm-2 col-xs-4 btn btn-primary button-class pull-right cm-scroll-top">
      <span class="glyphicon glyphicon-circle-arrow-up"></span>
    </button>
</div>