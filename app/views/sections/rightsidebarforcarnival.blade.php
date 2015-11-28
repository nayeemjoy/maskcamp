<div class="section-03 col-xs-12 hidden-xs">
            <!-- E -->
  <div class="top-flop-fixed" data-answered="1">

    <div class="row visible-xs">
      <div class="col-xs-12">
        <span class="visible-xs sidebar-x-button glyphicon glyphicon-remove-sign pull-left" id="cm-right-sidebar-x"aria-hidden="true"></span>
      </div>
    </div>
    
    <!-- !E -->
    <div class="row common-room" title="All People Are Anonymous In Common Room."><!--05-10-15-->
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="page-title">
          
          @if($data['page'] == "common")
          <span class="page-icon glyphicon glyphicon-globe" aria-hidden="true"></span> <!-- 5-7-Ehsan -->
          Common Room<!--05-10-15-->
          @elseif($data['page'] == "campus")
          <span class="page-icon glyphicon glyphicon-education" aria-hidden="true"></span> <!-- 5-7-Ehsan -->
          Campus
          @elseif($data['page'] == "carnival")
          <span class="page-icon glyphicon glyphicon-education" aria-hidden="true"></span> <!-- 5-7-Ehsan -->
          Carnival
          @endif
        </div>
      </div>  
    </div>

    @if($data['top_post'])
     <div class="row poll-section"><!--05-10-15-->
          <div class="col-lg-12">
              <div class="poll"><span class="page-icon glyphicon glyphicon-star" aria-hidden="true"></span>Top Post</div><!--05-25-15-turash-->
          </div>       
    </div>

    <div class="rsb-day"><!--05-25-15-turash-->
    
	    <div class="row"> 
	      <div class="col-lg-12">
	        <img src="{{$data['top_post']['img']}}" 
	             class="img-responsive top-img img-rounded cm-img-pop" 
	             data-user="{{$data['top_post']['user_id']}}" data-img_canvas_id="result-chart-top" 
	             data-toggle="tooltip" data-placement="right" data-html="true" 
	             title="<canvas id='result-chart-top' width='100' height='100'></canvas>"><!-- 19-May-Ehsan -->
	        <p class="post-info rsb-time"><a class="post-info-link" href="{{URL::to('/singlepost/'.$data['top_post']['id'])}}" target="_blank" ><small>{{$data['top_post']['ago']}}</small></a></p><!--9-2-link-->
	        <!-- START17-6-Ehsan -->
              <p class="top">
                <?php 
                      if (mb_strlen($data['top_post']['post']) > 100) {

                        if (!preg_match("/\s/", mb_substr($data['top_post']['post'], 99, 1))) {
                          /*echo "case-false-preset:";*/
                          $string_break_off = mb_strpos(mb_substr($data['top_post']['post'], 99), " ");
                          $string_break_off_nl = mb_strpos(mb_substr($data['top_post']['post'], 99), "\n");
                          
                          if (preg_match("/\//", mb_substr($data['top_post']['post'], 99+$string_break_off+1, 1))) {
                              $string_break_off = $string_break_off_nl;
                          }
                          
                          $string_break_off = ($string_break_off_nl < $string_break_off)?$string_break_off_nl:$string_break_off;
                        } else {
                          $string_break_off = -1; //Here -1 is for actual 0
                          /*echo "Case-actual-0";*/
                        }
                        
                        if ($string_break_off == false) {
                          /*echo "Case-false";*/
                          echo $data['top_post']['post'];  
                        } else {

                        //if ($string_break_pos == -1) $string_break_pos = 0;
                        $string_break_off = ($string_break_off == -1)?0:$string_break_off; 

                        echo mb_substr($data['top_post']['post'], 0, 100+$string_break_off);

                        }
                         
                      } else { ?>
                        
                        {{$data['top_post']['post']}}
                        
                <?php } ?>
                    <a href="{{URL::to('singlepost/'.$data['top_post']['id'])}}" target="_blank">...Continue reading</a>
              </p>
              <!-- END17-6-Ehsan -->
	      </div>
	    </div>
	
	    <div class="row like-dislike-comment button-section" data-post_id="{{$data['top_post']['id']}}">
	          <!-- //////19-May-2015-Ehsan -->
	          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
	             <!-- <span class="pull-right count">{{$data['top_post']['like']}}</span> --> <!-- 17-11-Ehsan -->
	             <!-- Already Liked Checking Start-->
	             @if($data['top_post']['liked'])
	             <!-- Already Liked -->
	             <span class="glyphicon glyphicon-thumbs-up like-img liked" data-liked="1" data-liketype="t-f-post"></span>
	             @else
	             <!-- Not Liked Yet -->
	             <span class="glyphicon glyphicon-thumbs-up like-img" data-liked="0" data-liketype="t-f-post"></span>
	             @endif
	             <!-- Already Liked Checking End-->
	            
	          </div>
	          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
	            <!-- <span class="pull-right count">{{$data['top_post']['dislike']}}</span> --> <!-- 17-11-Ehsan -->
	            <!-- Already Disliked Checking Start-->
	            @if($data['top_post']['disliked'])
	                <!-- Already disLiked -->
	            <span class="glyphicon glyphicon-thumbs-down dislike-img disliked" data-liked="3" data-liketype="t-f-post"></span>
	            @else
	                <!-- Not disLiked Yet -->
	            <span class="glyphicon glyphicon-thumbs-down dislike-img" data-liked="2" data-liketype="t-f-post"></span>
	            @endif
	            <!-- Already Disliked Checking End --> 
	            
	          </div>
	          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
	             <!-- <span class="pull-right count">{{$data['top_post']['comment']}}</span> --> <!-- 17-11-Ehsan -->
	             <span class="glyphicon glyphicon-comment comment-img like-dislike-opacity" data-reqsource="commenter"></span>
	          </div>
	         <!-- !!!!!!!!19-May-2015-Ehsan -->
	    </div>

      <!-- START-17-11-Ehsan -->
      <ul class="list-inline ul-like-dislike-comment-count">
          <li><small>Likes: <span class="pull-right count">{{$data['top_post']['like']}}</span></small></li>
          <li><small>Dislikes: <span class="pull-right count">{{$data['top_post']['dislike']}}</span></small></li>
          <li><small>Comments: <span class="pull-right count">{{$data['top_post']['comment']}}</span></small></li>
      </ul>
      <!-- END-17-11-Ehsan -->
	    
    </div>

    @endif
    @if($data['flop_post'])
    <div class="row poll-section"><!--05-10-15-->
      <div class="col-lg-12">
        <div class="poll"><span class="page-icon glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>Flop Post</div><!05-25-15-turash-->
      </div>       
    </div>
    
    <div class="rsb-day"><!--05-25-15-turash-->
	
	    <div class="row "> 
	      <div class="col-lg-12">
	        <img src="{{$data['flop_post']['img']}}" 
	             class="img-responsive top-img img-rounded cm-img-pop" data-user="{{$data['flop_post']['user_id']}}" 
	             data-img_canvas_id="result-chart-flop" data-toggle="tooltip" 
	             data-placement="right" data-html="true" 
	             title="<canvas id='result-chart-flop' width='100' height='100'></canvas>"><!-- 19-May-Ehsan -->
	        <p class="post-info rsb-time"><a class="post-info-link" href="{{URL::to('/singlepost/'.$data['flop_post']['id'])}}" target="_blank" ><small>{{$data['flop_post']['ago']}}</small></a></p><!--9-2-link-->
	        <!-- START17-6-Ehsan -->
              <p class="top">
                <?php 
                      if (mb_strlen($data['flop_post']['post']) > 100) {

                        if (!preg_match("/\s/", mb_substr($data['flop_post']['post'], 99, 1))) {
                          /*echo "case-false-preset:";*/
                          $string_break_off = mb_strpos(mb_substr($data['flop_post']['post'], 99), " ");
                          $string_break_off_nl = mb_strpos(mb_substr($data['flop_post']['post'], 99), "\n");
                          
                          if (preg_match("/\//", mb_substr($data['flop_post']['post'], 99+$string_break_off+1, 1))) {
                              $string_break_off = $string_break_off_nl;
                          }
                          
                          $string_break_off = ($string_break_off_nl < $string_break_off)?$string_break_off_nl:$string_break_off;
                        } else {
                          $string_break_off = -1; //Here -1 is for actual 0
                          /*echo "Case-actual-0";*/
                        }
                        
                        if ($string_break_off == false) {
                          /*echo "Case-false";*/
                          echo $data['flop_post']['post'];  
                        } else {

                        //if ($string_break_pos == -1) $string_break_pos = 0;
                        $string_break_off = ($string_break_off == -1)?0:$string_break_off; 

                        echo mb_substr($data['flop_post']['post'], 0, 100+$string_break_off);

                        }
                         
                      } else { ?>
                        
                        {{$data['flop_post']['post']}}
                        
                <?php } ?>
                    <a href="{{URL::to('singlepost/'.$data['flop_post']['id'])}}" target="_blank">...Continue reading</a>
              </p>
              <!-- END17-6-Ehsan -->
	      </div>
	    </div>
	
	    <div class="row like-dislike-comment button-section" data-post_id="{{$data['flop_post']['id']}}">
	          <!-- //////19-May-2015-Ehsan -->
	          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
	             <!-- <span class="pull-right count">{{$data['flop_post']['like']}}</span> --> <!-- 17-11-Ehsan -->
	             <!-- Already Liked Checking Start-->
	             @if($data['flop_post']['liked'])
	             <!-- Already Liked -->
	             <span class="glyphicon glyphicon-thumbs-up like-img liked" data-liked="1" data-liketype="t-f-post"></span>
	             @else
	             <!-- Not Liked Yet -->
	             <span class="glyphicon glyphicon-thumbs-up like-img" data-liked="0" data-liketype="t-f-post"></span>
	             @endif
	             <!-- Already Liked Checking End-->
	            
	          </div>
	          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
	            <!-- <span class="pull-right count">{{$data['flop_post']['dislike']}}</span> --> <!-- 17-11-Ehsan -->
	            <!-- Already Disliked Checking Start-->
	            @if($data['flop_post']['disliked'])
	                <!-- Already disLiked -->
	            <span class="glyphicon glyphicon-thumbs-down dislike-img disliked" data-liked="3" data-liketype="t-f-post"></span>
	            @else
	                <!-- Not disLiked Yet -->
	            <span class="glyphicon glyphicon-thumbs-down dislike-img" data-liked="2" data-liketype="t-f-post"></span>
	            @endif
	            <!-- Already Disliked Checking End --> 
	            
	          </div>
	          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
	             <!-- <span class="pull-right count">{{$data['flop_post']['comment']}}</span> --> <!-- 17-11-Ehsan -->
	             <span class="glyphicon glyphicon-comment comment-img like-dislike-opacity" data-reqsource="commenter"></span>
	          </div>
	         <!-- !!!!!!!!19-May-2015-Ehsan -->
	    </div>
	    
      <!-- START-17-11-Ehsan -->
      <ul class="list-inline ul-like-dislike-comment-count">
          <li><small>Likes: <span class="pull-right count">{{$data['flop_post']['like']}}</span></small></li>
          <li><small>Dislikes: <span class="pull-right count">{{$data['flop_post']['dislike']}}</span></small></li>
          <li><small>Comments: <span class="pull-right count">{{$data['flop_post']['comment']}}</span></small></li>
      </ul>
      <!-- END-17-11-Ehsan -->

    </div>
    <div class="below-fotd"></div><!--05-25-15-turash-->
    @endif
  </div>

</div> <!-- .section-03-full-scroll -->