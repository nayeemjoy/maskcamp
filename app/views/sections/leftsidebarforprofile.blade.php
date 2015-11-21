 <div class="section-01 col-xs-12 hidden-xs">
<?php $pictures = $data['pictures']; ?>
 <!-- E -->
 <span class="visible-xs sidebar-x-button glyphicon glyphicon-remove-sign pull-right" id="cm-left-sidebar-x"aria-hidden="true"></span>               

  <!-- !E -->

  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5 profile-page-img"><!--05-23-15-Turash-->  
        <img src="img/user.png" class="img-responsive img-rounded user-img cm-img-pop" data-userpicture="{{$data['user']['picture']}}" data-user="{{Auth::user()->id}}">  <!-- /////19-May-2015-Ehsan -->
   </div>
  </div>
  
  <div class="row">
    <p class="result-section" style="margin-top: -8px;">Select Your Mask</p>
  </div>
  <!-- **********************START**************5-7-Ehsan -->
  <div class="row"><!-- hidden-sm user img choice lg,md device -->
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="img-choice">
          <!-- *****START*******5-7-Ehsan -->
          @foreach($pictures as $picture)
           
            <label class="radio-inline mask-choices">
              <div class="row full-percent-width">
                <div class="col-xs-6">
                  <input type="radio" name="inlineRadioOptions" id="inlineRadio{{$picture->id}}" value="{{$picture->id}}">
                </div>
                <div class="col-xs-6">
                  <img src="{{asset($picture->url)}}" class="img-responsive img-rounded radio-img">
                </div>
              </div>
            </label>
           
          @endforeach
          <!-- *****END*******5-7-Ehsan -->
      </div>
    </div>
  </div>

  <!--user img choice sm device -->
  <!-- <div class="row visible-sm">
    <div class="col-lg-12 radio-img-sm">
      <div class="radio">
        <label>
          <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
          <img src="img/user_2.png" class="img-responsive img-rounded">
        </label>
      </div>
      <div class="radio">
        <label>
          <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
          <img src="img/user_2.png" class="img-responsive img-rounded">
        </label>
      </div>
      <div class="radio">
        <label>
          <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3" disabled>
          <img src="img/user_2.png" class="img-responsive img-rounded">
        </label>
      </div>
    </div>
  </div> -->
  <!-- ************************END***************5-7-Ehsan -->

  <!--11-19-15-turash-->
  
  <div class="row">
    <div class="user-name-area">
      <ul class="list-unstyled">
        <li>
          <!--<a data-placement="bottom" data-toggle="popover" data-title="Login" data-container="body" type="button" data-html="true" href="#" id="login">Login</a>-->
          <!-- START-21-11-Ehsan -->
          @if(!$data['user']['username'])
          <button class="btn btn-blue btn-primary btn-modified icon-btn" data-placement="bottom" data-toggle="popover"data-container="body" type="button" data-html="true"><span class="page-icon glyphicon glyphicon-plus" aria-hidden="true"></span><span class="user-name-pop-btn">Add Name</span></button>
          @else
          <button class="btn btn-blue btn-primary btn-modified icon-btn" data-placement="bottom" data-toggle="popover"data-container="body" type="button" data-html="true"><span class="page-icon glyphicon glyphicon-pencil" aria-hidden="true"></span><span class="user-name-pop-btn">Edit Name</span></button>
          @endif
        </li>
        <div id="popover-content" class="hide">
            <ul class="list-inline">
              <li>
              @if(!$data['user']['username'])
              <input type="text" class="form-control" id="user-name" placeholder="Name">
              @else
              <input type="text" class="form-control" id="user-name" placeholder="{{$data['user']['username']}}">
              @endif
              </li>
              <li>
              @if(!$data['user']['username'])
              <button class="btn btn-blue btn-primary btn-modified" id="name-add">Add!</button>
              @else
              <button class="btn btn-blue btn-primary btn-modified" id="name-add">Edit!</button>
              @endif
              </li>
            </ul>
            <span></span>
            <!-- END-21-11-Ehsan -->           
        </div>
      </ul>
    </div>
  </div>

  <!--11-19-15-turash-->
  
  <div class="row">
    <div class="col-lg-12"><!--05-23-15-turash-->
      <div class="like-dislike">
        <span class="page-icon glyphicon glyphicon-bookmark" aria-hidden="true"></span>Your Social Judgement
      </div>  
    </div>
  </div>

  <div class="row cm-row-last"> 
      <div class="col-md-2 hidden-sm col-xs-2"></div>
      <div class="col-md-8 col-sm-12 col-xs-8 result-chart-container">
        <canvas id="result-chart" width="141" height="150"></canvas>
      </div>
      <div class="col-md-2 hidden-sm col-xs-2"></div>    
  </div>

  <div class="row">
    <div class="col-lg-12 post-count">
      <span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span>
      <span class="post-counter">{{$my_posts['posts']}}</span> <span class="counter-text">posts</span>
    </div>
  </div>
  <!--Added By Joy 5/27/15 -->
   <div class="row">
    <div class="col-lg-12 post-count">
    	@if($data['user']->disable == 1)
      		<a class="btn btn-success btn-act" href="{{URL::to('/enable')}}">Account Activate</a>
    	@elseif($data['user']->disable == 2)
    		<a class="btn btn-warning btn-act" href="#">Account Banned</a>
    	@else
    		<a class="btn btn-danger btn-act" href="{{URL::to('/disable')}}">Account Deactivate</a>
    	@endif
    </div>
  </div>
  <!--Added By Joy 5/27/15 -->
  
  <ul class="visible-xs" id="cm-ul-full">                                       
      <li class="btn btn-success btn-modified btn-lg btn-block"><a href="{{URL::to('/logout')}}">Logout</a></li>                            
  </ul>  
  
</div>