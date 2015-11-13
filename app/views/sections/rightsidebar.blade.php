<div class="section-03 col-xs-12 hidden-xs">
            <!-- E -->
    <!-- ******START********5-7-Ehsan -->
    @if($data['answered'])
    <div class="top-flop-fixed" data-answered="1">
    @else
    <div class="top-flop-fixed" data-answered="0">
    @endif
    <!-- ******END********5-7-Ehsan -->
        <div class="row visible-xs">      
            <div class="col-xs-12">
              <span class="visible-xs sidebar-x-button glyphicon glyphicon-remove-sign pull-left" id="cm-right-sidebar-x"aria-hidden="true"></span>
            </div>      
        </div>
        
        <!-- !E -->
        
        <div class="row home" title="Your Facebook Friends Are Anonymous In Private Room."><!--05-10-15-->      
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <div class="page-title"><span class="page-icon glyphicon glyphicon-home" aria-hidden="true"></span>Friends Room<!--05-10-15--></div>
            </div>        
        </div>

        <?php $post = $data['top_post']; ?>
        @if($post != null)
        <div class="row poll-section"><!--05-10-15-->
          <div class="col-lg-12">
            <div class="poll"><span class="page-icon glyphicon glyphicon-star" aria-hidden="true"></span>The Top Of Yesterday</div><!--05-25-15-turash-->
          </div>       
        </div>
         
        <div class="rsb-day"><!--05-25-15-turash-->
          <div class="row">
            
            <div class="col-lg-12"><!--05-25-15-turash-->
              <img src="{{$post['img']}}" 
                   class="img-responsive top-img img-rounded cm-img-pop" data-img_canvas_id="result-chart-top" 
                   data-user="{{$post['user_id']}}" data-toggle="tooltip" 
                   data-placement="right" data-html="true" 
                   title="<canvas id='result-chart-top' width='100' height='100'></canvas>"><!-- 19-May-Ehsan -->
              
              <p class="post-info rsb-time"><a class="post-info-link" href="{{URL::to('/singlepost/'.$post['id'])}}" target="_blank" ><small>{{$post['ago']}}</small></a></p><!--9-2-link-->
              <!-- START17-6-Ehsan -->
              <p class="top">
                <?php 
                      if (mb_strlen($post['post']) > 100) {

                        if (!preg_match("/\s/", mb_substr($post['post'], 99, 1))) {
                          /*echo "case-false-preset:";*/
                          $string_break_off = mb_strpos(mb_substr($post['post'], 99), " ");
                          $string_break_off_nl = mb_strpos(mb_substr($post['post'], 99), "\n");
                          
                          if (preg_match("/\//", mb_substr($post['post'], 99+$string_break_off+1, 1))) {
                              $string_break_off = $string_break_off_nl;
                          }
                          
                          $string_break_off = ($string_break_off_nl < $string_break_off)?$string_break_off_nl:$string_break_off;
                        } else {
                          $string_break_off = -1; //Here -1 is for actual 0
                          /*echo "Case-actual-0";*/
                        }
                        
                        if ($string_break_off == false) {
                          /*echo "Case-false";*/
                          echo $post['post'];  
                        } else {

                        //if ($string_break_pos == -1) $string_break_pos = 0;
                        $string_break_off = ($string_break_off == -1)?0:$string_break_off; 

                        echo mb_substr($post['post'], 0, 100+$string_break_off);

                        }
                         
                      } else { ?>
                        
                        {{$post['post']}}
                        
                <?php } ?>
                    <a href="{{URL::to('singlepost/'.$post['id'])}}" target="_blank">...Continue reading</a>
              </p>
              <!-- END17-6-Ehsan -->
            </div>

          </div>

          <div class="row like-dislike-comment button-section" data-post_id="{{$post['id']}}">
            <!-- //////19-May-2015-Ehsan -->
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
               <span class="pull-right count">{{$post['like']}}</span>
               <!-- Already Liked Checking Start-->
               @if($post['liked'])
               <!-- Already Liked -->
               <span class="glyphicon glyphicon-thumbs-up like-img liked" data-liked="1" data-liketype="t-f-post"></span>
               @else
               <!-- Not Liked Yet -->
               <span class="glyphicon glyphicon-thumbs-up like-img" data-liked="0" data-liketype="t-f-post"></span>
               @endif
               <!-- Already Liked Checking End-->
              
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
              <span class="pull-right count">{{$post['dislike']}}</span>
              <!-- Already Disliked Checking Start-->
              @if($post['disliked'])
                  <!-- Already disLiked -->
              <span class="glyphicon glyphicon-thumbs-down dislike-img disliked" data-liked="3" data-liketype="t-f-post"></span>
              @else
                  <!-- Not disLiked Yet -->
              <span class="glyphicon glyphicon-thumbs-down dislike-img" data-liked="2" data-liketype="t-f-post"></span>
              @endif
              <!-- Already Disliked Checking End --> 
              
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
               <span class="pull-right count">{{$post['comment']}}</span>
               <span class="glyphicon glyphicon-comment comment-img like-dislike-opacity" data-reqsource="commenter"></span>
            </div>
           <!-- !!!!!!!!19-May-2015-Ehsan -->
          </div>
        </div>

        <!--<div class="row view-more-section">/*05-25-15*/      
          <div class="col-xs-12">
            <button class="btn btn-rsb">View More</button>
          </div>        
        </div>-->
        @endif
        <?php $post = $data['flop_post']; ?>
        @if($post != null)

        <div class="row poll-section"><!--05-10-15-->
          <div class="col-lg-12">
            <div class="poll"><span class="page-icon glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>The Flop Of Yesterday</div><!05-25-15-turash-->
          </div>       
        </div>

        <div class="rsb-day"><!--05-25-15-turash-->
          <div class="row ">
            <div class="col-lg-12"><!--05-25-15-turash-->
              <img src="{{$post['img']}}" 
                   class="img-responsive top-img img-rounded cm-img-pop" data-img_canvas_id="result-chart-flop" 
                   data-user="{{$post['user_id']}}" data-toggle="tooltip" 
                   data-placement="right" data-html="true" 
                   title="<canvas id='result-chart-flop' width='100' height='100'></canvas>"><!-- 19-May-Ehsan -->
              <p class="post-info rsb-time"><a class="post-info-link" href="{{URL::to('/singlepost/'.$post['id'])}}" target="_blank" ><small>{{$post['ago']}}</small></a></p><!--9-2-link-->
              <!-- START17-6-Ehsan -->
              <p class="top">
                <?php 
                      if (mb_strlen($post['post']) > 100) {

                        if (!preg_match("/\s/", mb_substr($post['post'], 99, 1))) {
                          /*echo "case-false-preset:";*/
                          $string_break_off = mb_strpos(mb_substr($post['post'], 99), " ");
                          $string_break_off_nl = mb_strpos(mb_substr($post['post'], 99), "\n");
                          
                          if (preg_match("/\//", mb_substr($post['post'], 99+$string_break_off+1, 1))) {
                              $string_break_off = $string_break_off_nl;
                          }
                          
                          $string_break_off = ($string_break_off_nl < $string_break_off)?$string_break_off_nl:$string_break_off;
                        } else {
                          $string_break_off = -1; //Here -1 is for actual 0
                          /*echo "Case-actual-0";*/
                        }
                        
                        if ($string_break_off == false) {
                          /*echo "Case-false";*/
                          echo $post['post'];  
                        } else {

                        //if ($string_break_pos == -1) $string_break_pos = 0;
                        $string_break_off = ($string_break_off == -1)?0:$string_break_off; 

                        echo mb_substr($post['post'], 0, 100+$string_break_off);

                        }
                         
                      } else { ?>
                        
                        {{$post['post']}}
                        
                <?php } ?>
                    <a href="{{URL::to('singlepost/'.$post['id'])}}" target="_blank">...Continue reading</a>
              </p>
              <!-- END17-6-Ehsan -->
            </div>
          </div>

          <div class="row like-dislike-comment button-section" data-post_id="{{$post['id']}}">
            <!-- //////19-May-2015-Ehsan -->
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
               <span class="pull-right count">{{$post['like']}}</span>
               <!-- Already Liked Checking Start-->
               @if($post['liked'])
               <!-- Already Liked -->
               <span class="glyphicon glyphicon-thumbs-up like-img liked" data-liked="1" data-liketype="t-f-post"></span>
               @else
               <!-- Not Liked Yet -->
               <span class="glyphicon glyphicon-thumbs-up like-img" data-liked="0" data-liketype="t-f-post"></span>
               @endif
               <!-- Already Liked Checking End-->
              
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
              <span class="pull-right count">{{$post['dislike']}}</span>
              <!-- Already Disliked Checking Start-->
              @if($post['disliked'])
                  <!-- Already disLiked -->
              <span class="glyphicon glyphicon-thumbs-down dislike-img disliked" data-liked="3" data-liketype="t-f-post"></span>
              @else
                  <!-- Not disLiked Yet -->
              <span class="glyphicon glyphicon-thumbs-down dislike-img" data-liked="2" data-liketype="t-f-post"></span>
              @endif
              <!-- Already Disliked Checking End --> 
              
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
               <span class="pull-right count">{{$post['comment']}}</span>
               <span class="glyphicon glyphicon-comment comment-img like-dislike-opacity" data-reqsource="commenter"></span>
            </div>
            <!-- !!!!!!!!19-May-2015-Ehsan -->
          </div>
        </div>
        
        <div class="below-fotd"></div><!--05-23-15-turash-->

        @endif
    </div>

    <!-- ********START********5-7-Ehsan -->
    @if($data['answered'])
    @else
      <div class="poll-fixed">
        @if($data['question'])
        <form action="{{URL::to('giveanswer')}}" method="POST" class="poll-form"> <!-- 8-7-Turash -->

          <div class="poll-section poll-submit-section"><!--05-10-15-->
            <div class="col-lg-12">
              <div class="poll"><span class="page-icon glyphicon glyphicon-stats" aria-hidden="true"></span>Poll</div> 
            </div>       
          </div>

          <div class="row poll-question">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">  
                 <p class="question">Q.  {{$data['question']->question}}</p> 
                   @foreach($data['options_of_question'] as $option)
                   <p class="opinion">
                      <input type="radio" name="optid" id="" value="{{$option->id}}">
                      {{$option->option_details}}
                   </p>
                   @endforeach
            </div> 
            <div class="col-lg-1"></div>
          </div>

          <div class="row view-more-section">            
            <div class="col-xs-12">
              	<button class="btn btn-rsb poll-submit btn-modified">Submit</button><!--11/07/15-turash-->     	
            </div>       
          </div>
          
        </form> 
        @endif   
      </div>
    @endif
    <!-- ********END********5-7-Ehsan -->

</div>