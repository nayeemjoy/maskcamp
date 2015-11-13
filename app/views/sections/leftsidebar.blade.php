<div class="section-01 col-xs-12 hidden-xs">

      <!-- E -->
          
      <span class="visible-xs sidebar-x-button glyphicon glyphicon-remove-sign pull-right" id="cm-left-sidebar-x"aria-hidden="true"></span>

      <!-- !E -->
      <!-- START23-6-Ehsan -->
      @if($data['page'] == "home")
      <div class="row">
        <div class="col-xs-12 howToUse">   
          <button class="btn btn-success btn-modified" aria-hidden="true" data-toggle="modal" data-target="#welcomeModal">How To Use</button><!--11/07/15-turash-->
        </div>
      </div>
      @endif
      <!-- END23-6-Ehsan -->

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
      
      @if($data['prev_question'])
      <div class="row">
        <div class="col-lg-12">
           <div class="poll new-poll"><span class="page-icon glyphicon glyphicon-stats" aria-hidden="true"></span>Result Of Last Poll</div><!--05-10-15-->
           <p class="result-section">{{$data['prev_question']->question}}</p>
        </div>
      </div>

      <div class="row cm-row-last">
        
          <div class="col-md-2 hidden-sm col-xs-2"></div>
          <div class="col-md-8 col-sm-12 col-xs-8 result-chart-container">
            <canvas id="result-chart" width="141" height="150"></canvas>
          </div>
          <div class="col-md-2 hidden-sm col-xs-2"></div>
        
      </div>

      <div class="row"><!--10/04/15 -->
        <div class="col-lg-12 post-count">
          <span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span>
          <span class="post-counter">{{$data['total_votes']}}</span> <span class="counter-text">Votes</span>
        </div>
      </div>

      <div class="row"><!--10/04/15 -->
        <div class="col-lg-12 post-count">
          <!-- START5-7-Ehsan -->
          <div class="row result-display">
            <div class="col-xs-12">
              <div class="red">
                <div class="row">
                  <div class="col-xs-5 bold-fnt-weight">
                    {{$data['answers'][1]['total_answer']}}%
                  </div>
                  <div class="col-xs-7">
                    {{$data['answers'][1]['option_details']}}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xs-12">
              <div class="green">
                <div class="row">
                  <div class="col-xs-5 bold-fnt-weight">
                    {{$data['answers'][2]['total_answer']}}%
                  </div>
                  <div class="col-xs-7">
                    {{$data['answers'][2]['option_details']}}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xs-12">
              <div class="yellow">
                <div class="row">
                  <div class="col-xs-5 bold-fnt-weight">
                    {{$data['answers'][3]['total_answer']}}%
                  </div>
                  <div class="col-xs-7">
                    {{$data['answers'][3]['option_details']}}
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- END5-7-Ehsan -->
        </div>
      </div>
      @endif
      
      <ul class="visible-xs" id="cm-ul-full">                                       
        <li class="btn btn-success btn-lg btn-block"><a href="{{URL::to('/logout')}}">Logout</a></li>                              
      </ul>      
      
</div>