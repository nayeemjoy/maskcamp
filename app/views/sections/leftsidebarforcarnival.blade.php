<div class="section-01 col-xs-12 hidden-xs">

      <!-- E -->
          
      <span class="visible-xs sidebar-x-button glyphicon glyphicon-remove-sign pull-right" id="cm-left-sidebar-x"aria-hidden="true"></span>

      <!-- !E -->
      

      <div class="row">
        <div class="col-lg-12">   
          <div class="card-container">
            <div class="card">
              <div class="side"><img src="{{$data['self']['url']}}" class="img-responsive img-rounded user-img" data-user="{{Auth::user()->id}}" data-userpicture="{{$data['self']['id']}}" data-img_canvas_id="user-self-ratio"></div><!-- 23-6-Ehsan -->
              <div class="side back"><canvas id="user-self-ratio" width="120" height="120"></canvas></div>
            </div> 
          </div>
        </div>
      </div>
      
      <ul class="visible-xs" id="cm-ul-full">                                       
        <li class="btn btn-success btn-lg btn-block"><a href="{{URL::to('/logout')}}">Logout</a></li>                              
      </ul>      
      
</div>