<div class="section-03 section-03-full-scroll col-xs-12 hidden-xs">
            <!-- E -->
    <div class="row visible-xs">
      <div class="col-xs-12">
        <span class="visible-xs sidebar-x-button glyphicon glyphicon-remove-sign pull-left" id="cm-right-sidebar-x"aria-hidden="true"></span>
      </div>
    </div>

    <div class="home"><!--05-10-15-->      
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
           <div class="page-title"><span class="page-icon glyphicon glyphicon-user" aria-hidden="true"></span>Profile<!--05-10-15--></div>
        </div>        
    </div>

    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="confession" title="People using MaskCamp will be able to see your confession if you update this">
          <h3 class="confession-title"><b>Confession</b></h3>
          <h5 class="confession-sub-title"><i>N.B: Confession will be deleted automatically after 24 hours.In the mean time you won't be able to edit this.</i></h5>
          <blockquote class="confession-text" id="confession">{{htmlentities($data['confess'])}}</blockquote>
          @if($data['enable'])
          <!-- <span class="glyphicon glyphicon-plus-sign sign-gap" aria-hidden="true" data-toggle="modal" data-target="#addModal" title="Add another confession"></span> -->
          <span class="glyphicon glyphicon-plus-sign sign-gap like-dislike-white" aria-hidden="true" data-toggle="modal" data-target="#editModal" title="Add confession"></span><!--19-May-2015-Ehsan-->
          @endif
        </div>
      </div>    
    </div>
    
    <div class="poll-section"><!--05-23-15-turash-->
        <div class="col-lg-12">
          <div class="poll"><span class="page-icon glyphicon glyphicon-th-large" aria-hidden="true"></span>Network</div> 
        </div>       
    </div>

    <div class="row f-f-f"><!--10-04-15-->
      
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <ul id="myTab" class="nav nav-tabs">
           <li class="active friends"><a href="#friends" data-toggle="tab">Friends</a></li>  
           <li class="following"><a href="#following" data-toggle="tab"> Following </a></li>
           <li class="followers"><a href="#followers" data-toggle="tab">Followers</a></li>   
        </ul>
        <div id="myTabContent" class="tab-content f-f-f-result">
           <div class="tab-pane fade in active" id="friends">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 result-chart-container">
                 <canvas id="result-chart-04" width="141" height="150"></canvas>
              </div>
              <div class="col-lg-12 post-count">
                <span class="glyphicon glyphicon-02 glyphicon-user" aria-hidden="true"></span>
                <span class="post-counter post-counter-02">{{$friends['friends']}}</span> <span class="counter-text counter-text-02">Friends</span>
              </div>
           </div> 
           <div class="tab-pane fade" id="following">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 result-chart-container">
                 <canvas id="result-chart-02" width="141" height="150"></canvas>
              </div>                
              <div class="col-lg-12 post-count">
                <span class="glyphicon glyphicon-02 glyphicon-user" aria-hidden="true"></span>
                <span class="post-counter post-counter-02">{{$followings['followings']}}</span> <span class="counter-text counter-text-02">Following</span>
              </div>
  
           </div>
           <div class="tab-pane fade" id="followers">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 result-chart-container">
                 <canvas id="result-chart-03" width="141" height="150"></canvas>
              </div>
               <div class="col-lg-12 post-count">
                <span class="glyphicon glyphicon-02 glyphicon-user" aria-hidden="true"></span>
                <span class="post-counter post-counter-02">{{$followers['followers']}}</span> <span class="counter-text counter-text-02">Followers</span>
              </div>
           </div>
        </div>
      </div>

    </div>

</div>